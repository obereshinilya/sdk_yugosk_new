@extends('web.layouts.app')
@section('title')
    Админ панель Привелегии
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
                    <div class="card-header"><h2 class="text-muted" style="text-align: center" >Список привилегий</h2></div>
                    <div class="table-responsive form51"  style="height: 70.5vh">
                            <table   class="table table-hover table-bordered" >
                            <thead>
                            <tr>
                                <th class="centered">#</th>
                                <th>Наименование</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            ?>
                            @foreach ($perms as $perm)
                                <tr style="height: 5%">
                                    <td>{{ $i++ }}</td>
                                    <td style="text-align: left">{{ $perm->runame }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
