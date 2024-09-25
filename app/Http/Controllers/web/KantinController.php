<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Kantin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KantinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kantin::join('admins', 'admins.id_admin', '=', 'kantins.id_admin')->get();

        return view('pages.admin.kantin.data',[
            'title' => 'Data Kantin',
            'kantins' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Admin::all();
        return view('pages.admin.kantin.create',[
            'kantins' => $data
        ]);
    }

    /**s
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'nama_kantin' => 'required',
            'id_admin' => 'required',
        ]);

        if ($validate->fails()) return redirect()->back()->withInput()->withErrors($validate);

        Kantin::create($data);

        return redirect()->route('admin.kantin.index')->with('success', 'Data Kantin Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for eiting the specified resource.
     */
    public function edit(Kantin $admin, $id)
    {
        $data = Kantin::find($id);
        return view('pages.admin.kantin.edit',compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validate = Validator::make($request->all(),[
           'nama_kantin' => 'required',
        ]);

        if ($validate->fails()) return redirect()->back()->withInput()->withErrors($validate);

        $data['nama_kantin'] = $request->nama_kantin;

        Kantin::whereId_kantin($id)->update($data);

        return redirect()->route('admin.kantin.index')->with('success', 'Data Kantin Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kantin $admin,$id)
    {
        $data = Kantin::find($id);

        if ($data){
            $data->delete();
        }
        return redirect()->route('admin.kantin.index')->with('success', 'Data berhasil dihapus');
    }
}
