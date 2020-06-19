<?php

namespace App\Http\Controllers;

use App\Command;
use Illuminate\Http\Request;

class CommandsController extends Controller
{
    public function __invoke(){
        request()->validate([
            'size'=>'required|in:SMALL,MEDIUM,LARGE',
            'color'=>'required',
            'price'=>'required',
            'productName'=>'required',
            'clientName'=>'required',
            'email'=>'required|email',
            'adress'=>'required',
            'city'=>'required',
            'zip'=>'required',
            'stripeToken'=>'required',
        ]);

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));


        $customer = $stripe->customers->create([
            'name' => request('clientName'),
            'email' => request('email'),
            'description' => 'My First Test Customer (created for API docs)',
            'source' => request('stripeToken'),
        ]);

        $stripe->charges->create([
            'customer' => $customer->id,
            'currency' => 'eur',
            'amount' => request('price')*100,
        ]);

        $command = Command::create([
            'stripe_id' => $customer->id,
            'product_name' => request('productName'),
            'product_color' => request('color'),
            'product_size' => request('size'),
            'customer_name' => request('clientName'),
            'customer_email' => request('email'),
            'customer_adress' => request('adress'),
            'customer_city' => request('city'),
            'customer_zip' => request('zip'),
            'amount' => request('price'),
            
        ]);
        
        return redirect('/checkout/confirmation')->with('message', $command);
    }
}
