<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>derien</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;800&display=swap" rel="stylesheet">
    <style>
        body{
            width: 97vw;
            font-family: 'Nanum Gothic', sans-serif;
        }
        .container{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }
        .ph1{
            font-size: 2em;
            margin: 2vw 0 0 0;
        }
        .ph2{
            font-size: 1.5em;
            margin: 2vw 0 0 0;
            font-style: italic;
        }
        .list{
            margin: 3vw 0 0 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0;
        }
        .list a{
            list-style: none;
            text-decoration: underline;
            color: #3f3f3f;
        }
        .list li{
            list-style: none;
            margin-bottom: 1vw;
        }
        .phinsta{
            margin: 5vw 0 0 0;
            font-size: 1.2em;
        }
        h1, h2, h3{
            margin-top: 20px;
            margin-bottom: 10px;
        }
        @media screen and (max-device-width: 479px) {
            .container{
                width: 95vw;
            }
            .ph1{
                text-align: center;
            }
            .phinsta{
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="image-container col-12 container">
            <a href="/"><img src="https://images.derienshop.com/derien-logo-couleur.png" alt="" width="300px"></a>
        </div>
    </div>

    <div class="row">
        <div class="container">
            @yield('terms-content')
        </div>
    </div>

    
</body>
</html>