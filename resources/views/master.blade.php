<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Restaurant</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" rel="stylesheet" />
    {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animsition.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">

    <!-- css animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- Custom styles for this template -->
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet">  --}}
    <link href="{{ asset('css/food.css') }}" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="{{ asset('css/recipe.css') }}">
    <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet">

</head>

<body class="home">
    {{-- <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out"> --}}
        @include('partials/header')

        @yield('content')
    {{-- </div> --}}
    
    @include('partials/footer') 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('js/tether.min.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap-3.min.js') }}"></script>
    {{-- <script src="{{ asset('js/animsition.min.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('js/jquery.isotope.min.js') }}"></script>
    @yield('plugins')
    {{-- <script src="{{ asset('js/headroom.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/foodpicky.min.js') }}"></script> --}}
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgEKCmglHUF4eSSfD8jusFSxgFVjGnEPc&libraries=places&callback=initMap"></script>
    <script src="js/maps.js"></script>
    <script src="{{ asset('js/lightbox-plus-jquery.js') }}"></script>
   
    <script src="{{ asset('js/food.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
    @yield('js')
</body>

</html>
