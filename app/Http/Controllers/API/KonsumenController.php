<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KonsumenController extends Controller
{
    public function register(Request $request) {
        $validate = $request->validate([
            'nama_konsumen' => 'required',
            'email' => 'required|unique:konsumens,email',
            'password' => 'required',
            'no_telp' => 'required',
        ]);

        $validate['password'] = Hash::make($request->password);

        $user = Konsumen::create($validate);

        return response()->json([
            'data' => $user
        ],201);
    }

    public function login(Request $request) {

        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::guard('konsumen')->attempt($validator)) {
            return response()->json([
                'success' => false,
                'message' => 'email atau password salah',
            ]);
        }

        $user = Auth::guard('konsumen')->user();

        return response([
            'success' => true,
            'message' => 'berhasil login',
            'data' => [
                'nama_konsumen' => $user->nama_konsumen,
                'email' => $user->email,
                'no_telp' => $user->no_telp
            ]
        ]);


    }
}
