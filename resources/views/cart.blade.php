@extends('products.layout')



@section('style')
<style>
.title{
    letter-spacing: 3px;
    font-weight: bold;
    font-style: italic;
    color: #555555;
    font-size: 1.8em;
    margin-bottom: 40px;
}
.subtitle{
    font-weight: 800;
    font-size: 1.3em;
    margin: 0;
}

.section{
    width: 100%;
    margin-bottom: 2vw;
    padding: 0;
}

.shopping-cart-container{
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.shopping-cart-details{
    width: 55%;
    margin-left: -2%;
}
.product{
    display: flex;
    justify-content: space-between;
    align-items: start;
    padding: 10px 20px;
    border-bottom: 1px solid #919191;
    margin-bottom: 20px;
}

.info-product{
    padding: 0;
    margin: 0;
    margin-right: 40%;
}

.info-product h3{
    font-size: 1.2em;
    font-weight: 800;
    color: #555555;
    padding: 0;
    margin: 0;
}

.info-product p{
    padding: 0;
    margin: 0;
    font-size: .8em;
    color: #919191;
}

.delete-item{
    opacity: .6;
}

.order-summary{
    width: 35%;
}

.btn-black{
    display: block;
    text-align: center;
    padding: 10px;
    background-color: black;
    color: white;
    font-weight: 800;
    border: none;
    width: 100%;
    margin-bottom: 20px;
}

.btn-black:hover{
    color: white;
    background-color: #23272b;
    text-decoration: none;
}

.btn-blue{
    padding: 10px;
    background-color: #fbf6ac;
    color: black;
    font-weight: 800;
    border: none;
    width: 100%;
}

.buttons{
    margin-top: 20px;
}
.pricing{
    margin-bottom: 30px;
}

.total{
    display: flex;
    justify-content: space-between;
    margin: 0;
    padding: 0;
}

.pricing h3{
    font-size: 1.1em;
    margin: 0;
}

.pricing h2{
    font-size: 1.2em;
    margin: 0;
    font-weight: 800;
}

.pricing p{
    margin: 0;
}

button{
    padding: 0;
    margin: 0;
    border: none;
    background-color: white;
}

.select-country-form{
    margin-top: 20px;
}

.country-input{
    width: 100%;
    border-radius: 0;
    border: 1px solid #919191;
    padding: 10px;
    margin-bottom: 5px;
    border: 2px solid black;
    color: #555555;
    font-weight: 800;
    text-transform: uppercase;
}

.select-country-input{
    width: 100%;
    border-radius: 0;
    border: 1px solid #919191;
    padding: 10px;
    margin-bottom: 5px;
    background-color: white;
    border: 2px solid black;
    color: #555555;
    font-weight: 800;
    text-transform: uppercase;
    appearance: none;
    -moz-appearance: none;
    -webkit-appearance: none;
}

.price-info{
    font-size: .8em;
    color: #555555;
}

.message-alert{
  font-size: 1.2em;
  font-weight: 800;
  color: #919191;
  font-style: italic;
  margin-top: -20px;
  margin-bottom: 20px;
}

@media screen and (max-width: 479px){
    .return{
        display:none;
    }
    .shopping-cart-details{
        width: 100%;
        margin: 0;
    }
    .product{
        padding:0;
    }
    .order-summary{
        width: 100%;
    }
    .info-product{
        margin: 0;
    }
    .title{
        margin-bottom: 20px;
    }
}


</style>
@stop



@section('cart-content')

<h1 class="title">SHOPPING CART</h1>

@if(session()->has('message'))
<div class="message-alert" role="alert">
  {{session()->get('message')}}
</div>
@endif

<div class="section shopping-cart-container">
    <a href="/products" class="return">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 8 8">
            <path d="M4 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z" transform="translate(1)" />
        </svg>
    </a>
    <div class="shopping-cart-details">
        <h2 class="subtitle">Cart</h2>

        @foreach(Cart::content() as $item)
            @if($item->id != 999)

            <div class="product">
                <img src="{{$item->model->image_link . '-' . $item->options->color . '.png'}}" alt="" width="100px">
                <div class="info-product">
                    <h3>{{$item->name}}</h3>
                    <p>Color: {{$item->options->color}}</p>
                    <p>Size: {{$item->options->size}}</p>
                </div>
                <p>{{$item->model->presentPrice()}}</p>
                <form action="{{route('cart.destroy', $item->rowId)}}" method="POST">
                    @csrf
                    <button type="submit"><img class="delete-item" src="https://img.icons8.com/material-two-tone/24/000000/multiply.png"/></button>
                    {{method_field('DELETE')}}
                </form>
            </div>

            @endif
        @endforeach
    </div>

    <div class="order-summary">
        <h2 class="subtitle">Order Summary</h2>

        @if(! session()->has('shipping-cost'))

        <form action="{{ route('shipping-costs.store') }}" class="select-country-form" method="POST">
            @csrf
            <select name="country-select" id="country" v-model="country" class="select-country-input">
                <option selected>France</option>
                <option>Other</option>
            </select>

            <input type="text" placeholder="Other"  class="country-input" name="country-input" v-if="country == 'Other'" >
            <input type="submit" value="CONFIRM" class="btn-black">
        </form>
        @endif

        @if(session()->has('shipping-cost'))
        <form action="{{ route('shipping-costs.delete', session('shipping-cost')->rowId ) }}" class="select-country-form" method="POST">
            @csrf
            {{method_field('DELETE')}}
            <input type="text" placeholder="Other"  class="country-input" disabled value="{{session('shipping-cost')->options->country}}">
            <input type="submit" value="CHANGE COUNTRY" class="btn-black">
        </form>
        @endif


        <div class="buttons">

            <div class="pricing">
                
                <div class="total">
                    <div>
                        <h2>Total</h2>
                        <p class="price-info">(May contain shipping costs)</p>
                    </div>
                    <p>{{ presentPrice(Cart::total()) }}</p>
                </div>
            </div>


            <p>Check again your cart before checkout</p>
            <a class="btn-black" href="{{ route('checkout.stripe') }}">CHECKOUT</a>
            
            <form action="{{ route('checkout.paypal') }}" method="POST">
                @csrf
                <input class="btn-blue" type="submit" value="CHECKOUT WITH PAYPAL">
            </form>
        </div>
    </div>
</div>


@stop