<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(){
        $data = Menu::join('kantins', 'kantins.id_kantin', '=', 'menus.id_kantin')->get();
        return view('pages.admin.menu.data',[
            'title' => "Menu",
            'data' => $data
        ]);
    }

    public function show($id){

        $data = Menu::join('kantins','kantins.id_kantin','=','menus.id_kantin')
            ->where('menus.id_menu',$id)
            ->firstOrFail();
        return view('pages.admin.menu.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kantin' => 'required',
            'nama_menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stock' => 'required|integer',
            'kategori' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', // optional if updating
        ]);

        $dataPost = $request->all();
        $post = Menu::findOrFail($id);
        $image = $post->gambar;

        if ($request->hasFile('file')) {
            // Delete old image
            if ($post->gambar) {
                Storage::delete('public/gambar/' . $post->gambar);
            }

            $fileName = $this->generateRandomString();
            $extension = $request->file('file')->extension();
            $image = $fileName . '.' . $extension;
            Storage::putFileAs('public/gambar', $request->file('file'), $image);
        }

        $dataPost['gambar'] = $image;
        $post->update($dataPost);

        return redirect()->route('admin.menu.index')->with('success', 'Berhasil Mengubah Menu');
    }

    public function destroy($id)
    {
        $data = Menu::find($id);

        if ($data){
            $data->delete();
        }
        return redirect()->route('admin.menu.index')->with('success','Menu berhasil dihapus');
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
