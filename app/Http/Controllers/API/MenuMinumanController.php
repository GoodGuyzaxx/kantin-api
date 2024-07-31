<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuMakananResource;
use App\Http\Resources\MenuMinumanResource;
use App\Models\MenuMinuman;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuMinumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postAll = MenuMinuman::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data',
            'listminuman' => MenuMinumanResource::collection($postAll)
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'nama_minuman' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stock' => 'required',
        ]);

        if ($validator->fails()){
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
        $postMinuman = MenuMinuman::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menyimpan data',
            'data' => new MenuMinumanResource($postMinuman)
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $post = MenuMinuman::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => new MenuMinumanResource($post)
            ],200);
        } catch (ModelNotFoundException $e) {
            return response([
               'success' => false,
                'message' => 'Data Tidak Ditemukan',
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dataPost = $request->all();
        $data = MenuMinuman::findOrFail($id);
        $image = $data->gambar;
        if ($request -> file){
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();
            $image = $fileName.'.'.$extension;
            Storage::putFileAs('public/gambar',$request->file,$image);
        }
        $dataPost['gambar'] = $image;
        $data->update($dataPost);
        return response([
            'message' => 'Berhasil Mengubah Menu Makanan',
            'data' => new MenuMakananResource($data)
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $postData = MenuMinuman::destroy($id);
        if ($postData) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
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
