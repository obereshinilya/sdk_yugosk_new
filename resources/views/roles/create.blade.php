@extends('web.layouts.app')
@section('title')
    Создание
@endsection



@section('content')
    <style>
        body {
            overflow-y: scroll;
        }
    </style>
    @push('app-css')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endpush
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @include('web.admin.inc.menu')
                    <div class="card-header"><h2 class="text-muted" style="text-align: center" >Создание новой роли</h2>

                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Назад</a>
                        </div>
                    </div>



                @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
     <div class="row px-xl-5">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div style="padding: 15px" class="">
                    <strong  class="text-muted h3">Наименование новой роли:</strong>
                </div>
                {!! Form::text('name', null, array('placeholder' => 'Введите наименование','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div style="padding: 15px" class="">
                    <strong class="text-muted h3">Выберите привелегии для роли:</strong>
                    <br/>
                <br/>
                @foreach($permission as $value)
                    <label class="h4 text-muted">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        {{ $value->runame }}</label>
                    <br/>
                @endforeach
            </div>
        </div>
            <div style="padding-bottom: 40px" class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
    </div>
    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
