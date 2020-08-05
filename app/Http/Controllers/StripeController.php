<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use App\Command;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index(){
        if (! session()->has('shipping-cost')) {
            return redirect()->route('cart')->with('message', 'You must select a country');
        }

        if (Cart::count() < 2){
            return redirect()->route('products.index')->with('message', 'Add items to cart before proceeding to checkout !');
        }

        return view('checkout.stripe');
    }

    public function charge() {
        if (! session()->has('shipping-cost')) {
            return redirect()->route('cart')->with('message', 'You must select a country');
        }

        if (Cart::count() < 2){
            return redirect()->route('products.index')->with('message', 'Add item to cart before proceeding to checkout !');
        }
        request()->validate([
            'clientName'=>'required',
            'email'=>'required|email',
            'line1'=>'required',
            'stripeToken'=>'required',
        ]);

        if (request()->filled('line2')) {
            $linedeux = request('line2');
        } 
        else {
            $linedeux = '';
        }

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));


        $customer = $stripe->customers->create([
            'name' => request('clientName'),
            'email' => request('email'),
            'description' => 'Client Description',
            'source' => request('stripeToken'),
        ]);

        $stripe->charges->create([
            'customer' => $customer->id,
            'currency' => 'eur',
            'amount' => (int)Cart::total(),
        ]);

        foreach (Cart::content() as $item) {
            if ($item->id != 999) {
                $command = Command::create([
                    'product_name' => $item->model->name,
                    'product_color' => $item->options->color,
                    'product_size' => $item->options->size,
                    'customer_name' => request('clientName'),
                    'customer_email' => request('email'),
                    'customer_adress' => request('line1') . ' ' . $linedeux,
                    'customer_country' => session('shipping-cost')->options->country,
                    'amount' => $item->model->presentPrice(),
                    'cart_id' => $item->rowId, 
                ]);
            }
        }
        $cart = Cart::content();
        $price = presentPrice(Cart::total());
        Cart::destroy();
        
        session()->forget('shipping-cost');

        \Session::flash('message','Payment Complete !');

        return view('/confirmation', [
            'cart'=>$cart,
            'price'=>$price,
            'name'=>request('clientName'),
            'adress'=>request('line1') . ' ' . $linedeux,
        ]);
    }
}
