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
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        video{
            margin-top: 2vw;
        }
        .titre{
            font-size: 3em;
            font-weight: 800;
        }

        .footer{
            position: fixed;
            bottom: 20px;
        }
        .footer a{
            color: black;
        }
        @media screen and (max-device-width: 479px){
            body{
                position: fixed;
                width: 100%;
                height: 100%;
                overflow-x: hidden;
            }
            .titre{
                font-size: 2em;
                text-align: center;
            }
            video{
                margin-top: 30vw;
                width: 300px;
            }
        }
    </style>
</head>
<body>
    <div>
        <p class="titre">SUMMER 2020 RANGE</p>
    </div>
    <video no-controls width="500px" autoplay loop preload="auto" muted>
        <source src="https://images.derienshop.com/video-range-musee.mp4" type="video/mp4">
        Sorry, your browser doesn't support embedded videos.
    </video>
    <div class="footer">
        <a href="/terms">boring things we need to tell</a>
    </div>
</body>
</html>