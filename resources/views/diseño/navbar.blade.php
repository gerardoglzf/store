<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-toggle.min.css') }}">

    <title>TecStore - @yield('title')</title>
</head>
<body>
    <!--Navbar-->
    <div class="topnav">
        <a class="active" href="/">TecStore</a>
        <a href="#contact">Contacto</a>
        <a href="#about">Acerca de</a>
    </div>   
    <!--Navbar-->
    
    <div class="container-fluid">
        @yield('content')
    </div>
    
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('js/pooper.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="{{ asset('js/logica.js') }}"></script> 
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    
</body>
</html>