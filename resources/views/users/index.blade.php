@extends('web.layouts.app')
@section('title')
    Административная панель
@endsection
@section('content')
    @push('app-css')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endpush
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    @include('web.admin.inc.menu')
                    <div class="card-header"><h2 class="text-muted" style="text-align: center">Список пользователей СДК ПБ</h2>
                    @can('user-edit')
                        <a class="btn btn-success" href="{{ route('users.create') }}"> + Создать</a>
                    @endcan
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="table-responsive form51"  style="height: 67vh">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 4%" >№</th>
                                <th style="width: 14%">Логин</th>
                                <th style="width: 30%">Email</th>
                                <th style="width: 16%">Роли</th>
                                <th style="width: 36%">Операции</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="centered">{{ ($i-- -($page-1)*12) }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">Просмотр</a>
                                        @can('user-edit')
                                        <a style="margin-left: 2%" class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">Редактирование</a>
                                        @if ($user->isBanned())
                                            <a style="margin-left: 2%" href = 'admin/unban/{{ $user->id }}' class="btn btn-secondary btn-sm ">Разблокировать</a>
                                        @endif
                                        @if ($user->isNotBanned())
                                            <a style="margin-left: 2%" href = 'admin/ban/{{ $user->id }}' class="btn btn-warning  btn-sm">Заблокировать</a>
                                        @endif
                                        <div style="margin-right: 0%">
                                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Удалить', ['class' => 'btn btn-danger btn-sm', 'style'=>'margin-right: 1%']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="table_use" style="width: 61%; margin-left: 22.2%">
            <table class="table table-hover " style="width: border-box">
                <tbody>
                <tr>
                    <td style="width: 43%"><p style="font-size: 18px">Всего пользователей:{{$all_user->count()}}</p></td>
                    <td style="margin-right: auto">  {{ $users->links() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
