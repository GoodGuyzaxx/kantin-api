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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $dataID = Str::uuid()->toString();
        DB::table('transaksis')->insert([
            'id_order' => $request->id_order ,
            'id_kantin' => $request->id_kantin,
            'total_harga' => $request->total_harga,
            'menu' => $request->menu,
            'tipe_pembayaran' => $request->tipe_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
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
}
