<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProyekResource;
use App\Models\Proyek;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyek = Proyek::all();
        return response(['proyek' => ProyekResource::collection($proyek), 'message' => 'Retrieved successfully.'],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'nama' => 'required|max:255',
            'harga' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error'=> $validator -> errors(), 'Data nama atau harga salah!!!']);
        }

        $proyek = Proyek::create($data);

        return response(['proyek'=> new ProyekResource($proyek), 'message' => "Data Berhasil ditambahakan"],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyek $proyek)
    {
        return response()->json([
            'message' => 'Retrieved successfully.',
            'data' => new ProyekResource($proyek),
        ]);
//        try {
//            $proyekID = Proyek::find($proyek);
//            return response(['message' => 'Retrieved by id successfully.','proyek'=> new ProyekResource($proyekID)],200);
//        }catch (ModelNotFoundException $e){
//            return Response([
//                $e -> getMessage(),
//                'message' => "Data Tidak ditemukan"
//            ], 404);
//        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyek $proyek)
    {
        $proyek->update($request-> all());
        return response(['proyel'=> new ProyekResource($proyek), 'message' => 'Update successfully.'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyek $proyek)
    {
        $proyek->delete();
        return response(['message' => 'Deleted successfully.'], 200);
    }
}
