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

Route::view('/', 'home');

Route::get('/products', 'ProductsController@index');
Route::get('/products/{product}', 'ProductsController@show');

Route::post('/checkout', function() {
    return view('checkout');
});

Route::post('/charge', 'CommandsController');

Route::view('/terms', 'terms.terms');


Route::view('/term-of-sale', 'terms.sale');
Route::view('/shipping-policy', 'terms.shipping');
Route::view('/refund-policy', 'terms.refund');
Route::view('/privacy-policy', 'terms.privacy');

Route::view('/range', 'range.index');

Route::view('/checkout/confirmation', 'confirmation');

Route::view('/contact', 'contact');
