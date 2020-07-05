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

Route::get('/','ShopController@index')->name('shop.home');
Route::get('/{idProduct}/add-to-cart', 'CartController@addToCart')->name('addCart');
Route::prefix('cart')->group(function (){
    Route::get('/','CartController@showCart')->name('cart.showCart');
    Route::get('/{idProduct}/remove','CartController@remove')->name('cart.remove');
    Route::post('/{idProduct}/update','CartController@update')->name('cart.update');
    Route::get('checkout','CartController@checkOut')->name('cart.checkout');
    Route::post('checkout','CartController@payment')->name('cart.payment');
});
