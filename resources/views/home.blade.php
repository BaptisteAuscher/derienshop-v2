<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,800;1,800&display=swap" rel="stylesheet">
        <title>derien</title>
        <style>
        body{
            font-family: 'Montserrat', sans-serif;
            background: url("https://images.derienshop.com/background-website.jpg") no-repeat;
        }
        .container{
            width: 85vw;
            margin: auto;
            display: flex;
            flex-direction: column;
        }
        .top ul{
            display: flex;
            justify-content: space-between;
            margin: 0;
            padding: 0;
        }
        .close-icon{
            display: none;
        }
        .top a{
            color: black;
            text-decoration: none;
            font-size: .8em;
            letter-spacing: 3px;
        }
        .top li{
            list-style: none;
        }

        .top input[type='checkbox']{
            display: none;
        }
        
        .logo-container label{
            display: none;
        }
        .logo-container{
            display: flex;
            justify-content: center;
        }

        .logo-container > img {
            width: 300px;
            height: 169.75px;
            margin-top: 50px;
        }
        .content{
            display: flex;
            justify-content: center;
            margin-top: 8vw;
        }

        .content a{
            font-weight: 800;
            font-size: 7em;
            letter-spacing: 14px;
            color: black;
            text-decoration: none;
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
        .contact-smartphone{
            display: none;
        }


        @media screen and (max-device-width: 479px) {
            body{
                background: url('https://images.derienshop.com/background-smartphone.jpg');
                background-size: 100%;
                position: relative;
                width: 100vw;
                margin: 0;
                overflow-x: hidden;
            }
            .top ul{
                flex-direction: column;
            }

            .top ul {
                display: none;
                position: fixed;
                background-color: #fff;
                width: 100%;
                top: 0;
                left: 0;
                height: 100%;
                z-index: 1000;
                padding: 50px 40px;
            }

            .close-icon{
                display: block;
                position: fixed;
                top: 20px;
                right: 20px;
            }

            .top input[type='checkbox']:checked ~ ul{
                display: block;
            }
            .contact-ordi{
                display: none;
            }
            .link-item{
                margin-bottom: 30px;
            }
            .contact-smartphone{
                display: block;
                position: fixed;
                width: 100%;
                left: 0;
                bottom: 20px;
            }
            .contact-smartphone p {
                text-align: center;
            }
            .logo-container{
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;
            }

            .logo-container label{
                margin-bottom: -10px;
                display: block;

            }
            .top a{
                font-size: 1.4em;
                margin-bottom: 30px;
                font-weight: 800;
            }
            
            .logo-container > img {
                margin: 0;
                width: 200px;
                height: 112.5px;
            }
            .content{
                margin-top: 50vw;
            }
            .content a{
                font-size: 4em;
                letter-spacing: 5px;
                text-align: center;
            }
            .footer{
                width: 100%;
                bottom: 30px;
            }
        }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="top">
                
                <input type="checkbox" name="show-menu" id="show-menu">
                <ul>
                    <label for="show-menu" class="close-icon"><img  src="https://img.icons8.com/material-two-tone/24/000000/multiply.png"/></label>
                    <li class="link-item"><a href="https://instagram.com/derienltd" target="_blank">INSTAGRAM</a></li>
                    <li class="link-item"><a href="/range">SUMMER 2020 RANGE</a></li>
                    <li class="link-item"><a href="https://twitter.com/derienltd" target="_blank">TWITTER</a></li>
                    <li class="contact-ordi"><a href="/contact">CONTACT</a></li>
                    <li class="contact-smartphone">
                        <p>Contact : contact@derienshop.com</p>
                    </li>
                </ul>
            </div>

            <div class="logo-container">
                <label for="show-menu" class="menu-icon"><img src="https://img.icons8.com/metro/26/000000/menu.png"/></label>
                <img src="https://images.derienshop.com/derien-logo-couleur.png" alt="">
            </div>

            <div class="content">
                <a href="/products">SUMMER 2020</a>
            </div>

        </div>
        <div class="footer">
            <a href="/terms">boring things we need to tell</a>
        </div>
    </body>
</html>
