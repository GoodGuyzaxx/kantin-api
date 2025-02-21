<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\isEmpty;

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
    public function show($id_menu)
    {
        $rating = DB::table('ratings')
            ->where('id_menu', $id_menu)
            ->join('konsumens','konsumens.id_konsumen', '=', 'ratings.id_konsumen')
            ->select('ratings.rating', 'konsumens.nama_konsumen', 'ratings.created_at','ratings.updated_at')
            ->get();

        if ($rating->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Rating Tidak Ditemukan',
            ]);
        } else {
            return response()->json([
                'success' => true,
                'data' =>$rating
            ]);
        }
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

    public function indexById($id_konsumen,$id_menu)
    {

        $ratings = DB::table('ratings')
            ->where('id_konsumen', $id_konsumen)
            ->where('id_menu', $id_menu)
            ->get();

        if ($ratings->isNotEmpty()){
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengambil Data',
                'data' => $ratings
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Data rating tidak ditemukan',
            ], 200);
        }
    }

    public function updateRating($id_konsumen, $id_menu) {
        $request = $this->validate(request(), [
            'rating' => 'required|integer|min:1|max:5',
        ]);
        try {
            $rating = Rating::where('id_konsumen', $id_konsumen)
                ->where('id_menu', $id_menu)
                ->first();

            if (!$rating) {
                return response()->json([
                    'success' => false,
                    'message' => 'Rating not found'
                ], 404);
            }

            $rating->rating = $request['rating'];
            $rating->updated_at = now();
            $rating->save();

            return response()->json([
                'success' => true,
                'message' => 'Rating updated successfully',
                'data' => $rating
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update rating: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getRatingStatus(Request $request){
        // Validasi request
        $request->validate([
            'id_konsumen' => 'required|integer',
            'id_menu' => 'required|integer',
            'status_pesanan' => 'required|string|in:Diterima,Diproses,Dibatalkan,selesai',
        ]);

        // Ambil data berdasarkan parameter yang dikirim
        $status = DB::table('ratings')
            ->join('menus', 'ratings.id_menu', '=', 'menus.id_menu')
            ->join('transaksis', 'menus.id_kantin', '=', 'transaksis.id_kantin')
            ->where('ratings.id_konsumen', $request->id_konsumen)
            ->where('ratings.id_menu', $request->id_menu)
            ->where('transaksis.status_pesanan', $request->status_pesanan)
            ->select('transaksis.status_pesanan')
            ->select('transaksis.nama_konsumen')
            ->first();

        // Cek apakah data ditemukan
        if ($status) {
            return response()->json([
                'success' => true,
                'message' => 'Status pesanan ditemukan',
                'data' => $status
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }
    }

}
