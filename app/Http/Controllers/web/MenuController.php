<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        $data = Menu::join('kantins', 'kantins.id_kantin', '=', 'menus.id_kantin')->get();
        return view('pages.admin.menu.data',[
            'title' => "Menu",
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $data = Menu::find($id);

        if ($data){
            $data->delete();
        }
        return redirect()->route('admin.menu.index')->with('success','Menu berhasil dihapus');
    }
}
