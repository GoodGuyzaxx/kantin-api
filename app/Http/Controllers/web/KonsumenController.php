<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Kantin;
use App\Models\Konsumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KonsumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Konsumen::all();
        return view('pages.admin.konsumen.data',[
            'title' => 'Data Konsumen',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.konsumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'nama_konsumen' => 'required',
            'email' => 'required|email|unique:konsumens,email',
            'no_telp' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        Konsumen::create($data);

        return  redirect()->route('admin.konsumen.index')->with('success', 'Data Konsumen berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Konsumen $konsumen)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Konsumen $konsumen,$id)
    {
        $data = Konsumen::find($id);
        return view('pages.admin.konsumen.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        $validate = Validator::make($request->all(),[
            'nama_konsumen' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
        ]);

        if ($validate->fails()) return redirect()->back()->withInput()->withErrors($validate);

        $data['nama_konsumen'] = $request->nama_konsumen;
        $data['email'] = $request->email;
        $data['no_telp'] = $request->no_telp;

        if ($request->passowrd){
            $data['password'] = Hash::make($request->password);
        }

        Konsumen::whereId_konsumen($id)->update($data);

        return redirect()->route('admin.konsumen.index')->with('success', 'Data Konsumen Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Konsumen $konsumen, $id)
    {
        $data = Konsumen::find($id);
        if ($data){
            $data->delete();
        }
        return redirect()->route('admin.konsumen.index')->with('success', 'Data Konsumen Berhasil Dihapus');
    }
}
