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
    
    <!-- IMPORTACION JQUERY -->
    <script src="{{ asset('lib/jquery/jquery.min.js') }}" ></script>
    <!-- IMPORTACION BOOTSTRAP -->
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <!-- IMPORTACION SWEETALERT 2 -->
    <script src="{{ asset('lib/sweetalert/sweetalert2.all.min.js')}}"></script>
    <!-- Sticky Kit -->
    <script src="{{ asset('js/sticky-kit.js')}}"></script>
    <!-- Fontawesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous"></script>

    <!-- Flexslider -->
    <script src="{{asset('js/jquery_002.js')}}"></script>
    <!-- MAIN -->
    <script src="{{ asset('/js/main.js') }}"></script>
        
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('lib/DataTables/jquery.dataTables.spanish.js')}}"></script>}}
    <script src={{asset("lib/DataTables/Responsive-2.2.9/js/dataTables.responsive.js")}}></script>
    <style>
        .offcanvas {
            visibility: visible !important;
            position:static !important;
        }
        @yield('styles')
    </style>
    @yield('styles')
</head>
<body>
    @yield("menu")
</body>
    @yield("scripts")
</html>