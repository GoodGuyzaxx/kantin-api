<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'id_order' => 'required',
            'id_kantin' => 'required',
            'total_harga' => 'required',
            'id_menu' => 'required',
            'menu' => 'required',
            'jumlah' => 'required',
            'tipe_pembayaran' => 'required',
            'status_pembayaran' => 'required',
            'email_konsumen' => 'required|email',
            'nama_konsumen' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $menu = Menu::findOrFail($request->id_menu);

            if ($menu->stock < $request->jumlah) {
                throw new \Exception('Insufficient stock');
            }

            $transaksi = Transaksi::create([
                'id_order' => $request->id_order,
                'id_kantin' => $request->id_kantin,
                'total_harga' => $request->total_harga,
                'menu' => $request->menu,
                'jumlah' => $request->jumlah,
                'status_pesanan' => 'Diterima',
                'tipe_pembayaran' => $request->tipe_pembayaran,
                'status_pembayaran' => $request->status_pembayaran,
                'email_konsumen' => $request->email_konsumen,
                'nama_konsumen' => $request->nama_konsumen,
            ]);

            $menu->decrement('stock', $request->jumlah);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Menambah Transaksi'
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal Menambah Transaksi',
                'error' => $e->getMessage()
            ], 400);
        }
    }

//    public function store(Request $request)
//    {
//        $validator = Validator::make($request->all(),[
//            'id_kantin' => 'required',
//            'total_harga' => 'required',
//            'id_menu' => 'required',
//            'menu' => 'required',
//            'jumlah' => 'required',
//            'tipe_pembayaran' => 'required',
//            'status_pembayaran' => 'required',
//            'email_konsumen' => 'required',
//            'nama_konsumen' => 'required'
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'error' => $validator->errors()
//            ]);
//        }
//
////        $dataID = Str::uuid()->toString();
//        DB::table('transaksis')->insert([
//            'id_order' => $request->id_order ,
//            'id_kantin' => $request->id_kantin,
//            'total_harga' => $request->total_harga,
//            'menu' => $request->menu,
//            'jumlah' => $request->jumlah,
//            'status_pesanan' => 'Diterima',
//            'tipe_pembayaran' => $request->tipe_pembayaran,
//            'status_pembayaran' => $request->status_pembayaran,
//            'email_konsumen' => $request->email_konsumen,
//            'nama_konsumen' => $request->nama_konsumen,
//            'created_at' => now(),
//        ]);
//
//        return response()->json([
//            'success' => true,
//            'message' => 'Berhasil Menambah Transaksi',
//        ],201);
//
//        $dataStock = Menu::find($request->id_menu);
//        DB::table('menus')->where('id_menu', $request->id_menu)->update([
//            'stock' => $dataStock->stock - $request->jumlah
//        ]);
//
//    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataDB = DB::table('transaksis')
            ->where('id_order', $id)
            ->get();

        if ($dataDB->isEmpty()){
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
                ],404);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Transaksi Berhasil',
                'data' => $dataDB
            ],200);
        }
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
    public function destroy(Transaksi $transaksi)
    {
        //
    }

    public function showByEmail($email)
    {
        $dataDB = DB::table('transaksis')
            ->select('id_order', 'id_kantin', 'total_harga', 'menu', 'status_pesanan', 'jumlah', 'tipe_pembayaran', 'status_pembayaran', 'email_konsumen', 'nama_konsumen', 'created_at')
            ->where('email_konsumen', $email)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($dataDB->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        } else {
            $groupedData = $dataDB->groupBy('id_order')->map(function ($group) {
                $firstItem = $group->first();
                $combinedMenu = $group->groupBy('menu')->map(function ($items) {
                    return [
                        'nama' => $items->first()->menu,
                        'jumlah' => $items->sum('jumlah')
                    ];
                })->values();

                return [
                    'id_order' => $firstItem->id_order,
                    'id_kantin' => $firstItem->id_kantin,
                    'total_harga' => $firstItem->total_harga,
                    'tipe_pembayaran' => $firstItem->tipe_pembayaran,
                    'status_pembayaran' => $firstItem->status_pembayaran,
                    'email_konsumen' => $firstItem->email_konsumen,
                    'nama_konsumen' => $firstItem->nama_konsumen,
                    'created_at' => $firstItem->created_at,
                    'status_pesanan' => $firstItem->status_pesanan,
                    'menu' => $combinedMenu,
                ];
            })->values();

            // Limit the response to the 5 most recent transactions
            $limitedData = $groupedData->take(5);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi Berhasil',
                'data' => $limitedData
            ], 200);
        }
    }

    public function showByIdStatus($id,$status)
    {
        $dataDB = DB::table('transaksis')
            ->select('id_order', 'id_kantin', 'total_harga', 'menu','jumlah','status_pesanan' ,'tipe_pembayaran', 'status_pembayaran', 'email_konsumen', 'nama_konsumen','created_at')
            ->where('id_kantin', $id)
            ->where('status_pesanan', $status)
            ->where('status_pembayaran', '!=', 'Pending')
            ->get();

        if ($dataDB->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 200);
        } else {
            $groupedData = $dataDB->groupBy('id_order')->map(function ($group) {
                $firstItem = $group->first();

                $menuItems = $group->map(function ($item) {
                    return [
                        'nama' => $item->menu,
                        'jumlah' => $item->jumlah
                    ];
                });


                $combinedMenu = $menuItems->groupBy('nama')->map(function ($items) {
                    return [
                        'nama' => $items->first()['nama'],
                        'jumlah' => $items->sum('jumlah')
                    ];
                })->values();

                return [
                    'id_order' => $firstItem->id_order,
                    'id_kantin' => $firstItem->id_kantin,
                    'total_harga' => $firstItem->total_harga,
                    'tipe_pembayaran' => $firstItem->tipe_pembayaran,
                    'status_pembayaran' => $firstItem->status_pembayaran,
                    'email_konsumen' => $firstItem->email_konsumen,
                    'nama_konsumen' => $firstItem->nama_konsumen,
                    'created_at' => $firstItem->created_at,
                    'status_pesanan' => $firstItem->status_pesanan,
                    'menu' => $combinedMenu,
                ];
            })->values();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi Berhasil',
                'data' => $groupedData
            ], 200);
        }
    }

    public function updateStatus(Request $request,$id)
    {
        $data = $request->all();
        $post = Transaksi::where('id_order', $id);

        $post->update($data);
        return response()->json([
           'success' => true,
           'message' => 'Transaksi Berhasil',
        ]);


    }

    public function getTotalHargaByKantin($id)
    {
        try {
            $result = DB::select("
            SELECT
                id_kantin,
                SUM(CASE
                    WHEN row_num = 1 THEN total_harga
                    ELSE 0
                END) AS total_harga_kantin
            FROM (
                SELECT
                    id_kantin,
                    id_order,
                    total_harga,
                    ROW_NUMBER() OVER (PARTITION BY id_kantin, id_order ORDER BY created_at) AS row_num
                FROM transaksis
                WHERE id_kantin = :id_kantin
            ) subquery
            GROUP BY id_kantin
        ", ['id_kantin' => $id]);

            if (empty($result)) {
                return [
                    'success' => false,
                    'message' => 'Data Tidak ditemukan',
                ];
            }

            return [
                'success' => true,
                'message' => 'Total harga Berhasil didaptkan',
                'data' => [
                    'id_kantin' => $result[0]->id_kantin,
                    'total_harga_kantin' => $result[0]->total_harga_kantin
                ]
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Terjadi Error: ' . $e->getMessage(),
            ];
        }
    }

    public function getTotalByMonth($id, Request $request)
    {
        try {
            // Validate if month and year are provided, otherwise use current month and year
            $month = $request->get('month', now()->month);
            $year = $request->get('year', now()->year);

            // Query to get only completed transactions for specific kantin
            $transactions = Transaksi::where('id_kantin', $id)
                ->where('status_pesanan', 'Selesai')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->get();

            // Calculate totals for completed transactions
            $totalAmount = $transactions->sum('total_harga');
            $totalTransactions = $transactions->count();

            // Group by payment type for completed transactions
//            $paymentTypes = $transactions->groupBy('tipe_pembayaran')
//                ->map(function ($group) {
//                    return [
//                        'count' => $group->count(),
//                        'total' => $group->sum('total_harga')
//                    ];
//                });

            return response()->json([
                'success' => true,
                'data' => [
                    'month' => $month,
                    'year' => $year,
                    'total_amount' => $totalAmount,
                    'total_transactions' => $totalTransactions,
//                    'payment_types' => $paymentTypes,
//                    'transactions' => $transactions->map(function ($transaction) {
//                        return [
//                            'id_order' => $transaction->id_order,
//                            'total_harga' => $transaction->total_harga,
//                            'menu' => $transaction->menu,
//                            'jumlah' => $transaction->jumlah,
//                            'tipe_pembayaran' => $transaction->tipe_pembayaran,
//                            'tanggal' => $transaction->created_at->format('Y-m-d H:i:s')
//                        ];
//                    })
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving monthly transactions',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getRatingStatus($nama_konsumen,$status_pesanan)
    {

        $dataDB = DB::table('transaksis')
            ->select('id_order', 'id_kantin', 'total_harga', 'menu','jumlah','status_pesanan' ,'tipe_pembayaran', 'status_pembayaran', 'email_konsumen', 'nama_konsumen','created_at')
            ->where('nama_konsumen', $nama_konsumen)
            ->where('status_pesanan', $status_pesanan)
            ->get();

        if ($dataDB->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data ditemukan'
            ], 200);
        } else {
//            $groupedData = $dataDB->groupBy('id_order')->map(function ($group) {
//                $firstItem = $group->first();
//
//                return [
//                    'id_order' => $firstItem->id_order,
//                    'id_kantin' => $firstItem->id_kantin,
//                    'total_harga' => $firstItem->total_harga,
//                    'tipe_pembayaran' => $firstItem->tipe_pembayaran,
//                    'status_pembayaran' => $firstItem->status_pembayaran,
//                    'email_konsumen' => $firstItem->email_konsumen,
//                    'nama_konsumen' => $firstItem->nama_konsumen,
//                    'created_at' => $firstItem->created_at,
//                    'status_pesanan' => $firstItem->status_pesanan,
//                ];
//            })->values();

            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan',
//                'data' => $groupedData
            ], 200);
        }

    }

}
