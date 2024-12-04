<?php
namespace App\Http\Requests;

use App\Models\Konsumen;
use App\Models\Menu;
use App\Models\Rating;
use Illuminate\Support\Facades\Log;


class CollaborativeFilteringService
{
    public function getRecommendations($numRecommendations = 5)
    {
        // Ambil semua rating
        $ratings = Rating::all();
        $konsumens = Konsumen::all();

        // Buat matriks konsumen-item
        $konsumenItemMatrix = [];


        foreach ($ratings as $rating) {
            $konsumenItemMatrix[$rating->id_konsumen][$rating->id_menu] = $rating->rating;
        }


        // Periksa apakah konsumen saat ini memiliki rating
        if (!isset($konsumenItemMatrix[$rating->id_konsumen]) || empty($konsumenItemMatrix[$rating->id_konsumen])) {
            // Konsumen belum memberikan rating, berikan rekomendasi berdasarkan rating tertinggi
            return $this->getPopularMenus($numRecommendations);
        }

        // Hitung similarity antara konsumen saat ini dengan konsumen lain
        $similarities = [];
        foreach ($konsumenItemMatrix as $otherKonsumenId => $otherKonsumenRatings) {
            if ($otherKonsumenId != $rating->id_konsumen) {
                $similarities[$otherKonsumenId] = $this->calculateCosineSimilarity($konsumenItemMatrix[$rating->id_konsumen], $otherKonsumenRatings);
            }
        }

        // Urutkan similarities dari yang tertinggi
        arsort($similarities);

        Log::info('data Sim', $similarities);

        // Ambil top N similar konsumen
        $topSimilarKonsumen = array_slice($similarities, 0, 10, true);
        Log::info('top sim', $topSimilarKonsumen);

        // Hitung prediksi rating untuk item yang belum dirating oleh konsumen
        $predictions = [];
        $ratedMenus = array_keys($konsumenItemMatrix[$rating->id_konsumen]);
        $allMenus = Menu::pluck('id_menu')->toArray();
        $unratedMenus = array_diff($allMenus, $ratedMenus);
        Log::info('menu Unrated', $unratedMenus);

        foreach ($unratedMenus as $menuId) {
            $numerator = 0;
            $denominator = 0;
            foreach ($topSimilarKonsumen as $similarKonsumenId => $similarity) {
                if (isset($konsumenItemMatrix[$similarKonsumenId][$menuId])) {
                    $numerator += $similarity * $konsumenItemMatrix[$similarKonsumenId][$menuId];
                    $denominator += abs($similarity);
                }
            }
            if ($denominator > 0) {
                $predictions[$menuId] = $numerator / $denominator;
            }
        }

        // Urutkan prediksi dari yang tertinggi
        arsort($predictions);
        Log::info('prediksi',$predictions);

        // Convert predictions to an array if it’s a collection
//        $predictionsArray = is_array($predictions) ? $predictions : $predictions->toArray();

        // Ambil top N rekomendasi
        $recommendations = array_slice($predictions, 0, $numRecommendations, true);


        // Save the recommendations into the database
        foreach ($recommendations as $menuId => $predictedRating) {
            \App\Models\Recommendation::updateOrCreate(
                [
                    'id_menu' => $menuId
                ],
                [
                    'predicted_rating' => $predictedRating
                ]
            );
        }

        return $recommendations;
    }
    private function calculateCosineSimilarity($ratings1, $ratings2)
    {
        $sharedItems = array_intersect_key($ratings1, $ratings2);

        if (empty($sharedItems)) {
            return 0;
        }

        $numerator = 0;
        $magnitude1 = 0;
        $magnitude2 = 0;

        foreach ($sharedItems as $itemId => $rating1) {
            $rating2 = $ratings2[$itemId];
            $numerator += $rating1 * $rating2;
            $magnitude1 += pow($rating1, 2);
            $magnitude2 += pow($rating2, 2);
        }

        $magnitude = sqrt($magnitude1) * sqrt($magnitude2);

        return $magnitude > 0 ? $numerator / $magnitude : 0;
    }

    private function getPopularMenus($numRecommendations)
    {
        // Ambil menu dengan rating rata-rata tertinggi
        $popularMenus = Menu::withAvg('ratings', 'rating')
            ->orderByDesc('ratings_avg_rating')
            ->take($numRecommendations)
            ->pluck('ratings_avg_rating', 'id_menu')
            ->toArray();

        return $popularMenus;

    }
}
