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
                    <div class="card-header"><h2 class="text-muted" style="text-align: center">Журнал событий</h2></div>
                    <div class="table-responsive form51"  style="height: 70.5vh">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th  class="centered" style="width: 10%">#</th>
                                    <th  class="centered" style="width: 45%">Описание события</th>
                                    <th  class="centered" style="width: 15%">Пользователь</th>
                                    <th  class="centered" style="width: 15%">IP адрес</th>
                                    <th  class="centered" style="width: 15%">Дата</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($logs as $log)
                                    <tr>
                                        <td class="centered">{{ ($i-- -($page-1)*20) }}</td>
                                        <td style="width: 60%" class="col-3">{{ $log->description }}</td>
                                        <td style="width: 10%" class="centered col-1">{{ $log->username }}</td>
                                        <td style="width: 10%" class="centered">{{ $log->ip }}</td>
                                        <td class="centered">{{ $log->created_at }}</td>
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
                    <td><p style="font-size: 18px">Всего записей:{{$all_logs->count()}}</p></td>
                    <td>  {{ $logs->links() }}</td>
                        <td><a href="{{ url('pdf_logs') }}" class="btn btn-success mb-2">Создать PDF</a>
                            <a href="{{ url('clear_logs') }}" class="btn btn-danger mb-2">Очистить журнал</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
