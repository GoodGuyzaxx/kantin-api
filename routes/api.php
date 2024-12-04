<?php

use App\Http\Controllers\API\KantinController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OrderPaymentController;
use App\Http\Controllers\HandlerPaymentNotifController;
use App\Http\Controllers\API\KonsumenController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\TransaksiController;

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
route::patch('konsumen/{id}', [KonsumenController::class,'update']);

Route::post('admin/login', [AdminController::class, 'login']) ->name('login');
Route::post('admin/register', [AdminController::class, 'register']);

Route::get('rating', [RatingController::class, 'index']);
Route::post('rating', [RatingController::class, 'store']);
Route::get('rating/menu/{id_menu}', [RatingController::class, 'show']);
Route::get('rating/{id_konsumen}/{id_menu}', [RatingController::class, 'indexById']);
Route::patch('rating/{id_konsumen}/{id_menu}', [RatingController::class, 'updateRating']);

Route::post('transaksi', [TransaksiController::class, 'store']);
Route::get('transaksi/id/{id}', [TransaksiController::class, 'show']);
Route::get('transaksi/email/{email}', [TransaksiController::class, 'showByEmail']);
Route::get('transaksi/status/{id}/{status}', [TransaksiController::class, 'showByIdStatus']);
Route::get('transaksi/kantin/{id}', [TransaksiController::class, 'getTotalHargaByKantin']);
Route::patch('transaksi/id/{id}', [TransaksiController::class, 'updateStatus']);

Route::get('kantin', [KantinController::class, 'index']);

Route::get('orders/{email}', [OrderPaymentController::class, 'getByEmail']);
Route::get('order/id/{id}', [OrderPaymentController::class, 'showOrderId']);
Route::post('order/buy', [OrderPaymentController::class, 'buy']);
Route::post('midtrans/notif-hook',[HandlerPaymentNotifController::class,'__invoke']);

//Menu Route
/* add this code for req token
 * -> middleware('auth:api')
 * */
//Route::apiResource('menu', MenuController::class);
Route::post('menu', [MenuController::class, 'store']);
Route::delete('menu/{id}', [MenuController::class, 'destroy']);
Route::patch('menu/{id}', [MenuController::class, 'update']);

Route::get('rekomendasi/menu', [\App\Http\Controllers\API\RecommendationController::class, 'index']);

Route::get('menu', [MenuController::class, 'index']);
Route::get('menu/{id}', [MenuController::class, 'show']);
Route::get('menu/kantin/{id}', [MenuController::class, 'indexByIdKantin']);
Route::get('kategori/{kategori}',[MenuController::class, 'indexByKategori']);
Route::get('kategori/{ketegori}/kantin/{id}', [MenuController::class, 'indexMenuWithId']);
Route::get('kategori/{ketegori}/kantin/{id}', [MenuController::class, 'indexMenuWithId']);
