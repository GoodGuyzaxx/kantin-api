<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuMakananResource;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Models\MenuMakanan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = Menu::all();
        if ($menu->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "Data Tidak Ditemukan",
            ],404);
        }
        return response([
            'success' => true,
            'message' => "Berhasil mengambil data",
            'data' => MenuResource::collection($menu)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'id_kantin' => 'required',
            'nama_menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stock' => 'required',
            'kategori' => 'required'
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
        $listMakanan = Menu::create($data);
        return response([
            'success' => true,
            'message' => 'Berhasil Menambah Menu Makanan',
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
            $port = Menu::where('id_menu',$id)->get();
//            if ($port->isEMpty()){
//                return Response([
//                    'success' => false,
//                    'message' => "Data Tidak ditemukan"
//                ], 404);
//            }
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => MenuResource::collection($port)
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
        $post = Menu::findOrFail($id);
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
            'success' => true,
            'message' => 'Berhasil Mengubah Menu',
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if ($menu) {
            if ($menu->gambar) {
                try {
                    Storage::delete('public/gambar/' . $menu->gambar);
                } catch (\Exception $e) {

                    Log::error('Failed to delete image: ' . $e->getMessage());
                }
            }

            // Delete the menu data
            $menu->delete();

            return response([
                'success' => true,
                'message' => 'Berhasil Menghapus Menu Makanan',
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Data Tidak ditemukan"
            ], 404);
        }
    }

    public function indexByIdKantin($id)
    {
        $menu = Menu::where('id_kantin',$id)->get();
        if ($menu->isEmpty()){
            return Response([
                'success' => false,
                'message' => "Data Kantin tidak ditemukan",
            ]);
        }

        return response([
            'success' => true,
            'message' => "Berhasil mengambil data",
            'data' => MenuResource::collection($menu)
        ], 200);

    }

    public function indexByKategori($kategori){
        $data = DB::table('menus')
        ->where('kategori',$kategori)
        ->get();
        return Response()->json([
            'success' => true,
            'message' => "Berhasil mengambil data",
            'data'=> MenuResource::collection($data),
        ]);
    }
    public function indexMenuWithId($kategori,$id){
        $data = DB::table('menus')
            ->where('id_kantin', $id)
            ->where('kategori',$kategori)
            ->get();
        return Response()->json([
            'success' => true,
            'message' => "Berhasil mengambil data",
            'data'=> MenuResource::collection($data),
        ]);
    }



    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
