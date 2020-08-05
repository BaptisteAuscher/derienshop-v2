<?php

namespace App\Http\Controllers;

use Cart;

use App\Product;
use App\Command;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

use PayPal\Api\PaymentExecution;

use Illuminate\Http\Request;

class PaypalController extends Controller
{
    public function create() {
        if (! session()->has('shipping-cost')) {
            return redirect()->route('cart')->with('message', 'You must select a country');
        }

        if (Cart::count() < 2){
            return redirect()->route('products.index')->with('message', 'Add item to cart before proceeding to checkout !');
        }

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AXebxwkAx9x0HlS2wsKj_emOn9uZ8bbqD4j_1R7NMThBPLvKc8VHO30gSU0XSaeAyv_uHWhnried3Ia3',     // ClientID
                'EH9Hnvcp7s4ihN_aHlABK_CP07ZpfBFMmq0LLoLfysRCo3bm4obRzlfG2e93rcTUyl4Z5lEs-6oiFiro'      // ClientSecret
            )
        );
        

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $itemList = new ItemList();

        $arrayItem = [];

        foreach (Cart::content() as $product) {
            if ( $product->id != 999) {
                $item = new Item();
                $item->setName($product->model->name)
                    ->setCurrency('EUR')
                    ->setQuantity(1)
                    ->setSku($product->rowId)
                    ->setPrice($product->model->price / 100 );
                array_push($arrayItem, $item);     
            }
        }

        $itemList->setItems($arrayItem);


        $details = new Details();
        $details->setShipping(session('shipping-cost')->price / 100)
            ->setTax(0)
            ->setSubtotal((Cart::total() - session('shipping-cost')->price) / 100);


        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal(Cart::total() /100)
            ->setDetails($details);
        
            
            
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());


        $baseUrl = url('/');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/execute-paypal-payment")
            ->setCancelUrl("$baseUrl/execute-paypal-payment");

        
            
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        

        $payment->create($apiContext);


        return redirect($payment->getApprovalLink());
    }

    public function execute() {




        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AXebxwkAx9x0HlS2wsKj_emOn9uZ8bbqD4j_1R7NMThBPLvKc8VHO30gSU0XSaeAyv_uHWhnried3Ia3',     // ClientID
                'EH9Hnvcp7s4ihN_aHlABK_CP07ZpfBFMmq0LLoLfysRCo3bm4obRzlfG2e93rcTUyl4Z5lEs-6oiFiro'      // ClientSecret
            )
        );

        $paymentId = request('paymentId');
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal(Cart::total() /100);

        $amount->setCurrency('EUR');
        $amount->setTotal(Cart::total() /100);
        $amount->setDetails($details);
        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);

        $result = $payment->execute($execution, $apiContext);

        $customer_name = $result->payer->payer_info->first_name . ' ' . $result->payer->payer_info->last_name;
        $customer_email = $result->payer->payer_info->email;
        $customer_adress = $result->payer->payer_info->shipping_address->line1 . ', ' . $result->payer->payer_info->shipping_address->postal_code . ' ' . $result->payer->payer_info->shipping_address->city;
        /* 
        dump($result->payer->payer_info->first_name);
        dump($result->payer->payer_info->last_name);
        dump($result->payer->payer_info->email);
        dump($result->payer->payer_info->shipping_address->line1);
        dump($result->payer->payer_info->shipping_address->city);
        dump($result->payer->payer_info->shipping_address->postal_code);

        dd($result);*/

        foreach (Cart::content() as $item) {
            if ($item->id != 999) {
                $command = Command::create([
                    'product_name' => $item->model->name,
                    'product_color' => $item->options->color,
                    'product_size' => $item->options->size,
                    'customer_name' => $customer_name,
                    'customer_email' => $customer_email,
                    'customer_adress' => $customer_adress,
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
            'name'=>$customer_name,
            'adress'=>$customer_adress,
        ]);

    }
}
