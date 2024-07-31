<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuMakananResource;
use App\Models\MenuMakanan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuMakananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = MenuMakanan::all();
        return response([
            'success' => true,
            'message' => "Berhasil mengambil data",
            'data' => MenuMakananResource::collection($menu)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'nama_menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stock' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error'=> $validator -> errors()]);
        }

        $image = null;
        if ($request -> file){
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();
            $image = $fileName.'.'.$extension;
            Storage::putFileAs('public/gambar',$request->file,$image);
        }

        $data['gambar'] = $image;
        $listMakanan = MenuMakanan::create($data);
        return response([
            'message' => 'Berhasil Menambah Menu Makanan',
            'data' => new MenuMakananResource($listMakanan)
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
//        $post = MenuMakanan::findOrFail($id);
//        return response()->json([
//            'message' => 'Berhasil mengambil data',
//            'data' => new MenuMakananResource($post),
//        ]);

        try {
            $port = MenuMakanan::findORFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => new MenuMakananResource($port)
            ],200);
        }catch (ModelNotFoundException $e){
            return Response([
//                $e -> getMessage(),
                'success' => false,
                'message' => "Data Tidak ditemukan"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dataPost = $request->all();
        $post = MenuMakanan::findOrfail($id);
        $image = $post->gambar;

        if ($request -> file){
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();
            $image = $fileName.'.'.$extension;
            Storage::putFileAs('public/gambar',$request->file,$image);
        }
        $dataPost['gambar'] = $image;
        $post->update($dataPost);
        return response([
            'message' => 'Berhasil Mengubah Menu Makanan',
            'data' => new MenuMakananResource($post)
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = MenuMakanan::destroy($id);
        if ($post) {
            return response([
                'success' => true,
                'message' => 'Berhasil Menghapus Menu Makanan',
                'data' => new MenuMakananResource($post)
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Data Tidak ditemukan"
            ]);
        }
    }

    function generateRandomString($length = 40) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
