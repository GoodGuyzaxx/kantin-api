<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\web\DownloadController;
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
    return view('landing');
})->name('index');

Route::get('/download/apk', [DownloadController::class, 'downloadAPK'])->name('download');

Route::get('/login',  [\App\Http\Controllers\web\LoginController::class, 'index'])->middleware('guest:web')->name('login.index');
Route::post('/login',  [\App\Http\Controllers\web\LoginController::class, 'authenticate']);
Route::post('/logout', [\App\Http\Controllers\web\LoginController::class, 'logout'])->name('logout');

Route::group(['perfix' => 'admin','middleware' => ['auth:web'], 'as' => 'admin.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //SuperAdmin
    route::get('admin', [\App\Http\Controllers\web\UserController::class, 'show'])->name('super.show');
    route::put('admin/update/{id}', [\App\Http\Controllers\web\UserController::class, 'update'])->name('super.update');

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
    route::delete('/konsumen/delete/{id}', [\App\Http\Controllers\web\KonsumenController::class, 'destroy'])->name('konsumen.delete');


    //Menu
    route::get('/menu', [\App\Http\Controllers\web\MenuController::class, 'index'])->name('menu.index');
    route::get('/menu/edit/{id}', [\App\Http\Controllers\web\MenuController::class, 'show'])->name('menu.show');
    route::put('/menu/edit/{id}', [\App\Http\Controllers\web\MenuController::class, 'update'])->name('menu.update');
    route::delete('/menu/delete/{id}', [\App\Http\Controllers\web\MenuController::class, 'destroy'])->name('menu.delete');

    //Kategori
    route::get('kategori', [\App\Http\Controllers\web\KategoriController::class, 'index'])->name('kategori.index');
    route::post('kategori', [\App\Http\Controllers\web\KategoriController::class, 'store'])->name('kategori.create');
    route::get('kategori/data', [\App\Http\Controllers\web\KategoriController::class, 'show'])->name('kategori.show');
    route::delete('kategori/data/{id}', [\App\Http\Controllers\web\KategoriController::class, 'destroy'])->name('kategori.delete');

    //Rating
    route::get('rating', [\App\Http\Controllers\web\RatingController::class, 'index'])->name('rating.index');
    route::get('rating/edit/{id}', [\App\Http\Controllers\web\RatingController::class, 'show'])->name('rating.show');
    route::put('rating/edit/{id}', [\App\Http\Controllers\web\RatingController::class, 'update'])->name('rating.update');
    route::delete('rating/data/{id}', [\App\Http\Controllers\web\RatingController::class, 'destroy'])->name('rating.delete');

    //Transaski
    route::get('transaksi', [\App\Http\Controllers\web\TransaksiController::class, 'index'])->name('transaksi.index');
    route::delete('transaksi/delete/{id}', [\App\Http\Controllers\web\TransaksiController::class, 'destroy'])->name('transaksi.delete');

    route::get('transaksi/kantin',[\App\Http\Controllers\web\TransaksiController::class, 'indexKantin'])->name('transaksi.kantin.index');
    route::get('transaksi/kantin/{nama}',[\App\Http\Controllers\web\TransaksiController::class, 'showDetailKantin'])->name('transaksi.kantin.detail');
    route::get('transaksi/kantin/{nama}/export', [\App\Http\Controllers\web\TransaksiController::class, 'exportTransaksiKantin'])->name('transaksi.kantin.export');

    route::get('transaksi/konsumen', [\App\Http\Controllers\web\TransaksiController::class,'indexKonsumen'])->name('transaksi.konsumen.index');
    route::get('transaksi/konsumen/{nama}', [\App\Http\Controllers\web\TransaksiController::class,'showDetailTransaksi'])->name('transaksi.konsumen.detail');
    Route::get('transaksi/konsumen/{nama}/export', [\App\Http\Controllers\web\TransaksiController::class, 'exportTransaksi'])->name('transaksi.konsumen.export');


    //Rekomendasi
    route::get('/recommendations', [RecommendationController::class, 'getRecommendations'])->name('recommendations');
});

