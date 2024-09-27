<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kantin;
use App\Models\Konsumen;
use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard',[
            'titel' => 'Dashboard',
            'Admin' => Admin::count(),
            'Konsumen' => Konsumen::count(),
            'Kantin' => Kantin::count(),
            'Menu' =>   Menu::count()
        ]);
    }
}
