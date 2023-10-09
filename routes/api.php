<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// HAK AKSES
Route::get('hakakses/datakaryawan/verif/{id}', '\App\Http\Controllers\HakAkses\DataKaryawanController@verifName')->name('datakaryawan.verif');
Route::get('hakakses/datakaryawan/hapus/{id}', '\App\Http\Controllers\HakAkses\DataKaryawanController@hapus')->name('datakaryawan.hapus');

// BERKAS
    // RKA
    Route::get('rka/table', '\App\Http\Controllers\Berkas\RkaController@table');
    Route::get('rka/hapus/{id}', '\App\Http\Controllers\Berkas\RkaController@hapus');
