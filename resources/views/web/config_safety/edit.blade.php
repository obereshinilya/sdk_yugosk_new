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
                    <div class="card-header">
                        <h2 class="text-muted" style="text-align: center" >Информация о конфигурации безопасности</h2>

        </div>






    {!! Form::model($config, ['method' => 'POST','route' => ['update_config_safety']]) !!}

                    <div class="table-responsive" style="height: 76vh; overflow-x:hidden">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Внимание!</strong> Неверно заполнена форма<br><br>
                                <ul>
                                    <li>Убедитесь, что все поля заполнены верно</li>
                                </ul>
                            </div>
                        @endif
                    <table class="tab_config">
                        <tbody>
                        <tr>
                            <td><strong class="text-muted h5">Количество символов: </strong></td>
                            <td> {!! Form::text('num_znak', null, array('placeholder' => 'Укажите количество символов', 'class' => 'form-control', 'required', 'style' => 'width: 30%; height: 10%')) !!}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-muted h5">Наличие заглавных букв:</strong></td>
                            <td>{!! Form::select('up_register', array('1' => 'Обязательно', '0' => 'Не обязательно'), null, ['style' => 'width: 70%', 'class' => 'form-control', 'required']) !!}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-muted h5">Наличие цифр:</strong></td>
                            <td>{!! Form::select('num_check', array('1' => 'Обязательно', '0' => 'Не обязательно'), null, ['style' => 'width: 70%', 'class' => 'form-control', 'required']) !!}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-muted h5">Наличие специальных символов:</td>
                            <td>{!! Form::select('spec_check', array('1' => 'Обязательно', '0' => 'Не обязательно'), null, ['style' => 'width: 70%', 'class' => 'form-control', 'required']) !!}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-muted h5">Количество попыток ввода:</strong></td>
                            <td>{!! Form::text('num_error', null, array('placeholder' => 'Укажите количество попыток ввода','class' => 'form-control', 'required', 'style' => 'width: 30%; height: 10%')) !!}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-muted h5">Количество паролей в истории:</strong></td>
                            <td>{!! Form::text('num_password', null, array('placeholder' => 'Укажите количество паролей в истории','class' => 'form-control', 'required', 'style' => 'width: 30%; height: 10%')) !!}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-muted h5">Длительность блокировки (мин.):</strong></td>
                            <td>{!! Form::text('time_ban', null, array('placeholder' => 'Укажите длительность блокировки в минутах','class' => 'form-control', 'required', 'style' => 'width: 30%; height: 10%')) !!}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-muted h5" id="session_long">Длительность cессии (мин.):</strong></td>
                            <td>{!! Form::text('time_session', null, array('placeholder' => 'Укажите длительность сессии в минутах','class' => 'form-control', 'required', 'style' => 'width: 30%; height: 10%')) !!}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-muted h5" id="session_long">Время действия пароля (дней):</strong></td>
                            <td>{!! Form::text('time_password', null, array('placeholder' => 'Укажите время действия пароля','class' => 'form-control', 'required', 'style' => 'width: 30%; height: 10%')) !!}</td>
                        </tr>

                        </tbody>
                    </table>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div style="padding: 10px; text-align: center" class="">
                                    <strong class="text-muted h5" id="session_long">Настройка журнала событий:</strong>
                                </div>
                            </div>
                        </div>
                        <table style="background-color: #87CEFA; margin-left: 5%; width: 90%">
                            <td>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div style="padding: 10px" class="">
                                            <strong class="text-muted h5" id="session_long">Допустимое количество записей:</strong>
                                        </div>
                                        {!! Form::text('js_max', null, array('placeholder' => 'Укажите макс. кол-вл записей','class' => 'form-control', 'required', 'style' => 'width: 30%; text-align: center')) !!}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div style="padding: 10px" class="">
                                            <strong class="text-muted h5" id="session_long">Предупреждение о заполненности (%):</strong>
                                        </div>
                                        {!! Form::text('js_attention', null, array('placeholder' => '% заполненности','class' => 'form-control', 'required', 'style' => 'width: 30%; background-color: #FFFF00; text-align: center')) !!}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div style="padding: 10px" class="">

                                            <strong class="text-muted h5" id="session_long">Аварийное предупреждение о заполненности (%):</strong>
                                        </div>
                                        {!! Form::text('js_warning', null, array('placeholder' => '% заполненности','class' => 'form-control', 'required', 'style' => 'width: 30%; background-color: #BC8F8F; text-align: center')) !!}
                                    </div>
                                </div>
                            </td>
                        </table>

                        <div style="padding-bottom: 40px; margin-top: 20px" class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a class="btn btn-primary" href="{{ route('admin') }}">Назад</a>
                        </div>
                    </div>

    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
<style>
    table.tab_config{
        width: 60%;
        text-align: center;
        border-collapse:collapse;
        border-spacing:0;
        height: auto;
        margin-left: 20%;
        margin-bottom: 5%;
        margin-top: 5%;
    }

</style>

@endsection


