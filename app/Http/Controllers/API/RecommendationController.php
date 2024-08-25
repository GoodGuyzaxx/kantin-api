<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    public function index(){

    }

    public function sumRating($id_konsumen){
        $ratings = DB::table('ratings')
            ->where('id_konsumen', $id_konsumen)
            ->groupBy('id_menu')
            ->selectRaw('POWER(AVG(rating), 2) as rating')
            ->get();
        $value = 0;
        foreach($ratings as $rating){
            $value = $value + $rating->$ratings;
        }
        return response()->json($value);
    }

    public function reviewMatrix (){
        $truncate_review_matrix = DB::table('review_matrix')->truncate();
        $konsumen = DB::table('konsumens')->get();

        foreach ($konsumen as $konsumen) {
            $reviews = DB::table('ratings')
                ->where('id_konsumen', $konsumen->id_konsumen)
                ->groupBy('id_menu')
                ->selectRaw('AVG(rating) as rating, id_konsumen, id_menu')
                ->get();
            $sum_rating = self::sumRating($konsumen->id_konsumen);

            if ($reviews != null){
                $root_sum_rating = sqrt($sum_rating);
                foreach ($reviews as $review){
                    if ($review->id_konsumen == null || $review->id_menu == null) {
                        //todo return response
                    }
                    $review_value = $review->rating / $root_sum_rating;
                    DB::table('review_matrix')->insert([
                        'id_konsumen' => $review->id_konsumen,
                        'id_menu' => $review->id_menu,
                        'value' => $review_value,
                    ]);
                    //todo return response
                }
            } else {
                //todo return response
            }
        }
        return "DONE";
    }

    public function neighbor()
    {
        $truncate_neighbor = DB::table('neighbors')->truncate();

        $konsumens = DB::table('review_matrix')
            ->groupBy('id_konsumen')
            ->get();

        foreach ($konsumens as $konsumen) {
        }
    }


}
