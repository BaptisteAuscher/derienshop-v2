<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;

class ShippingCostsController extends Controller
{
    public function store(){
        if(request('country-select') == 'France'){
            $shipping = Cart::add('999', 'Shipping Cost', 1, 0, ['country'=>'France']);
        } else if(request('country-select') == 'Other') {
            request()->validate([
                'country-input' => 'required',
            ]);
            $shipping = Cart::add('999', 'Shipping Cost', 1, 1200, ['country'=>request('country-input')]);
        }

        session(['shipping-cost'=>$shipping]);

        return redirect()->route('cart');
    }

    public function delete($id){
        if (session()->has('shipping-cost')) {
            session()->forget('shipping-cost');
        }
        Cart::remove($id);
        return redirect()->route('cart');
    }
}
