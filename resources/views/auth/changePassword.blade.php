@extends('web.layouts.app')
@section('title')
    Изменение пароля
@endsection
@section('content')
    @push('app-css')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endpush
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Изменение пароля</div>

                    <div class="card-body">
                        <h4 style="color: red; text-align: center">{{$error}}</h4>
                        <form method="POST" action="{{ route('change.password') }}">
                            @csrf

                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Действующий пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                </div>
                            </div>
                            <div class="form-group row" style="font-size: 13px; color:grey; margin-left: 20%">
                                @if($password_config->up_register == 1 || $password_config->num_check == 1 || $password_config->spec_check == 1)

                                    <br><h9>Новый пароль должен содержать:</h9>
                                    @if($password_config->up_register == 1)
                                        <h9> заглавные буквы</h9>
                                        @if($password_config->num_check == 1 || $password_config->spec_check == 1)
                                            <h9>;</h9>
                                        @endif
                                    @endif
                                    @if($password_config->num_check == 1)
                                        <h9> цифры</h9>
                                        @if($password_config->spec_check == 1)
                                            <h9>;</h9>
                                        @endif
                                    @endif
                                    @if($password_config->spec_check == 1)
                                        <h9> специальные символы</h9>
                                    @endif
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Новый пароль</label>
                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Подтвердите новый пароль</label>

                                <div class="col-md-6">
                                    <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                       Сохранить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
