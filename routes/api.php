<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('books', 'BookController')->only('store');
Route::resource('books/searches', 'BookSearchController')->only('store');
Route::resource('categories', 'CategoryController')->only('index');
Route::resource('categories/searches', 'CategorySearchController')->only('store');
