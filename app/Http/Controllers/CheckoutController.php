<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke(){
        if (! session()->has('shipping-cost')) {
            return redirect()->route('cart')->with('message', 'You must select a country');
        }

        if (Cart::count() < 2){
            return redirect()->route('products.index')->with('message', 'Add items to cart before proceeding to checkout !');
        }

        return view('checkout');
    }
}
