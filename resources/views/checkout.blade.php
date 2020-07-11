

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,800;1,800&display=swap" rel="stylesheet">
    <style>
        #app{
            width: 80%;
            margin: auto;
        }
        body {
            background-image: none;
            font-family: 'Montserrat', sans-serif;
        }
        .logo-container{
            display: flex;
            justify-content: center;
        }
        .btn-achat{
            border-radius: 0;
            background-color: #000;
            font-weight: 800;
        }
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
            margin-bottom: 20px;
        }

        .section{
            width: 100%;
            padding: 0;
        }

        .shopping-cart-container{
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .shopping-cart-details{
            width: 30%;
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
            margin-left: -20%;
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
        .checkout-form{
            width: 50%;
            margin-left: -5%;
        }

        form h3{
            font-size: 1.2em;
            font-weight: 800;
            color: #555555;
            padding: 0;
            padding-left: 10px;
            margin: 0;
            margin-top: 15px;
            margin-bottom: 10px;
        }


        .client-adress{
            width: 100%;
            display: flex;
            flex-direction: column;

        }

        .client-adress input{
            border-radius: 0;
            border: 1px solid #919191;
            padding: 10px;
            margin-bottom: 5px;
        }

        .client-details{
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .client-details input{
            width: 45%;
            border-radius: 0;
            border: 1px solid #919191;
            padding: 10px;
        }

        .stripe-card-container{
            margin: 20px 0;
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
        .footer{
            width: 80%;
            display: flex;
            position: absolute;
            bottom: 20px;
            justify-content: center;
        }
        .footer a{
            font-size: .8em;
            color: black;
            letter-spacing: 2px;
        }
        .pricing{
            margin-bottom: 30px;
        }

        .pricing div{
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

        @media screen and (max-width: 479px){
            #app{
                width: 100%;
                padding-left: 15px;
                padding-right: 15px;
            }
            .title{
                margin-bottom: 20px;
            }
            .return{
                display:none;
            }
            .client-details input{
                width: 48%;
            }
            .checkout-form{
                width: 100%;
                margin: 0;
            }
            .product{
                padding:0;
            }
            .shopping-cart-details{
                width: 100%;
            }
            .info-product{
                margin: 0;
                margin-right: 30%;
            }
            .footer{
                width: 100%;
                position: relative;
                margin-top: 20px;
            }
            .logo-container img{
                width: 180px;
            }
        }

    </style>
    <title>derien</title>
</head>
<body>

    <div id="app">
        <div class="logo-container">
            <a href="{{route('home')}}"><img src="https://images.derienshop.com/derien-logo-couleur.png" alt="" width="300px"></a>
        </div>
        <h1 class="title">CHECKOUT</h1>
        <div class="section shopping-cart-container">
            <a href="{{route('cart')}}" class="return">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 8 8">
                    <path d="M4 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z" transform="translate(1)" />
                </svg>
            </a>
            

            <div class="checkout-form">
                <h2 class="subtitle">Payment Informations</h2>
                <form action="{{ route('charge') }}" method="POST" id="payment-form">
                    <h3>Your Personnal details</h3>
                    <div class="client-details">
                        <input type="text" class="" id="clientName" placeholder="Your Name" name="clientName"/>
                        <input type="email" class="" id="clientEmail" placeholder="your@email.com" name="email"/>
                    </div>

                    <h3>Your Adress</h3>
                    <div class="client-adress">
                        <input type="text" id="line1" name="line1" placeholder="ex: 42 Boulevard de Bonne Nouvelle, 75010 Paris">  
                        <input type="text" id="line2" name="line2" placeholder="ex: Appartement 2, Suite ..." >
                    </div>

                    <h3>Payment Details</h3>

                    <div id="card-element" class="stripe-card-container">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                        <!-- Used to display Element errors. -->
                    <div id="card-errors" role="alert" class=""></div>
                                                   
                    <input type="submit" value="ORDER" class="btn-black">
                    @csrf
                </form>
            </div>

            <div class="shopping-cart-details">
                <h2 class="subtitle">Your Order</h2>

                @foreach(Cart::content() as $item)
                @if($item->id != 999)

                    <div class="product">
                        <img src="{{$item->model->image_link . '-' . $item->options->color . '.png'}}" alt="" width="50px">
                        <div class="info-product">
                            <h3>{{$item->name}}</h3>
                            <p>Color: {{$item->options->color}}</p>
                            <p>Size: {{$item->options->size}}</p>
                        </div>
                        <p>{{$item->model->presentPrice()}}</p>
                    </div>
                @endif

                @endforeach

                <div class="pricing">
                    <div class="subtotal">
                        <h3>Subtotal</h3>
                        <p>{{ presentPrice(Cart::total() - session('shipping-cost')->price ) }}</p>
                    </div>
                    <div class="subtotal">
                        <h3>Shipping Cost</h3>
                        <p>{{ presentPrice(session('shipping-cost')->price) }}</p>
                    </div>
                    <hr>
                    <div class="total">
                        <h2>Total</h2>
                        <p>{{ presentPrice(Cart::total()) }}</p>
                    </div>
                </div>

                <a href="{{route('products.index')}}" class="btn-black">CONTINUE SHOPPING</a>
            </div>
        </div>

        <div class="footer">
            <a href="/terms">boring things we need to tell</a>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ config('services.stripe.key')}}');
        var elements = stripe.elements({locale: 'fr'});

        // Custom styling can be passed to options when creating an Element.
        var style = {
        base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            color: '#919191',
        },
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        card.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.messsage;
            } else {
                displayError.textContent = '';
            }
        });


        // Create a token or display an error when the form is submitted.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the customer that there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });
        
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
</body>
</html>