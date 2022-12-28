@extends('web.layouts.app')
@section('title')
    Внимание
@endsection

@section('content')
    @push('app-css')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endpush
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2 class="text-muted" style="text-align: center" >Внимание!</h2><br>
                    <h3 style="text-align: center">Время пользования системы для данного пользователя на сегодняшний день истекло</h3><br>


@endsection
