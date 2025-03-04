<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.user.create');
    }

//    public function register(Request $request){
//        $validate = $request->validate([
//            'nama_admin' => 'required',
//            'email' => 'required|unique:admins,email',
//            'no_telp' => 'required',
//            'password' => 'required',
//        ]);
//
//        $validate['password'] = Hash::make($request->password);
//
//        $tbAdmin = Admin::create($validate);
//
//        return response()->json([
//            'data' => $tbAdmin
//        ],201);
//    }

    public function register(Request $request)
    {
        $validate = $request->validate([
            'nama_admin' => 'required',
            'email' => 'required|unique:admins,email',
            'no_telp' => 'required',
            'password' => 'required',
        ]);

        $validate['password'] = Hash::make($request->password);

        $tbAdmin = Admin::create($validate);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Akun Berhasil Dibuat',
                'data' => [
                    'id_admin' => $tbAdmin->id_admin,
                    'nama_admin' => $tbAdmin->nama_admin,
                    'email' => $tbAdmin->email,
                    'no_telp' => $tbAdmin->no_telp
                ]
            ], 201);
        }

        return redirect()->route('admin.user.index')->with('success', 'Admin registered successfully!');
    }


    public function login(request $request){
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (!Auth::guard('user')->attempt($validator)) {
            return response()->json([
                'success' => false,
                'message' => 'email atau password salah',
            ],400);
        }


        $admin = Auth::guard('user')->user();

        $kantin = DB::table('kantins')
            ->where('id_admin', $admin->id_admin)
            ->first();

        $id_admin = $kantin ? $kantin->id_admin : null;

        if (!$id_admin) {
            return response()-> json([
                'success' => false,
                'message' => "Silakan Hubungi Admin Untuk Pendaftaran Kantin",
                'status' => 'user',
                'data' => [
                    'id' => $admin->id_admin,
                    'nama_admin' => $admin->nama_admin,
                    'email' => $admin->email,
                    'no_telp' => $admin->no_telp
                ]
            ]);
        } else {
            return response([
                'success' => true,
                'message' => 'berhasil login',
                'status' => 'user',
                'data' => [
                    'id' => $kantin->id_kantin,
                    'nama_admin' => $admin->nama_admin,
                    'email' => $admin->email,
                    'no_telp' => $admin->no_telp
                ]
            ]);
        }
    }
}
