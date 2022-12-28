@extends('web.layouts.app')
@section('title')
    Админ панель Ролей
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

                            <div class="card-header"><h2 class="text-muted" style="text-align: center" >Список ролей пользователя</h2>
                @can('role-edit')
                    <a class="btn btn-success" href="{{ route('roles.create') }}"> + Создать</a>
                @endcan
                            </div>




    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

                <div class="table-responsive form51"  style="height: 70.5vh">
    <table class="table table-bordered">
        <tr>
            <th style="width: 8%">№</th>
            <th>Наименование</th>
            <th style="width: 40%">Операции с ролями</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Просмотр</a>
                    @can('role-edit')
                        <a style="margin-left: 12%" class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Редактирование</a>
                    @endcan
                    @can('role-edit')
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
                </div>
                </div>



                {!! $roles->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
