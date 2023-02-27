@extends('web.layouts.app')
@section('title')
    Просмотр
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
                    <div class="card-header"><h2 class="text-muted" style="text-align: center" >Просмотр роли :   {{ $role->name }}</h2>

                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Назад</a>
                            </div>
                    </div>

                    <div class="table-responsive form51">
                            <table   class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 8%" scope="col">#</th>
                                    <th scope="col">Привелегии</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($rolePermissions))
                                    <?php
                                        $i=1;
                                    ?>
                                  @foreach ($rolePermissions as $v)
                                    <tr>
                                        <td scope="row-4">{{ $i++ }}</td>
                                        <td style="text-align: left">{{ $v->runame }}</td>


                                    </tr>
                                  @endforeach
                                @endif



                                </tbody>
                            </table>
                        </div>
                    </div>

    </div>
                </div>
            </div>

@endsection
