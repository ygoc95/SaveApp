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


// Guest Routes
Route::view('/','welcome');
Route::get('sign-in/github', 'Auth\LoginController@redirectToProvider');
Route::get('sign-in/github/redirect', 'Auth\LoginController@handleProviderCallback');
//Auth Routes
Auth::routes();
Route::get('/item', 'ItemController@index');
Route::get('/item/create','ItemController@create' );
Route::post('/item/store','ItemController@store' );
Route::get('/item/show/{id}','ItemController@show');
Route::get('/item/edit/{id}','ItemController@edit');
Route::post('/item/update/{id}','ItemController@update');
Route::post('/item/update/funds/{id}','ItemController@updateSaved');
Route::get('/item/destroy/{id}','ItemController@destroy');

Route::get('/profile','UserController@showProfile');



