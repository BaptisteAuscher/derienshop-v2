<?php

$color = $_POST['color'];
$size = $_POST['size'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;800&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: none;
            font-family: 'Nanum Gothic', sans-serif;
        }
        .btn-achat{
            border-radius: 0;
            background-color: #000;
            font-weight: 800;
        }
    </style>
    <title>derien</title>
</head>
<body>

    <div id="app">
        <div class="container pt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-sd-12 col-md-6">          
                    <h3 class="panel-title" style="font-weight: 800">
                        YOUR PRODUCT
                    </h3>
                    <p class="pl-4">{{$product->name . ' ' . $color . ', ' . $size}} <i>({{$product->price . '0€'}})</i><p>
                </div>
            </div>
        </div>
        <form action="/charge/{{$product->id}}" method="post" id="payment-form">
            <input type="hidden" name="color" value="<?php echo $color ?>">
            <input type="hidden" name="size" value="<?php echo $size ?>">
            <div class="container pt-3">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 col-sd-12 ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="font-weight: 800">
                                    PAYMENT DETAILS
                                </h3>
                                <div class="checkbox pull-right">
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="cardNumber">
                                        CLIENT DETAILS
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control border-top-0 border-left-0 border-right-0" id="clientName" placeholder="Your Name" value="baptiste" name="clientName" required autofocus/>
                                        <input type="email" class="form-control border-top-0 border-left-0 border-right-0" id="clientEmail" placeholder="your@email.com" value="baptiste.auscher@gmail.com" name="email" required autofocus />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cardNumber">
                                        ADRESS
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control border-top-0 border-left-0 border-right-0" id="clientAdress" placeholder="Your adress" value="19 rue Lemerchier" name="adress" required autofocus />
                                        <input type="text" class="form-control border-top-0 border-left-0 border-right-0" id="clientCity" placeholder="City (ex: Amiens)" value="Amiens" name="city" required autofocus />
                                        <input type="text" class="form-control border-top-0 border-left-0 border-right-0" id="clientZip" placeholder="Zip Code (ex: 80000)" value="80000" name="zip" required autofocus />
                                    </div>
                                </div>
                                <label for="card-element" class="mt-3">
                                    CREDIT OR DEBIT CARD
                                </label>
                                <div id="card-element" class="mb-4 mt-2">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>

                                    <!-- Used to display Element errors. -->
                                <div id="card-errors" role="alert" class="mb-4"></div>
                            </div>
                        </div>
                        <input type="submit" value="CHECKOUT" class="btn btn-dark btn-block btn-achat">
                    </div>
                </div>
            </div>
            @csrf
        </form>
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
            fontSize: '14px',
            color: '#32325d',
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