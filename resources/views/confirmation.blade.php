<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,800;1,800&display=swap" rel="stylesheet">
    <title>derien</title>
    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            padding: 0;
            margin: 0;
            width: 100vw;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .message p{
            text-align: center;
            letter-spacing: 3px;
            font-size: 1.5em;
            text-transform: uppercase;
        }
        .content{
            background-color: lightgrey;
            width: 50vw;
            padding: 40px;
        }
        hr{
            width: 80%;
            border: 0;
            height: 1px;
            background-color: black;
            margin-top: 20px;
        }
        .total{
            display: flex;
            justify-content: space-between;
            
        }
        .total p{
            padding: 10px 20px;
            margin: 0;
        }
        .delivery{
            display: flex;
            flex-direction: column;
            margin: 0;
            margin-top: 20px;
        }
        .delivery-title{
            padding-left: 20px;
            font-size: 1em;
            margin: 0;
            margin-bottom: 10px;
        }
        .adress{
            padding-left: 25px;
            margin: 0;
            margin-top: 5px;
            font-size: .8em;
        }
        .twitter{
            margin-top: 6vh;
        }
        .twitter a {
            display: block;
            width: 50vw;
            font-size: 1em;
            font-weight: 800;
            padding: 12px 0;
            background-color: black;
            text-decoration: none;
            color: white;
            text-align: center;
        }

        .twitter a:hover{
            background-color: #23272b;
        }
        .conact p {
            font-size: 8em;
        }

        @media screen and (max-device-width: 479px){
            .content{
                margin-top: 5vh;
                width: 80vw;
                padding: 20px;
            }
        }

    </style>
</head>
<body>

    @if(session()->has('message'))

        <div class="top">
            <a href="/"><img src="https://images.derienshop.com/derien-logo-couleur.png" alt="" width="300px"></a>
        </div>

        <div class="message">       
            <p>Thanks for your purchase, {{$name}} !</p>
        </div>

        <div class="content">
            <div class="order">
                <p class="delivery-title">Order :</p>
                @foreach($cart as $item)
                    @if($item->id != 999)
                        <p class="adress">{{$item->model->name}}</p>
                        <p class="adress">Color : {{$item->options->color}}</p>
                        <p class="adress">Size : {{$item->options->size}}</p><br><br>
                    @endif
                @endforeach
            </div>
            <hr>
            <div class="delivery">
                <p class="delivery-title">Delivery :</p>
                <p class="adress">{{$adress}}</p>
            </div>
            <hr>
            <div class="total">
                <p>Total :</p>
                <p>{{$price}}</p>
            </div>
            
        </div>

        <div class="twitter">
            <a href="https://twitter.com/intent/tweet?text=Je%20viens%20de%20commander%20un%20bête%20d%27item%20sur%20derienshop.com%20&hashtags=derien" class="share"><i></i><span class="label" id="l">SHARE ON TWITTER</span></a>
        </div>

        <div class="contact">
            <p>Contact : contact@derienshop.com</p>
        </div>
        <script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>

    @elseif( ! session()->has('message'))

        <script>window.location = '/';</script>
    @endif
</body>
</html>



