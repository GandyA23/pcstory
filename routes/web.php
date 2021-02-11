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

Route::get('/home', "ComputerController@index")->name('home');

Route::group(['prefix' => 'os'], function() {
    Route::get('/', "OsController@index")->name('os')->middleware('auth');
    Route::post('/store', "OsController@store")->name('store-os')->middleware('auth');
    Route::get('/destroy/{os}', "OsController@delete")->name('destroy-os')->middleware('auth');
});

Route::group(['prefix' => 'brand'], function() {
    Route::get('/', "BrandController@index")->name('brand')->middleware('auth');
    Route::post('/store', "BrandController@store")->name('store-brand')->middleware('auth');
    Route::get('/destroy/{brand}', "BrandController@delete")->name('destroy-brand')->middleware('auth');
});

Route::group(['prefix' => 'computer'], function() {
    Route::get('/', "ComputerController@index")->name('computer')->middleware('auth');
    Route::post('/store', "ComputerController@store")->name('store-computer')->middleware('auth');
    Route::get('/destroy/{computer}', "ComputerController@delete")->name('destroy-computer')->middleware('auth');
});
