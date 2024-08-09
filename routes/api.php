<?php

use App\Http\Controllers\API\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProyekController;
use App\Http\Controllers\API\KonsumenController;
use App\Http\Controllers\API\AdminController;

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
Route::get('login', [AuthController::class, 'index']);
Route::get('register', [AuthController::class, 'index']);

Route::post('konsumen/register', [KonsumenController::class, 'register']);
Route::post('konsumen/login', [KonsumenController::class, 'login']) -> name('login');

Route::post('admin/login', [AdminController::class, 'login']) ->name('login');
Route::post('admin/register', [AdminController::class, 'register']);


Route::post('order/buy', [\App\Http\Controllers\API\OrderPaymentController::class, 'buy']);
Route::post('midtrans/notif-hook',[\App\Http\Controllers\HandlerPaymentNotifController::class,'__invoke']);

//Menu Route
/* add this code for req token
 * -> middleware('auth:api')
 * */
//Route::apiResource('menu', MenuController::class);
Route::post('menu', [MenuController::class, 'store']);
Route::delete('menu/{id}', [MenuController::class, 'destroy']);
Route::patch('menu/{id}', [MenuController::class, 'update']);
Route::get('menu', [MenuController::class, 'index']);
Route::get('menu/{id}', [MenuController::class, 'show']);
Route::get('menu/kantin/{id}', [MenuController::class, 'indexByIdKantin']);
Route::get('{kategori}',[MenuController::class, 'indexByKategori']);
