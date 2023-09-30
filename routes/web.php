<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\Dashboard\DefaultController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['auth'], 'prefix' => 'hakakses', 'as' => ''], function () {
    Route::resource('datakaryawan', '\App\Http\Controllers\HakAkses\DataKaryawanController');
});

// CATATAN

// Route::get('/kunjungan', 'kunjunganController@index')->name('landing.kunjungan');
