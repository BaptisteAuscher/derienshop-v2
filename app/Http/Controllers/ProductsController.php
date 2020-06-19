<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('products.index', [
            'products' => $products
        ]);
    }

    public function show(Product $product){
        return view('products.show', [
            'product' => $product
        ]);
    }

}
