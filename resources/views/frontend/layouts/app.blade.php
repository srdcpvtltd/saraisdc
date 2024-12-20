<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hotel Visitor Management System') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <!-- Styles -->
    <link href="{{ asset('css/hotel/app.css') }}" rel="stylesheet">
</head>
<body>
    @yield('content')

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('third-party/jquery-3.6.0.min.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
    @yield('js')
</body>
</html>
