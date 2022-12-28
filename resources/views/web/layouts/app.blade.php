<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <meta property="og:title" content="" />
    <meta property="og:image" content="assets/preview.jpg" />
    <meta property="og:description" content=""/>

    <script src="{{asset('tooltip/tooltip.js')}}"></script>
    <link href="{{asset('tooltip/tooltip.css')}}" rel="stylesheet">
    <script src="{{asset('modal-windows/modal_windows.js')}}"></script>
    <link href="{{ asset('modal-windows/modal_windows.css') }}" rel="stylesheet">

    <script src="{{asset('/js/jquery.min.js')}}"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">
    <link href="{{ asset('assets/favicon/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">

    @stack('app-css')

</head>
<body>

<div class="side_menu">
    @include('web.include.side_menu')
</div>

<div class="header">
    @include('web.include.header')
</div>

<div class="content">

    @yield('content')

</div>

@stack('scripts')

</body>

</html>
