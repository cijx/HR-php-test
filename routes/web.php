<?php

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
})->name('indexPage');

Route::get("/weather", "WeatherController@index")->name('weather');
Route::resource('order','OrderController');
Route::resource('product','ProductController');