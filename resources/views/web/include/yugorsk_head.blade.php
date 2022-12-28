<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="" />
<meta name="description" content="" />
<title>@yield('title')</title>
<meta property="og:title" content="" />
<meta property="og:image" content="assets/preview.jpg" />
<meta property="og:description" content=""/>
<link href="assets/favicon/favicon.ico" rel="shortcut icon" type="image/x-icon">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/fonts/fonts.css">
{{--    То, что было в старой шапке--}}
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<script src="{{asset('/js/jquery.min.js')}}"></script>
@stack('app-css')
<script src="{{asset('tooltip/tooltip.js')}}"></script>
<link href="{{asset('tooltip/tooltip.css')}}" rel="stylesheet">
<script src="{{asset('modal-windows/modal_windows.js')}}"></script>
<link href="{{ asset('modal-windows/modal_windows.css') }}" rel="stylesheet">

<style>
    /*!*.btn {*!*/

    /*!*}*!*/
    /*.btn-danger {*/
    /*    display: inline-block;*/
    /*    padding: 6px 12px;*/
    /*    margin-bottom: 0;*/
    /*    font-size: 14px;*/
    /*    font-weight: normal;*/
    /*    line-height: 1.42857143;*/
    /*    text-align: center;*/
    /*    white-space: nowrap;*/
    /*    vertical-align: middle;*/
    /*    -ms-touch-action: manipulation;*/
    /*    touch-action: manipulation;*/
    /*    cursor: pointer;*/
    /*    -webkit-user-select: none;*/
    /*    -moz-user-select: none;*/
    /*    -ms-user-select: none;*/
    /*    user-select: none;*/
    /*    background-image: none;*/
    /*    border: 1px solid transparent;*/
    /*    border-radius: 4px;*/
    /*    color: #fff;*/
    /*    background-color: #d9534f;*/
    /*    border-color: #d43f3a;*/
    /*    font-family: 'HeliosCond'!important;*/
    /*    text-decoration: none;*/
    /*    margin-top: 20px;*/

    /*    border-radius: 8px;*/
    /*}*/
</style>
