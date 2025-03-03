<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Kantin;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\error;

class KantinController extends Controller
{
    public function index(){
        $dataKantin  = Kantin::all();
        $adminEmail = Admin::whereIn('id_admin', $dataKantin
            ->pluck('id_admin'))
            ->pluck('email', 'id_admin');

        $result = $dataKantin->map(function ($kantin) use ($adminEmail) {
            return [
                'id' => $kantin->id_kantin,
                'nama_kantin' => $kantin->nama_kantin,
                'id_admin' => $kantin->id_admin,
                // tambahkan field kantin lainnya yang diperlukan
                'admin_email' => $adminEmail[$kantin->id_admin] ?? null
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $result
        ], 200);

    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_kantin' => 'required',
            'id_admin' => 'required',
        ]);

        // Check if admin exists in Admin model
        $adminExists = Admin::where('id_admin', $request->id_admin)->exists();

        if (!$adminExists) {
            return response()->json([
                'success' => false,
                'message' => 'Admin tidak ditemukan'
            ]);
        }

        // If admin exists, proceed with storing data
        $kantin = new Kantin();
        $kantin->nama_kantin = $request->nama_kantin;
        $kantin->id_admin = $request->id_admin;
        $kantin->save();

        return response()->json([
            'success' => true,
            'data' => $kantin
        ]);
    }

    public function update(Request $request, $id)
    {
        $dataReuset = $request->all();


    }
}
