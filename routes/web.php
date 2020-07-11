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

Route::view('/', 'home')->name('home');

Route::get('/products', 'ProductsController@index')->name('products.index');
Route::get('/products/{product}', 'ProductsController@show');

Route::get('/checkout', 'CheckoutController')->name('checkout');

Route::post('/charge', 'CommandsController@store')->name('charge');

Route::view('/terms', 'terms.terms');


Route::view('/term-of-sale', 'terms.sale');
Route::view('/shipping-policy', 'terms.shipping');
Route::view('/refund-policy', 'terms.refund');
Route::view('/privacy-policy', 'terms.privacy');

Route::view('/range', 'range.index');

Route::view('/confirmation', 'confirmation');

Route::view('/contact', 'contact');


Route::view('/cart', 'cart')->name('cart');

Route::post('/cart', 'CartController@store')->name('cart.store');
Route::delete('/cart/{id}', 'CartController@destroy')->name('cart.destroy');

Route::post('/shipping-costs', 'ShippingCostsController@store')->name('shipping-costs.store');
Route::delete('/shipping-costs/{id}', 'ShippingCostsController@delete')->name('shipping-costs.delete');


Route::get('/delete-cart', function() {
    Cart::destroy();
    if (session()->has('shipping-cost')) {
        session()->forget('shipping-cost');
    }
});

Route::get('/show-cart', function() {
    dd(Cart::content());
});