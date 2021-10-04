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
Route::get('/listproduct', 'ProductController@index')->name('listproduct');
Route::get('product', 'ProductController@productadd')->name('product');
Route::post('product', 'ProductController@create')->name('addProduct');
Route::get('/editproduct/{id}', 'HomeController@edit');
Route::put('/updateproduct/{id}', 'ProductController@update');
Route::get('/deleteproduct/{id}', 'ProductController@delete');
Route::get('/detailproduct/{id}','ProductController@detail');
Route::get('/commentproduct/{id}', 'ProductController@comment');
Route::put('/postcommentproduct/{id}', 'ProductController@postcomment');
Route::get('/deletecommentproduct/{id}', 'ProductController@deletecomment');
Route::post('/addtocart', 'CartController@addtocart');
Route::get('/showcart', 'CartController@showcart');
Route::get('/deletecart/{id}', 'CartController@deletecart');
Route::get('/addone/{id}','CartController@addone');
Route::get('/minusone/{id}','CartController@minusone');
Route::get('/account','UserController@account');
Route::put('/updateaccount', 'UserController@updateaccount');
Route::get('/address','AddressController@address');
Route::post('/addaddress', 'AddressController@addaddress');
Route::get('/deleteaddress/{id}', 'AddressController@deleteaddress');
Route::get('/setasdefault/{id}', 'AddressController@setasdefault');
Route::get('/setaspickup/{id}', 'AddressController@setaspickup');
Route::get('/password', 'UserController@password');
Route::get('/order', 'CartController@order');
Route::get('/shop/{id}', 'ShopController@shop');
Route::get('/orderseller', 'CartController@orderseller');
Route::get('/orderdetail/{id}','CartController@orderdetail');
Route::get('/checkout/{id}', 'CartController@checkout');
// Route::get('/cancelorder/{id}', 'CartController@cancelorder');
// Route::get('/approvecancel/{id}', 'CartController@approvecancel');
Route::put('/placeorder/{id}', 'CartController@placeorder');
Route::get('/orderdetailseller/{id}', 'CartController@orderdetailseller');
Route::put('/updatetracknum/{id}', 'CartController@updatetracknum');
Route::get('/receiveorder/{id}', 'CartController@receiveorder');
Route::post('/searchproduct', 'ProductController@searchproduct');
Route::post('/addreview/{id}', 'ReviewController@addreview');
Route::get('accountseller', 'UserController@accountseller');
Route::put('/updateaccountseller', 'UserController@updateaccountseller');
Route::get('/passwordseller', 'UserController@passwordseller');
Route::get('/addressseller','AddressController@addressseller');
Route::post('/addaddressseller', 'AddressController@addaddressseller');
Route::get('/deleteaddressseller/{id}', 'AddressController@deleteaddressseller');
Route::get('/setasdefaultseller/{id}', 'AddressController@setasdefaultseller');
Route::get('/setaspickupseller/{id}', 'AddressController@setaspickupseller');