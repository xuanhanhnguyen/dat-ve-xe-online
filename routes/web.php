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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController');
Route::get('/post/{id}', 'HomeController@post')->name('post');
Route::get('/search', 'SearchController');
Route::post('/book', 'HomeController@book')->name('home.book');

Auth::routes();

Route::group(['namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('/admin', 'AdminController@index');

    Route::group(['prefix' => 'admin'], function () {
        Route::resource('/users', 'UserController');
        Route::resource('/brands', 'BrandController');
        Route::resource('/utilities', 'UtilityController');
        Route::resource('/places', 'PlaceController');
        Route::resource('/posts', 'PostController');
        Route::resource('/books', 'BookController');
        Route::resource('/cars', 'CarController');
    });
});

