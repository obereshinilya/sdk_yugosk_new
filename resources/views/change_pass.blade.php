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
                    <h3 style="text-align: center">Ваш пароль устарел</h3><br>
                    <a style="margin-left: 46%" href={{"/change-password"}}>
                        <button type="button" class="btn btn-outline-dark">Обновить пароль
                        </button>
                    </a>


@endsection
