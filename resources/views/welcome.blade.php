<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CONABE-construcciones</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .form-control{
                width:550px;
                height:40px;
            }
            .img-fluid{
                align-self: start;
                max-width: 100%;
                height: auto; 
                width: 300px;
                height: 150px;
                padding-left:30px;
            }
            .btn{
                background:blue;
                color:white;
                border-color:blue;
                height:40px;
                width: 150px;
                font-size:15px;
            }
            .h1{
                font-size:40px;
                font-weight:bold;
            }
            .h3{
                font-size:20px;
            }

        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-md-12">
                <img class="img-fluid img-thumbnail" id="img" src="{{asset('images/constructura2.jpg')}}"/>
            </div>
        </div>
        <div class=”container-fluid”>
            <div class="row vh-100 justify-content-center align-items-center">
                <div class="col-auto bg-light p-5">
                    <form action="">
                        <div class="input-group p-2">

                    </form>

                </div>
            </div>
        </div>
            
            <div class="row">
                <div class="col-md-12">
                    <h1 class="h1">ACCESO<h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <h3 class="h3">USUARIO<h3>
                <input type="text" class="form-control" id="txtusuario" name="txtusuario"/>
            </div>
            <div class="row">
                <div class="col-md-12">
                <h3 class="h3">CONTRASEÑA</h3>
                <input type="password" class="form-control" id="txtcontraseña" name="txtcontraseña"/>
                <h3> </h3>
                <button type="button" class="btn">Iniciar sesión</button>
                </div>
            </div>
        </div>

   

        <!--<div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>!-->
    </body>
</html>
