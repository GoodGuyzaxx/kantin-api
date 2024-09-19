<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $validator = Validator::make($request->all(),[
            'id_kantin' => 'required',
            'total_harga' => 'required',
            'menu' => 'required',
            'tipe_pembayaran' => 'required',
            'status_pembayaran' => 'required',
            'email_konsumen' => 'required',
            'nama_konsumen' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

//        $dataID = Str::uuid()->toString();
        DB::table('transaksis')->insert([
            'id_order' => $request->id_order ,
            'id_kantin' => $request->id_kantin,
            'total_harga' => $request->total_harga,
            'menu' => $request->menu,
            'tipe_pembayaran' => $request->tipe_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
            'email_konsumen' => $request->email_konsumen,
            'nama_konsumen' => $request->nama_konsumen,
            'created_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Menambah Transaksi',
        ],201);
    }

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
            ->select('id_order', 'id_kantin', 'total_harga', 'menu', 'tipe_pembayaran', 'status_pembayaran', 'email_konsumen', 'created_at')
            ->where('email_konsumen', $email)
            ->get();

        if ($dataDB->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        } else {
            $groupedData = $dataDB->groupBy('id_order')->map(function ($group) {
                $firstItem = $group->first();
                return [
                    'id_order' => $firstItem->id_order,
                    'id_kantin' => $firstItem->id_kantin,
                    'total_harga' => $firstItem->total_harga,
                    'menu' => $group->pluck('menu')->toArray(),
                    'tipe_pembayaran' => $firstItem->tipe_pembayaran,
                    'status_pembayaran' => $firstItem->status_pembayaran,
                    'email_konsumen' => $firstItem->email_konsumen,
                    'created_at' => $firstItem->created_at,
                ];
            })->values();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi Berhasil',
                'data' => $groupedData
            ], 200);
        }
    }

//    public function showByEmail($email){
//
//        $dataDB = DB::table('transaksis')
//            ->where('email_konsumen', $email)
//            ->get();
//
//        if ($dataDB->isEmpty()){
//            return response()->json([
//                'success' => false,
//                'message' => 'Transaksi tidak ditemukan'
//            ],404);
//        } else {
//            return response()->json([
//                'success' => true,
//                'message' => 'Transaksi Berhasil',
//                'data' => $dataDB
//            ],200);
//        }
//    }
}
