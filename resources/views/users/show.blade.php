@extends('web.layouts.app')
@section('title')
    Просмотр пользователя
@endsection

@section('content')
    @push('app-css')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endpush

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @include('web.admin.inc.menu')
                    <div class="card-header"><h2 class="text-muted" style="text-align: center" >Просмотр данных пользователя :{{ $user->name }}</h2>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('users.index') }}"> Назад</a>
                            </div>
                        </div>
                    </div>


          <div class="table-responsive" >
              <div style="height: 75vh" class="no_tab_table open">
          <table   class="table table-hover table-bordered">
              <tbody>
              <tr>
                  <td><div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <div style="padding: 10px" class="">
                                  <strong class="text-muted h5">Фамилия:      {{ $user->surname }}</strong>
                              </div>

                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <div style="padding: 10px" class="">
                                  <strong class="text-muted h5">Имя:      {{ $user->imya }}</strong>
                              </div>

                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <div style="padding: 10px" class="">
                                  <strong class="text-muted h5">Отчество:      {{ $user->middle_name }}</strong>
                              </div>

                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
        <td><div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">
                <div style="padding: 10px" class="">
                    <strong class="text-muted h5">Логин:      {{ $user->name }}</strong>
                </div>

            </div>
        </div>
        </td>
              </tr>
                <tr>
                    <td>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div style="padding: 10px" class="">
                    <strong class="text-muted h5">Email:   {{ $user->email }}</strong>
                </div>

            </div>
        </div>
              </td>
              </tr>
                <tr>
                    <td>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div style="padding: 10px" class="">
                    <strong class="text-muted h5">Роли пользователя:</strong>

                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
              </td>
              </tr>
              <tr>
                  <td>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <div style="padding: 10px" class="">
                                  <strong class="text-muted h5">Доступ к системе предоставлен:   {{"C"." ".$user->time_begin." "."по"." ".$user->time_stop }}</strong>
                              </div>

                          </div>
                      </div>
                  </td>
              </tr>
              </tbody>
          </table>
    </div>
                </div>
            </div>
        </div>
        </div>

    </div>



@endsection
