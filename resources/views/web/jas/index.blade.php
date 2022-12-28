@extends('web.layouts.app')
@section('title')
    Журнал аварийных событий
@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>

    @include('web.include.sidebar_doc')
    <style>
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            line-height: 1.6;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        @media (prefers-reduced-motion: reduce) {
            .btn {
                transition: none;
            }
        }

        .btn:hover {
            color: #212529;
            text-decoration: none;
        }

        .btn:focus,
        .btn.focus {
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.25);
        }

        .btn.disabled,
        .btn:disabled {
            opacity: 0.65;
        }

        .btn:not(:disabled):not(.disabled) {
            cursor: pointer;
        }


        btn-info {
            color: #212529;
            background-color: #4aa0e6;
            border-color: #6cb2eb;
        }

        .btn-info:hover {
            color: #fff;
            background-color: #4aa0e6;
            border-color: #3f9ae5;
        }

        /*.btn-info:focus,*/
        /*.btn-info.focus {*/
        /*    color: #fff;*/
        /*    background-color: #4aa0e6;*/
        /*    border-color: #3f9ae5;*/
        /*    box-shadow: 0 0 0 0.2rem rgba(97, 157, 206, 0.5);*/
        /*}*/

        /*.btn-info.disabled,*/
        /*.btn-info:disabled {*/
        /*    color: #212529;*/
        /*    background-color: #6cb2eb;*/
        /*    border-color: #6cb2eb;*/
        /*}*/

        /*.btn-info:not(:disabled):not(.disabled):active,*/
        /*.btn-info:not(:disabled):not(.disabled).active,*/
        /*.show > .btn-info.dropdown-toggle {*/
        /*    color: #fff;*/
        /*    background-color: #3f9ae5;*/
        /*    border-color: #3495e3;*/
        /*}*/

        /*.btn-info:not(:disabled):not(.disabled):active:focus,*/
        /*.btn-info:not(:disabled):not(.disabled).active:focus,*/
        /*.show > .btn-info.dropdown-toggle:focus {*/
        /*    box-shadow: 0 0 0 0.2rem rgba(97, 157, 206, 0.5);*/
        /*}*/
    </style>

    <div style="height: 75.3vh">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h2 class="text-muted" style="text-align: center; width: 60%; display: inline-block; margin: 0 20px">Журнал аварийных событий
                        </h2>
                        @can('jas-create')
                            <div class="bat_add" style="margin-left: 0; display: inline-block"><a
                                    href="/jas_new_record" style="display: inline-block">Добавить
                                    запись</a>
                            </div>
                        @endcan
                    </div>

                    <div class="inside_tab_padding form51" style="height:102%; padding-left: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table class="myTable" id="myTable">
                                <thead>
                                <tr>
                                    <th style="text-align: center">Дата</th>
                                    <th style="text-align: center">Статус</th>
                                    <th style="text-align: center">ОПО</th>
                                    <th style="text-align: center">Элемент ОПО</th>
                                    <th style="text-align: center">Описание события</th>
                                    <th style="text-align: center">Комментарий</th>
                                    <th style="text-align: center">Состояние</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data_to_jas as $row)
                                    <tr>
                                        <td style="text-align: center">
{{--                                            {{$row->date}}--}}
                                            <?php
                                            echo date("Y-m-d H:i:s", strtotime($row->date))
                                            ?>
                                        </td>
                                        <td style="text-align: center">{{$row->status}}</td>
                                        <td style="text-align: center">{{$row->opo}}</td>
                                        <td style="text-align: center">{{$row->elem_opo}}</td>
                                        <td style="text-align: center">{{$row->sobitie}}</td>
                                        <td id="{{$row->id}}" contenteditable="true" onblur="save_comment(this.id, this.textContent)" style="text-align: center">{{$row->comment}}</td>
                                        <td style="text-align: center">

                                            @if ($row->check == false)
                                                @can('events-kavit')
                                                    <button row-id="{{$row->id}}" onclick="commit(this)" class="btn btn-info" style="color: whitesmoke; font-size: 13px; background-color: indianred">Квитировать
                                                    </button>
                                                @endcan
                                            @else
                                                {{'Просмотрено'}}
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--    </div>--}}

    <script>
        function commit(button){
	var id = button.getAttribute('row-id')
$.ajax({
                    url: '/jas_commit/' + id,
                    type: 'GET',
                    success: (res) => {
                        var td = button.parentNode
                        //td.removeChild(this)
                        td.innerText = 'Просмотрено'
                    }
                })
	}
        function save_comment(id_jas, text){
            if (!text){
                text = ''
            }
            $.ajax({
                url: '/save_comment/'+id_jas+'/'+text,
                type: 'GET',
                success: (res) => {
                }
            })
        }
        $(document).ready(function () {
            $('#myTable').DataTable({
                "pagingType": "full_numbers",
                destroy: true,
                order: [[0, 'desc']],
            });
            //$('.btn').click(function () {
	//	var id = this.getAttribute('row-id')
          //      $.ajax({
            //        url: '/jas_commit/' + id,
              //      type: 'GET',
              //      success: (res) => {
                //        var td = this.parentNode
                        //td.removeChild(this)
                  //      td.innerText = 'Просмотрено'
                   // }
              //  })
//            });
        });
    </script>
@endsection
