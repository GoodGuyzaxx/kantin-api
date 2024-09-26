<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollaborativeFilteringService;
use App\Models\Menu;
use App\Models\Konsumen;
use App\Models\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{

//    protected $collaborativeFilteringService;

//    public function __construct(CollaborativeFilteringService $collaborativeFilteringService)
//    {
//        $this->collaborativeFilteringService = $collaborativeFilteringService;
//    }
//
//    public function getRecommendations(Request $request)
//    {
//        // Assume the authenticated user is the "Konsumen"
//        $konsumen = $request->user()->konsumen;
//
//        // Fetch recommendations for the konsumen
//        $recommendations = $this->collaborativeFilteringService->getRecommendations($konsumen);
//
//        // Load the recommended menus from the database
//        $recommendedMenus = \App\Models\Menu::whereIn('id_menu', array_keys($recommendations))->get();
//
//        // Pass the recommended menus to the view
//        return view('recommendations', compact('recommendedMenus'));
//    }


    protected $cfService;

    public function __construct(CollaborativeFilteringService $cfService)
    {
        $this->cfService = $cfService;
    }


//
    public function getRecommendations(Request $request)
    {

            $recommendations = $this->cfService->getRecommendations();
//            $recommendedMenus = Menu::whereIn('id_menu',array_keys($recommendations))->get();
        $recommendedMenus = Recommendation::join('menus', 'recommendations.id_menu', '=', 'menus.id_menu')->get();

        return view('pages.recommendations', compact('recommendedMenus'));
    }

    private function getPopularMenus()
    {
        // Implementasi untuk mendapatkan menu populer
        return Menu::withCount('ratings')
            ->orderByDesc('ratings_count')
            ->take(5)
            ->get();
    }
}
