<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {

    }

    public function register(Request $request){
        $validate = $request->validate([
            'nama_admin' => 'required',
            'email' => 'required|unique:admins,email',
            'no_telp' => 'required',
            'password' => 'required',
        ]);

        $validate['password'] = Hash::make($request->password);

        $tbAdmin = Admin::create($validate);

        return response()->json([
            'data' => $tbAdmin
        ],201);
    }

    public function login(request $request){
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (!Auth::guard('admin')->attempt($validator)) {
            return response()->json([
                'success' => false,
                'message' => 'email atau password salah',
            ]);
        }

        $admin = Auth::guard('admin')->user();
        return response([
            'success' => true,
            'message' => 'berhasil login',
            'status' => 'admin',
            'data' => [
                'id' => $admin->id_admin,
                'nama_admin' => $admin->nama_admin,
                'email' => $admin->email,
                'no_telp' => $admin->no_telp
            ]
        ]);
    }
}
