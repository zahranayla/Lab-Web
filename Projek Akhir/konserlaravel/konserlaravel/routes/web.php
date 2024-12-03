<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EoController;
use App\Http\Controllers\Home;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenjualController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

// Route::get('/kategori', [KategoriController::class,'index']);

Route::controller(AdminController::class)->group(function () {
    Route::get('admin', 'index');
    Route::get('admin/eventdaftar', 'eventdaftar');
    Route::get('admin/eventtambah', 'eventtambah');
    Route::get('admin/eventedit/{id}', 'eventedit');
    Route::post('admin/eventtambahsimpan', 'eventtambahsimpan');
    Route::post('admin/eventeditsimpan/{id}', 'eventeditsimpan');
    Route::get('admin/eventhapus/{id}', 'eventhapus');
    Route::get('admin/pesertadaftar/{id}', 'pesertadaftar');
    Route::get('admin/pesertadetail/{id}', 'pesertadetail');
    Route::post('admin/pesertastatusupdate/{id}', 'pesertastatusupdate');
    Route::get('admin/pesertahapus/{id}', 'pesertahapus');
    Route::get('admin/logout', 'logout');
    Route::get('admin/eodaftar', 'eodaftar');
    Route::get('admin/eotambah', 'eotambah');
    Route::get('admin/eoedit/{id}', 'eoedit');
    Route::post('admin/eotambahsimpan', 'eotambahsimpan');
    Route::post('admin/eoeditsimpan/{id}', 'eoeditsimpan');
    Route::get('admin/eohapus/{id}', 'eohapus');

    Route::get('admin/userdaftar', 'userdaftar');
    Route::get('admin/usertambah', 'usertambah');
    Route::get('admin/useredit/{id}', 'useredit');
    Route::post('admin/usertambahsimpan', 'usertambahsimpan');
    Route::post('admin/usereditsimpan/{id}', 'usereditsimpan');
    Route::get('admin/userhapus/{id}', 'userhapus');

});


Route::controller(EoController::class)->group(function () {
    Route::get('eo', 'index');
    Route::get('eo/eventdaftar', 'eventdaftar');
    Route::get('eo/eventtambah', 'eventtambah');
    Route::get('eo/eventedit/{id}', 'eventedit');
    Route::post('eo/eventtambahsimpan', 'eventtambahsimpan');
    Route::post('eo/eventeditsimpan/{id}', 'eventeditsimpan');
    Route::get('eo/eventhapus/{id}', 'eventhapus');
    Route::get('eo/pesertahapus/{id}', 'pesertahapus');
    Route::get('eo/pesertadaftar/{id}', 'pesertadaftar');
    Route::get('eo/pesertadetail/{id}', 'pesertadetail');
    Route::post('eo/pesertastatusupdate/{id}', 'pesertastatusupdate');

    Route::get('eo/logout', 'logout');

});

Route::controller(HomeController::class)->group(function () {
    Route::get('home', 'index');
    Route::get('home/event', 'event');
    Route::get('home/detail/{id}', 'detail');
    Route::get('home/search', 'search')->name('event.search');


    Route::get('home/login', 'login');
    Route::post('home/dologin', 'dologin');
    Route::get('home/daftar', 'daftar');
    Route::post('home/dodaftar', 'dodaftar');

    Route::get('home/akun', 'akun');
    Route::post('home/ubahakun/{id}', 'ubahakun');

    Route::post('home/favorit','favorit');
    Route::post('home/hapusFavorit','hapusFavorit');
    Route::get('home/favoritdaftar','favoritdaftar');

    Route::get('home/riwayat', 'riwayat');
    Route::get('home/logout', 'logout');

    Route::post('home/pesan', 'pesan');
    Route::get('home/invoice/{id}', 'invoice');
    Route::get('home/detailtransaksi/{id}', 'detailtransaksi');
    Route::post('home/pembayaransimpan', 'pembayaransimpan');
    Route::post('home/selesai', 'selesai');
    Route::post('home/batalkan', 'batalkanPesanan');
    Route::get('home/filter', 'filter');


});
