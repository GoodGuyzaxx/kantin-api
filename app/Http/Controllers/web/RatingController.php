<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Rating::join('menus', 'menus.id_menu', '=', 'ratings.id_menu')
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
    public function show(rating $rating, $id)
    {
        $data = Rating::join('konsumens', 'konsumens.id_konsumen', '=', 'ratings.id_konsumen')
            ->where('ratings.id', $id)
            ->firstOrFail();
        return view('pages.admin.rating.edit', compact('data'));
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
    public function update(Request $request, $id_rating)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = [
            'rating' => $request->input('rating'),
        ];


        $update = Rating::where('id', $id_rating)->update($data);

//        \Log::info("Rating update: ID={$id_rating}, Saved={$update}");


        if ($update) {
            return redirect()->route('admin.rating.index')->with('success', 'Rating berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui rating!');
        }
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
