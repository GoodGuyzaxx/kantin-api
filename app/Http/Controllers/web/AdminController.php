<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Admin::all();
        \Log::info('Users retrieved:', [
            'count' => $data->count(),
            'first_user' => $data->first() ? $data->first()->toArray() : null
        ]);
//        return view('pages.admin.user.data');
        return view('pages.admin.user.data', [
            'title' => 'Data Pengguna',
            'admins' => $data

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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin, $id)
    {
        $data = Admin::find($id);

        return view('pages.admin.user.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                'nama_admin' => 'required',
                'email' => 'required',
                'no_telp' => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['nama_admin'] = $request->nama_admin;
        $data['email'] = $request->email;
        $data['no_telp'] = $request->no_telp;

        if ($request->passowrd){
            $data['password'] = Hash::make($request->password);
        }

        Admin::whereId_admin($id)->update($data);

        return redirect()->route('admin.user.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin,$id)
    {
        $data = Admin::find($id);

        if ($data){
            $data->delete();
        }
        return redirect()->route('admin.user.index')->with('success', 'Data berhasil dihapus');
    }
}
