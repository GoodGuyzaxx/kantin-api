<?php

namespace App\Http\Controllers\web;

use App\Exports\TransaksiExport;
use App\Exports\TransaksiKantinExport;
use App\Http\Controllers\Controller;
use App\Models\Kantin;
use App\Models\Konsumen;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Transaksi::join('kantins', 'kantins.id_kantin', '=', 'transaksis.id_kantin')->get();
        return view('pages.admin.transaksi.data',[
            'title' => 'Data Transaksi',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi, $id)
    {
        $data = Transaksi::find($id);

        if ($data){
            $data->delete();
        }
        return redirect()->route('admin.transaksi.index')->with('success', 'Data berhasil dihapus');
    }


    public function showDetailTransaksi($nama, Request $request)
    {
        $query = Transaksi::where('nama_konsumen', $nama)
            ->join('kantins', 'kantins.id_kantin', '=', 'transaksis.id_kantin');

        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('transaksis.created_at', $request->month);
        }

        $data = $query->get();

        return view('pages.admin.konsumen.detail.detail', [
            'title' => 'Detail Transaksi',
            'data' => $data
        ]);
    }

    public function exportTransaksi($nama, Request $request)
    {
        $month = $request->query('month');
        return Excel::download(new TransaksiExport($nama, $month), 'transaksi_' . $nama . '.xlsx');
    }


    public function indexKonsumen(){
        $data = Konsumen::all();
        return view('pages.admin.konsumen.transaksi.data', [
            'title' => 'Data Transaksi',
            'data' => $data
        ]);
    }

    public function indexKantin(){
        $data = Kantin::join('admins', 'admins.id_admin', '=', 'kantins.id_admin')->get();
        return view('pages.admin.kantin.transaksi.data', [
            'title' => 'Data Transaksi',
            'data' => $data
        ]);
    }

    public function showDetailKantin($id, Request $request)
    {
        try {
            // Base query for transactions with kantin info
            $query = Transaksi::where('transaksis.id_kantin', $id)
                ->join('kantins', 'kantins.id_kantin', '=', 'transaksis.id_kantin')
                ->select('transaksis.*', 'kantins.nama_kantin');

            // Apply month filter if provided
            if ($request->filled('month')) {
                $query->whereMonth('transaksis.created_at', $request->month);
            }

            // Get transactions
            $data = $query->get();

            // Calculate total completed transactions
            $totalCompleted = Transaksi::where('id_kantin', $id)
                ->where('status_pesanan', 'Selesai')
                ->when($request->filled('month'), function($query) use ($request) {
                    $query->whereMonth('created_at', $request->month);
                })
                ->sum('total_harga');

            return view('pages.admin.kantin.detail.detail', [
                'title' => 'Detail Transaksi',
                'data' => $data,
                'totalCompleted' => $totalCompleted
            ]);

        } catch (\Exception $e) {
            return back()->with('error', 'Error mengambil detail transaksi: ' . $e->getMessage());
        }
    }

//    public function showDetailKantin($id, Request $request)
//    {
//        $query = Transaksi::where('transaksis.id_kantin', $id)
//            ->join('kantins', 'kantins.id_kantin', '=', 'transaksis.id_kantin');
//
//        if ($request->has('month') && $request->month != '') {
//            $query->whereMonth('transaksis.created_at', $request->month);
//
//        }
//
//        $data = $query->get();
//
//        $totalCompletedQuery = DB::table('transaksis')
//            ->select(DB::raw('SUM(CASE WHEN row_num = 1 THEN total_harga ELSE 0 END) AS total_harga_completed'))
//            ->fromSub(function ($query) use ($id, $request) {
//                $query->select('id_order', 'total_harga')
//                    ->selectRaw('ROW_NUMBER() OVER (PARTITION BY id_order ORDER BY created_at) AS row_num')
//                    ->from('transaksis')
//                    ->where('id_kantin', $id)
//                    ->where('status_pesanan', 'Selesai');
//
//                if ($request->has('month') && $request->month != '') {
//                    $query->whereMonth('created_at', $request->month);
//                }
//            }, 'subquery');
//
//        $totalCompleted = $totalCompletedQuery->value('total_harga_completed') ?? 0;
//
//        $months = Transaksi::where('id_kantin', $id)
//            ->selectRaw('MONTH(created_at) as month')
//            ->distinct()
//            ->orderBy('month', 'asc')
//            ->pluck('month');
//
//        return view('pages.admin.kantin.detail.detail', [
//            'title' => 'Detail Transaksi',
//            'data' => $data,
//            'totalCompleted' => $totalCompleted,
//            'selectedMonth' => $request->month,
//            'months' => $months
//        ]);
//    }

//    public function exportTransaksiKantin(Request $request)
//    {
//        $nama = $request->route('nama');
//        $month = $request->get('month');
//
////        $export = new TransaksiKantinExport($nama, $month);
//
//        return Excel::download(new TransaksiKantinExport($nama, $month), 'transaksi_kantin_' . $nama . '_' . now()->format('Y-m-d') . '.xlsx');
//    }

    public function exportTransaksiKantin(Request $request)
    {
        $kantinIdentifier = $request->route('nama');
        $month = $request->get('month');

        Log::info('Export Parameters', [
            'kantinIdentifier' => $kantinIdentifier,
            'month' => $month
        ]);

        $export = new TransaksiKantinExport($kantinIdentifier, $month);

        $queryResult = $export->query()->get();
        Log::info('Query Result Count', ['count' => $queryResult->count()]);

        if ($queryResult->isEmpty()) {
            Log::warning('No data found for export');
            return back()->with('error', 'Tidak ada data ditemukan untuk parameter yang ditentukan.');
        }

        return Excel::download($export, 'transaksi_kantin_' . $kantinIdentifier . '_' . now()->format('Y-m-d') . '.xlsx');
    }

//    public function exportTransaksiKantin($id, Request $request)
//    {
//        try {
//            $query = Transaksi::where('transaksis.id_kantin', $id)
//                ->join('kantins', 'kantins.id_kantin', '=', 'transaksis.id_kantin')
//                ->select('transaksis.*', 'kantins.nama_kantin');
//
//            if ($request->filled('month')) {
//                $query->whereMonth('transaksis.created_at', $request->month);
//            }
//
//            $data = $query->get();
//            $kantin = Kantin::where('id_kantin', $id)->first();
//
//            $fileName = 'Laporan_Transaksi_' . $kantin->nama_kantin;
//            if ($request->month) {
//                $fileName .= '_' . date('F_Y', mktime(0, 0, 0, $request->month, 1));
//            }
//            $fileName .= '.xlsx';
//
//            return Excel::download(new TransaksiExport($data), $fileName);
//        } catch (\Exception $e) {
//            return back()->with('error', 'Error mengexport data: ' . $e->getMessage());
//        }
//    }
//
}
