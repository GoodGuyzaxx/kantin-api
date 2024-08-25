<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Kantin;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request){
        $dataRequest = $request->all();
        $validate = Validator::make($dataRequest, [
           'id_admin' => 'required',
           'nama_kantin' => 'required',

        ]);
    }

    public function update(Request $request, $id)
    {
        $dataReuset = $request->all();


    }
}
