<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right,rgba(250, 189, 189, 0.83), rgb(248, 157, 157));
        }

        img {
            max-width: 100%;
            width: 30%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;

            @media (width <= 40em) {
                max-width: 70%;
                width: 60%;
                height: auto;
            }

            @media (width <= 30em) {
                max-width: 80%;
                width: 70%;
                height: auto;
            }

            @media (width <= 20em) {
                max-width: 90%;
                width: 90%;
                height: auto;
            }
        }

        .container {
            background-color: white;
            border-radius: 15px;
            padding: 10px;
            margin: 1px 10px;
            box-sizing: border-box;

            @media (min-width: 768px) {
                background-color: white;
                border-radius: 15px;
                padding: 20px;
                box-sizing: border-box;
            }
        }

        .ribbon-top {
            width: 100%;
            height: 40px;
            background-image: url('<?php echo base_url() ?>image/PATERN-01.png'); /* use correct path */
            background-repeat: repeat-x;
            background-size: auto 100%; /* ensures vertical fit */
        }

        .ribbon-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            /* padding: 10px; */
            max-width: 100%;
            margin-bottom: 20px;

            @media (max-width: 768px) {
                grid-template-columns: repeat(2, 1fr);
                margin: 40px 5px;
            }
        }

        .icon-button {
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            color: #000;
            font-size: 35px;
            transition: transform 0.2s;
            margin-top: 50px;

            &:hover {
                transform: scale(1.3);
                color: green;
                text-decoration: none;
            }
        }

        .icon-stack {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 22px;
            gap: 8px;
            color:rgb(177, 66, 66);

            &:hover {
                color: #ff6b6b;
            }
        }

        .center-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10vh;
            margin-top: 20px;
        }

        .login-btn {
            font-size: 1.2rem;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            background-color: #ff6b6b;
            color: white;
            border: 2px solid #ff6b6b;
            border-radius: 10px;
            transition: transform 0.2s, background-color 0.2s, color 0.2s;
            padding: 10px 120px;


            @media (width <= 30em) {
                font-size: 1rem;
                font-weight: bold;
                padding: 15px 60px
            }

            &:hover {
                transform: scale(1.15);
                color: black;
                background-color: white;
                text-decoration: none;
            }
        }

        .logo {
            margin-top: 5% 0;
        }

        #loginCarousel {
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
            border-radius: 10px;
            overflow: hidden;
        }
        .carousel-item img {
            height: 250px;
            object-fit: cover;
        }

    </style>

</head>

<body>
    <div class="container">

        <div class="ribbon-top">
            <img src="<?php echo base_url() ?>image/PATERN-01.png" alt="Decorative Ribbon" class="ribbon-image">
        </div>

        <picture class="logo">
            <img src="<?php echo base_url() ?>image/FA VIBRAN artwork-01.png" class="logo" alt="vibrant logo vertical">
        </picture>

        <div id="loginCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
            <ol class="carousel-indicators">
                <li data-target="#loginCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#loginCarousel" data-slide-to="1"></li>
                <!-- <li data-target="#loginCarousel" data-slide-to="2"></li> -->
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="<?php echo base_url() ?>image/studio2.png" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?php echo base_url() ?>image/studio3.png" alt="Slide 2">
                </div>
            </div>
        </div>


        <div class="center-wrapper">
            <a href="/login" class="login-btn">Join Us Now</a>
        </div>
        <div class="buttons">
            <a href="https://www.instagram.com/vibrantstudio.id/" target="_blank" class="icon-button">
                <div class="icon-stack">
                    <i class="fab fa-instagram"></i>
                    <span>Instagram</span>
                </div>
            </a>
            <a href="https://wa.me/+628119271910" target="_blank" class="icon-button">
                <div class="icon-stack">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp</span>
                </div>
            </a>
            <a href="https://maps.app.goo.gl/T1yUK92yQTzPRovw7" target="_blank" class="icon-button">
                <div class="icon-stack">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Maps</span>
                </div>
            </a>
            <a href="https://www.google.com/maps/place/Vibrant+sound+of+body+and+soul/@-6.2652449,106.7981458,19z/data=!4m18!1m9!3m8!1s0x2e69f12baaf069dd:0x686ccdb5fdbb3ce2!2sVibrant+sound+of+body+and+soul!8m2!3d-6.2647296!4d106.7979953!9m1!1b1!16s%2Fg%2F11x7jn3cjm!3m7!1s0x2e69f12baaf069dd:0x686ccdb5fdbb3ce2!8m2!3d-6.2647296!4d106.7979953!9m1!1b1!16s%2Fg%2F11x7jn3cjm?entry=ttu&g_ep=EgoyMDI1MDYwNC4wIKXMDSoASAFQAw%3D%3D" class="icon-button">
                <div class="icon-stack">
                    <i class="fas fa-star"></i>
                    <span>Rating</span>
                </div>
            </a>
        </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>   
    
    <script>
        $('#loginCarousel').carousel({
            interval: 3000, // 3 seconds
            ride: 'carousel',
            pause: false 
        });
    </script>
</body>

</html>