<?php

use App\Http\Controllers\API\MenuMakananController;
use App\Http\Controllers\API\MenuMinumanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProyekController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Login And Register
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']) -> name('login');

Route::apiResource('proyek', ProyekController::class) -> middleware('auth:api');

//Menu Route
/* add this code for req token
 * -> middleware('auth:api')
 * */
//Route::apiResource('makananlist' , MenuMakananController::class);
Route::post('makanan' , [MenuMakananController::class, 'store']) -> middleware('auth:api');
Route::get('makanan' , [MenuMakananController::class, 'index']);
Route::get('makanan/{id}' , [MenuMakananController::class, 'show']);
Route::patch('makanan/{id}' , [MenuMakananController::class, 'update']) -> middleware('auth:api');
Route::delete('makanan/{id}' , [MenuMakananController::class, 'destroy']);


Route::apiResource('minuman', MenuMinumanController::class);
