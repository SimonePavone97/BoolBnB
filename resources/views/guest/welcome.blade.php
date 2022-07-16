<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Boolbnb</title>



    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Tomtom Maps -->
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps.css'>
    <script type="text/javascript" src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps-web.min.js">
    </script>

    <!-- Styles -->
    <style>
        /* html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            

            .full-height {
                height: 100vh;
            }*/

            body{
                max-width: 100%;
            }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        /*.position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }*/

        

        .links>a {
            color: white;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .red{
            color: red;
            font-width: 900;
            
        }

        /*.m-b-md {
                margin-bottom: 30px;
            } */

    </style>

</head>

<body>
    <div class="flex-center bg-dark">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}"> <i class=" red fa-solid fa-house-user mr-2"></i>Home</a>
            @else
            <a href="{{ route('login') }}"> <i class=" red fa-solid fa-arrow-right-to-bracket mr-2"></i>Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"> <i class=" red fa-solid fa-registered mr-2"></i>Register</a>
            @endif
            @endauth
        </div>
        @endif
    </div>

    <div class="content">

        <div id="root"></div>

    </div>
    
    <script src="{{ asset('js/front.js') }}"></script>

</body>

</html>
