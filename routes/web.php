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

//Routes Products
Route::get('/boutique', 'ProductController@index')->name('products.index');
Route::get('/boutique/{slug}', 'ProductController@show')->name('products.show');
Route::get('/search', 'ProductController@search')->name('products.search');


//Cart Routes
Route::group(['middleware' => ['auth']], function(){
    Route::get('/panier', 'CartController@index')->name('cart.index');
    Route::post('/panier', 'CartController@store')->name('cart.store');
    Route::delete('/panier/{rowId}', 'CartController@destroy')->name('cart.destroy');
    Route::patch('/panier/{rowId}', 'CartController@update')->name('cart.update');
});


//Stripe Routes
Route::group(['middleware' => ['auth']], function(){
    Route::get('/paiement', 'StripeController@index')->name('stripe.index');
    Route::post('/paiement', 'StripeController@store')->name('stripe.store');
    Route::get('/merci', 'StripeController@merci')->name('stripe.merci');
});



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
