@extends('products.layout')

@section('style')
<style>
.boutique{
  margin-top: 10vh;
}

a:hover{
  text-decoration: none;
}

.item-container{
  display: flex;
  justify-content: space-around;
}

.product-card{
  display: flex;
  flex-direction: column;
  align-items: center;
  text-decoration: none;
}

.product-card p {
  color: black;
  font-size: 1.1em;
}
.product-card img{
  width: 400px;
}

@media screen and (max-device-width: 479px){
  .item-container{
    flex-wrap: wrap;
  }
  .product-card img{
    width: 150px;
  }
}
</style>


@stop


@section('shop-content')


@if(session()->has('message'))
<div class="alert alert-success" role="alert">
  {{session()->get('message')}}
</div>
@endif

<div class="boutique">
  <ul class="list-unstyled item-container">
      @foreach ($products as $product)
      <li>
        <a href="/products/{{ $product->id }}" class="product-card">
          <img src="{{$product->image_link . '-' . $product->color_fav . '.png'}}" alt="" width="400px">
          <p>{{$product->name}} T-Shirt</p>
        </a>
      </li>
      @endforeach
  </ul>
</div>

@stop