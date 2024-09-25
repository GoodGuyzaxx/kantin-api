<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    public function index()
    {
        $recommendations = Recommendation::with('menu.kantin')->get();

        if ($recommendations->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data Rekomendasi Tidak Ditemukan',
            ]);
        }

        $formattedData = $recommendations->map(function ($recommendation) {
            $menuData = $recommendation->menu;

            return [
                'id_rekomendasi' => $recommendation->id,
                'id_menu' => $recommendation->id_menu,
                'rating' => $recommendation->predicted_rating,
                'nama' => $menuData->nama_menu,
                'deskripsi' => $menuData->deskripsi,
                'harga' => $menuData->harga,
                'gambar' => env('STORAGE_LOCATION').'storage/gambar/'.$menuData->gambar,
                'nama_kantin' => $menuData->kantin ? $menuData->kantin->nama_kantin : null,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Data Rekomendasi Berhasil Diambil',
            'data'    => $formattedData
        ]);
    }

}
