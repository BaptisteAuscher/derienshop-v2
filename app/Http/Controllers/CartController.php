<?php

namespace App\Http\Controllers;

use App\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'size'=>'required|in:SMALL,MEDIUM,LARGE',
            'color'=>'required|in:black,white,blue,purple',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        //Cart::destroy();
        $cart = Cart::add($product->id, $product->name, 1, $product->price, ['size' => $request->size, 'color'=>$request->color])
            ->associate('App\Product');
        
        $message = 'Item added to cart.';
        if ($cart->qty > 1) {
            Cart::update($cart->rowId, ['qty' => '1']);
            $message = "You can only buy one item at a time.";
        }

        return redirect()->route('products.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        
        return redirect()->back();
    }
}
