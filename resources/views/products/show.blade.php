@extends('products.layout')

@section('style')
<style>
.name-container{
    width: 400px;
}
.name{
    font-size: 2.5em;
    font-weight: 800;
    text-transform: uppercase;
    font-style: italic;
    letter-spacing: 7px;
    color: #555555;
}

.color-selector{
    display: flex;
}

input[type='radio']{
    display: none;
}

.size-select{
    width: 100%;
    padding: 10px;
    border: 2px solid black;
    background: #fff;
    font-weight: 800;
}

.size-select:visited{
    border-radius: 0;
}

.radio-black{
    margin-right: 15px;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    border: 1px solid grey;
    display: flex;
    justify-content: center;
    align-items:center;
    cursor:pointer;
}

.radio-black div{
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: black;
}

.radio-white{
    margin-right: 15px;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    border: 1px solid grey;
    display: flex;
    justify-content: center;
    align-items:center;
    cursor:pointer;
}

.radio-white div{
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: white;
}

.radio-blue{
    margin-right: 15px;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    border: 1px solid grey;
    display: flex;
    justify-content: center;
    align-items:center;
    cursor:pointer;
}

.radio-blue div{
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #d1ebff;
}

.radio-purple{
    margin-right: 15px;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    border: 1px solid grey;
    display: flex;
    justify-content: center;
    align-items:center;
    cursor:pointer;
}

.radio-purple div{
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #f6ccff;
}

.btn-submit{
    border-radius: 0;
    background-color: black;
    font-weight: 800;
}

img{
    width: 650px;
}

@media screen and (max-device-width: 479px){
    img {
        width: 300px;
    }
    .description-container{
        width: 90%;
        margin: auto;
        margin-bottom: 4vh;
    }
    .name{
        font-size: 1.9em;
        letter-spacing: 3px;
    }
}

</style>

@stop


@section('shop-content')
<div class="row">
    <div class="col-md-8 col-sd-12 d-flex">
        <div class="col-1  m-0 p-0">
            <a href="/products">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 8 8">
                    <path d="M4 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z" transform="translate(1)" />
                </svg>
            </a>
        </div>
        <div class="col-11 m-0 p-0">       
            <img :src="'{{$product->image_link . '-'}}' + color + '.png'" width="650px" :alt="color">
        </div>
    </div>
    <div class="col-md-4 col-sd-12">
        <div class="name-container">
            <p class="name">{{ $product->name }} T-SHIRT</p>
        </div>
        <form action="/checkout" method="post">
            <div class="row">
                <div class="col-12 pb-2">€{{$product->price }}0</div>
            </div>
            <div class="row">
                <div class="col-12 pb-2">
                    <p>Color</p>
                    <input type="hidden" value="{{ $product->color_fav }}" v-model="favColor">
                    <div class="color-selector"> 
                        @foreach($product->colors as $color)
                            <label for="radio-{{$color->color}}" class="radio-{{$color->color}}"><div></div></label>
                            <input type="radio" name="color" value="{{$color->color}}" id="radio-{{$color->color}}" selected v-model="color" >
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pb-4">
                    <label for="size">Size</label>
                    @foreach($product->colors as $color)
                    <select class="size-select" id="id" name="size" required v-if="'{{$color->color}}' == color">
                        <option :disabled="'{{$color->stock_s}}' < 1">SMALL</option>
                        <option :disabled="'{{$color->stock_m}}' < 1">MEDIUM</option>
                        <option :disabled="'{{$color->stock_l}}' < 1">LARGE</option>
                    </select>
                    @endforeach
                </div>
            </div>
            <div class="row">   
                <div class="col-12">
                <input type="hidden" name="price" value="{{$product->price}}">
                <input type="hidden" name="name" value="{{$product->name}}">
                    <input type="submit" class="btn btn-dark btn-block btn-submit" value="CHECKOUT">
                </div>
            </div>
            @csrf
        </form>
    </div>
    
</div>

<div class="row">
    <div class="description-container">
        100% COTON</br></br>

        Printed in France at Paris and the tag is hand-stitched.</br></br>

        These illustrations are mock-ups. <br><br>
    </div>
</div>

@stop