<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = Rating::all();
        return response()->json([
            'success' => true,
            'data' => $ratings
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validtaor = Validator::make($data, [
            'id_konsumen' => 'required',
            'id_menu' => 'required',
            'rating' => 'required'
        ]);

        if ($validtaor->fails()) {
            return response(['error' => $validtaor -> errors()]);
        }

        $postRating = Rating::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil Menambahakan Rating',
            'data' =>  $postRating
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
