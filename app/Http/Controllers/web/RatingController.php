<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = rating::join('menus', 'menus.id_menu', '=', 'ratings.id_menu')
            ->join('konsumens', 'konsumens.id_konsumen', '=', 'ratings.id_konsumen')
            ->join('kantins', 'kantins.id_kantin', '=', 'menus.id_kantin')
            ->get();
        return view('pages.admin.rating.data',[
            'title' => "Data Rating",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rating $rating, $id)
    {
        $data = Rating::find($id);

        if ($data) {
            $data->delete();
        }
        return redirect()->route('admin.rating.index')->with('success', 'Data Berhasil Dihapus');
    }
}
