<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', 'ProductController@index')->name('homepage');
Route::get('/search', 'ProductController@search')->name('search');
Route::get('/movies/{slug}', 'ProductController@showSingle')->name('product.single');

Route::get('/home', 'HomeController@index')->name('home');

Route::get("/test", "TestController@test")->name("test");
Route::post("/test", "TestController@test")->name("test");

// front-end testing purposes
Route::get("/pavle/{route}", function () {

    return view('pavle.' . request()->route);
});