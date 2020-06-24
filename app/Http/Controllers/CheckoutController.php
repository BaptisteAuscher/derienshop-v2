<?php

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke(Product $product){
        request()->validate([
            'size'=>'required|in:SMALL,MEDIUM,LARGE',
            'color'=>'required|in:black,white,blue,purple',
        ]);
        return view('checkout', [
            'product' => $product
        ]);
    }
}
