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
    <title>Restaurant Review</title>
    <!-- Bootstrap core CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/food.css') }}" rel="stylesheet"> 
</head>

<body class="home">
    
        @include('partials/header')
      
        @include('partials/banner')
       
        {{-- @include('partials/popular') --}}
        
        {{-- @include('partials/how') --}}
       
        {{-- @include('partials/featured') --}}
             
                {{-- @include('partials/add-new') --}}
            
        
        
        {{-- @include('partials/app') --}}
        
        @include('partials/footer') 
        
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
   <script src="{{ asset('js/jquery.min.js') }}"></script>
   <script src="{{ asset('js/tether.min.js') }}"></script>
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('js/animsition.min.js') }}"></script>
   
   
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgEKCmglHUF4eSSfD8jusFSxgFVjGnEPc&libraries=places"></script>
    <script src="js/maps.js"></script>
</body>

</html>
