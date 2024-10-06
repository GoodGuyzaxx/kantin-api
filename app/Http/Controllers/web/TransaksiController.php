<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

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
}
