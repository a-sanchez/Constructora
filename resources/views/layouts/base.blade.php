<!DOCTYPE html>
<html lang="en">
<head>
    <title> @yield('title') </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINKS CSS -->
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/flexslider.css')}}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css')}}">
    <link rel="stylesheet" href="{{ asset('css/icon.css')}}">
    <link rel="stylesheet" href="{{ asset('css/animate.css')}}">

    <!-- LINKS JAVASCRIPTS -->
    <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/app.js')}}" defer></script>
    <script src="{{ asset('js/modernizr-2.js')}}" defer></script>
    @yield('styles')
</head>
<body>
    @yield("menu")
</body>
    @yield("scripts")
</html>