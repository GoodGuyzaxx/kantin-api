<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\web\RecommendationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::redirect('home', 'dashboard');

Route::get('/login',  [\App\Http\Controllers\web\LoginController::class, 'index'])->middleware('guest:web')->name('login.index');
Route::post('/login',  [\App\Http\Controllers\web\LoginController::class, 'authenticate']);
Route::post('/logout', [\App\Http\Controllers\web\LoginController::class, 'logout'])->name('logout');

Route::group(['perfix' => 'admin','middleware' => ['auth:web'], 'as' => 'admin.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    //ADMIN
    route::get('/user', [\App\Http\Controllers\web\AdminController::class, 'index'])->name('user.index');
    route::get('/user/create', [AdminController::class, 'index'])->name('create');
    route::post('/user/register', [AdminController::class, 'register'])->name('register');
    route::delete("user/delete/{id}", [\App\Http\Controllers\web\AdminController::class, 'destroy'])->name('delete');
    route::get("user/edit/{id}", [\App\Http\Controllers\web\AdminController::class, 'edit'])->name('edit');
    route::put("user/update/{id}", [\App\Http\Controllers\web\AdminController::class, 'update'])->name('update');


    //KANTIN
    route::get('/kantin', [\App\Http\Controllers\web\KantinController::class, 'index'])->name('kantin.index');
    route::get('/kantin/create', [\App\Http\Controllers\web\KantinController::class, 'create'])->name('kantin.create');
    route::post('/kantin/register', [\App\Http\Controllers\web\KantinController::class, 'store'])->name('kantin.register');
    route::delete('/kantin/delete/{id}', [\App\Http\Controllers\web\KantinController::class, 'destroy'])->name('kantin.delete');
    route::get('/kantin/edit/{id}', [\App\Http\Controllers\web\KantinController::class, 'edit'])->name('kantin.edit');
    route::put('/kantin/update/{id}', [\App\Http\Controllers\web\KantinController::class, 'update'])->name('kantin.update');


    //Konsumen
    route::get('/konsumen', [\App\Http\Controllers\web\KonsumenController::class, 'index'])->name('konsumen.index');
    route::get('/konsumen/create', [\App\Http\Controllers\web\KonsumenController::class, 'create'])->name('konsumen.create');
    route::get('/konsumen/edit/{id}', [\App\Http\Controllers\web\KonsumenController::class, 'edit'])->name('konsumen.edit');
    route::put('/konsumen/edit/{id}', [\App\Http\Controllers\web\KonsumenController::class, 'update'])->name('konsumen.update');
    route::post('/konsumen/register', [\App\Http\Controllers\web\KonsumenController::class, 'store'])->name('konsumen.register');

    //Rekomendasi
    route::get('/recommendations', [RecommendationController::class, 'getRecommendations'])->name('recommendations');
});

