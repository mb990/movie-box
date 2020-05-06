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

//Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/', 'ProductController@index')->name('homepage.trending');
Route::get('/new', 'ProductController@new')->name('homepage.new');
Route::get('/top', 'ProductController@topRated')->name('homepage.top');
Route::get('/movies', 'ProductController@showList')->name('products.list');
Route::get('/movies/sorted/{sort}', 'ProductController@sorted')->name('products.sorted');
Route::get('/search', 'ProductSearchController@index')->name('search');
Route::get('/movies/{slug}', 'ProductController@showSingle')->name('product.single');
Route::get('/movies/filtered/results', 'ProductController@showFiltered')->name('products.filtered');
Route::get('/movies/{slug}/add', 'WishlistController@addMovie')->name('product.add');
Route::get('/movies/{slug}/remove', 'WishlistController@removeMovie')->name('product.remove');

Route::get('/wishlist', 'WishlistController@index')->name('wishlist')->middleware('auth');

Route::get('/contact', 'PageController@contact')->name('contact');

Route::get("/test", "TestController@test")->name("test");
Route::post("/test", "TestController@test")->name("test");

// front-end testing purposes
Route::get("/pavle/{route}", function () {

    return view('pavle.' . request()->route);
});
