<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Product;
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



Route::get('/', 'WelcomeController@index');

Auth::routes();
// Route::get('/welcome', 'WelcomeController@index')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('order', 'OrderController@index')->name('order');

Route::get('product', 'ProductController@index')->name('product');
Route::post('product', 'ProductController@create')->name('addProduct');
Route::get('/editproduct/{id}', 'HomeController@edit');
Route::put('/updateproduct/{id}', 'ProductController@update');
Route::get('/deleteproduct/{id}', 'ProductController@delete');
Route::get('/detailproduct/{id}','ProductController@detail');
Route::get('/commentproduct/{id}', 'ProductController@comment');
Route::put('/postcommentproduct/{id}', 'ProductController@postcomment');
Route::get('/deletecommentproduct/{id}', 'ProductController@deletecomment');

