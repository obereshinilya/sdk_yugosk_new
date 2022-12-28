@extends('web.layouts.app')
@section('title')
    Редактирование
@endsection
@push('app-css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @include('web.admin.inc.menu')
                    <div class="card-header"><h2 class="text-muted" style="text-align: center" >Редактирование данных пользователя : {{ $user->name }}</h2>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Назад</a>
            </div>
        </div>






    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}

                    <div class="table-responsive" style="height: 72vh; overflow-x:hidden">
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
                            @if ($message = Session::get('success'))
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div style="padding: 10px" class="">
                                    <strong class="text-muted h5">Фамилия:</strong>
                                </div>
                                {!! Form::text('surname', null, array('placeholder' => 'Введите фамилию','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div style="padding: 10px" class="">
                                    <strong class="text-muted h5">Имя:</strong>
                                </div>
                                {!! Form::text('imya', null, array('placeholder' => 'Введите имя','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div style="padding: 10px" class="">
                                    <strong class="text-muted h5">Отчество:</strong>
                                </div>
                                {!! Form::text('middle_name', null, array('placeholder' => 'Введите отчество','class' => 'form-control')) !!}
                            </div>
                        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div style="padding: 10px" class="">
                <strong class="text-muted h5">Логин:</strong>
                </div>
                {!! Form::text('name', null, array('placeholder' => 'Введите логин','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div style="padding: 10px" class="">
                    <strong class="text-muted h5">Email:</strong>
                </div>
                {!! Form::text('email', null, array('placeholder' => 'Введите Email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div style="padding: 10px" class="">
                    <strong class="text-muted h5">Сменить пароль пользователя:</strong>
                    <input id="checkbox" type='checkbox' name='checkbox-accordion' style="margin-left: 5%" id="faq" onclick="SaveChecked()">
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12" id="password" style="display: none">
            <div class="form-group">
                <div style="padding: 10px" class="">
                    <strong class="text-muted h5">Пароль:</strong>
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
                {!! Form::password('password', array('placeholder' => 'Введите пароль','class' => 'form-control', 'minlength'=>"$password_config->num_znak")) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" id="password_confirm" style="display: none">
            <div class="form-group">
                <div style="padding: 10px" class="">
                    <strong class="text-muted h5">Подтверждение пароля:</strong>
                </div>
                {!! Form::password('confirm-password', array('placeholder' => 'Введите пароль повторно','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div style="padding: 10px" class="">
                    <strong class="text-muted h5">Роли пользователя:</strong>
                </div>
                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
            </div>
        </div>
        <div class="form-group">
            <div style="padding: 10px" class="">
                <strong class="text-muted h5">Время доступа к системе:</strong>
            </div>
            <table style="width: 40%; margin-left: 30%">
                <th class="text-muted h5" style="width: 3%; text-align: center"><h5>C</h5></th>
                <th style="width: 5%">{!! Form::time('time_begin', null, array('placeholder' => 'Введите время начала сессии','class' => 'form-control', 'required', 'style' => 'width: 50%;text-align: center')) !!}</th>
                <th class="text-muted h5" style="width: 3%; text-align: center"><h5>по</h5></th>
                <th style="width: 5%">{!! Form::time('time_stop', null, array('placeholder' => 'Введите время окончания сессии','class' => 'form-control', 'required', 'style' => 'width: 50%; text-align: center')) !!}</th>
            </table>
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
    </div>

    <script>
        function SaveChecked(){
            if (document.getElementById('checkbox').checked){
                document.getElementById('password').style.display = 'block';
                document.getElementById('password_confirm').style.display = 'block';
            } else {
                document.getElementById('password').style.display = 'none';
                document.getElementById('password_confirm').style.display = 'none';
            }
        }
    </script>
@endsection
