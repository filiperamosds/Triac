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
    return view('home');
});

Route::resource('client', 'App\Http\Controllers\ClientController');
Route::get('print/{id}', 'App\Http\Controllers\OrderController@print');
// Route::resource('order/{client}', 'App\Http\Controllers\OrderController');
Route::get('orderList', 'App\Http\Controllers\OrderController@list');
Route::get('order/{client}', 'App\Http\Controllers\OrderController@index');
Route::post('order', 'App\Http\Controllers\OrderController@store');
Route::post('orderRemove', 'App\Http\Controllers\OrderController@remove');
Route::post('orderSituacao', 'App\Http\Controllers\OrderController@situacao');
Route::post('orderDelete', 'App\Http\Controllers\OrderController@destroy');
