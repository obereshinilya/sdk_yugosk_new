@extends('web.layouts.app')
@section('title')
    Создание
@endsection
@push('app-css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center"">
            <div class="col-md-12">
                <div class="card" >
                    @include('web.admin.inc.menu')
                    <div class="card-header"><h2 class="text-muted" style="text-align: center" >Создание пользователя</h2>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('users.index') }}"> Назад</a>
                        </div>
                    </div>



    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                    <div class="table-responsive" style="overflow-x:hidden">
                                <div class="col-xs-12 col-sm-12 col-md-12"  style="height: 76vh">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>Внимание!</strong> Неверно заполнена форма<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                            <div class="form-group">
                                <div style="padding: 10px" class="">
                                    <strong class="text-muted h3">Фамилия:</strong>
                                </div>
                                {!! Form::text('surname', null, array('placeholder' => 'Введите фамилию','class' => 'form-control', 'required')) !!}
                            </div>
                            <div class="form-group">
                                <div style="padding: 10px" class="">
                                    <strong class="text-muted h3">Имя:</strong>
                                </div>
                                {!! Form::text('imya', null, array('placeholder' => 'Введите имя','class' => 'form-control', 'required')) !!}
                            </div>
                            <div class="form-group">
                                <div style="padding: 10px" class="">
                                    <strong class="text-muted h3">Отчество:</strong>
                                </div>
                                {!! Form::text('middle_name', null, array('placeholder' => 'Введите отчество','class' => 'form-control', 'required')) !!}
                            </div>
                            <div class="form-group">
                                <div style="padding: 10px" class="">
                                    <strong class="text-muted h3">Логин:</strong>
                                </div>
                                {!! Form::text('name', null, array('placeholder' => 'Введите логин','class' => 'form-control', 'required')) !!}
                            </div>
            <div class="form-group">
                <div style="padding: 10px" class="">
                    <strong class="text-muted h3">Email:</strong>
                </div>
                {!! Form::text('email', null, array('placeholder' => 'Введите email','class' => 'form-control', 'required')) !!}
            </div>
            <div class="form-group">
                <div style="padding: 10px" class="">
                    <strong class="text-muted h3">Пароль:</strong>
                    @if($password_config->up_register == 1 || $password_config->num_check == 1 || $password_config->spec_check == 1)
                        <br><h9>Пароль должен содержать:</h9>
                        @if($password_config->up_register == 1)
                            <h9>заглавные буквы</h9>
                            @if($password_config->num_check == 1 || $password_config->spec_check == 1)
                                <h9>;</h9>
                            @endif
                        @endif
                        @if($password_config->num_check == 1)
                            <h9>цифры</h9>
                            @if($password_config->spec_check == 1)
                                <h9>;</h9>
                            @endif
                        @endif
                        @if($password_config->spec_check == 1)
                            <h9>специальные символы:</h9><h9 style="margin-left: 3%">! % ? @ , . < > # № ^</h9>
                        @endif
                    @endif
                </div>
                {!! Form::password('password', array('placeholder' => 'Введите пароль','class' => 'form-control', 'required', 'minlength'=>"$password_config->num_znak")) !!}
            </div>
                                    <div class="form-group">
                                    <div style="padding: 10px" class="">
                        <strong class="text-muted h3">Подтверждение пароля:</strong>
                    </div>
                {!! Form::password('confirm-password', array('placeholder' => 'Повторно введите пароль','class' => 'form-control', 'required')) !!}
            </div>
            <div class="form-group">
                <div style="padding: 10px" class="">
                    <strong class="text-muted h3">Роли пользователя:</strong>
                </div>
                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
            </div>
            <div class="form-group">
                <div style="padding: 10px" class="">
                    <strong class="text-muted h3">Время доступа к системе:</strong>
                </div>
                <table style="width: 40%; margin-left: 30%">
                    <th class="text-muted h3" style="width: 3%; text-align: center"><h4>C</h4></th>
                    <th style="width: 5%">{!! Form::time('time_begin', null, array('placeholder' => 'Введите время начала сессии','class' => 'form-control', 'required', 'style' => 'width: 50%;text-align: center')) !!}</th>
                    <th class="text-muted h3" style="width: 3%; text-align: center"><h4>по</h4></th>
                    <th style="width: 5%">{!! Form::time('time_stop', null, array('placeholder' => 'Введите время окончания сессии','class' => 'form-control', 'required', 'style' => 'width: 50%; text-align: center')) !!}</th>
                </table>
            </div>
                        <div class="form-group">
                            <div style="padding: 10px" class="">

                        <button type="submit" class="btn btn-primary" style="margin-left: 45%">Сохранить</button>
    </div>
    </div>
    </div>
    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
