<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>derien</title>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,800;1,800&display=swap" rel="stylesheet">
    <style>
    body{
        font-family: 'Montserrat', sans-serif;
    }
    .image-container{ 
    }

    .top{
        display: flex;
        align-items: center;
        width: 98vw;
        justify-content: space-around;
    }
    .top p{
        font-size: 1.4em;
        font-weight: 800;
    }
    .top img{
        width: 300px;
    }
    .footer{
        width: 100%;
        display: flex;
        position: fixed;
        bottom: 20px;
        justify-content: center;
    }
    .footer a{
        font-size: .8em;
        color: black;
        letter-spacing: 2px;
    }

    .cart{
        position: absolute;
        top: 58px;
        right: 100px;
        font-size: 1.2em;
    }
    .cart a{
        color: black;
        text-decoration: none;
    }
    .item-number{
        background-color: #f6bdbd;
        border-radius: 50%;
        width: 10px;
        height: 10px;
        position: absolute;
        top: -2px;
        right: -10px;
    }
    @media screen and (max-device-width: 479px){
        #app{
            width: 100vw;
            overflow-x: hidden;
        }
        .top{
            width:100%;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .top p{
            display: none;
        }
        .top img{
            width: 180px;
        }
        .container{
            min-height: 70vh;
        }
        .footer{
            position: relative;
        }
        .footer a {
            font-size: .8em;
        }
        .cart{
            top:40px;
            right: 20px;
        }
    }
    </style>
    @yield('style')
    </head>
    <body>

        <div id="app">
            <div class="cart">
                <a href="{{route('cart')}}"><img src="https://images.derienshop.com/shopping-cart.svg" width="30px"/></a>
                @if(session()->has('shipping-cost') and Cart::count() > 1)
                <div class="item-number"></div>
                @elseif((!session()->has('shipping-cost') ) and Cart::count() > 0)
                <div class="item-number"></div>
                @endif
            </div>
            <div class="top">
                <p>SUMMER</p>
                <div class="image-container m-0 p-0">
                    <a href="/"><img src="https://images.derienshop.com/derien-logo-couleur.png" alt=""></a>
                </div>
                <p>2020</p>
            </div>
            <div class="container">
                @yield('shop-content')
                @yield('cart-content')
            </div>
            <div class="footer">
                <a href="/terms">boring things we need to tell</a>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
    </body>
</html>