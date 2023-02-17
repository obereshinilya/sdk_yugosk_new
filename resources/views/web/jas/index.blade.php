@extends('web.layouts.app')
@section('title')
    Журнал аварийных событий
@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" defer></script>

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
                        <h2 class="text-muted"
                            style="text-align: center; width: 60%; display: inline-block; margin: 0 20px">Журнал
                            аварийных событий
                        </h2>

                        @can('jas-create')
                            <div class="bat_add" style="margin-left: 0; display: inline-block"><a
                                    href="/jas_new_record" style="display: inline-block">Добавить
                                    запись</a>
                            </div>
                        @endcan
                    </div>
                    <div style="display: inline-block; width: 50%">
                        <h3 class="text-muted" style="display: inline-block; margin-right: 20px">Период:</h3>
                        <input type="date" class="text-field__input" id="jas_start" onchange="get_data()"
                               style="width: 23%; display: inline-block; margin-right: 10px"
                               max="{{date('Y-m-d')}}"></input>
                        <input type="date" class="text-field__input" id="jas_end"
                               style="width: 23%; display: inline-block" onchange="get_data()"
                               max="{{date('Y-m-d')}}"></input>
                    </div>
                    <div style="display:inline-block; width: 24%; text-align: right">
                        @can('doc-create')
                            <div class="bat_info excel" style="display: inline-block"><a
                                    href="/excel_jas"
                                    style="display: inline-block">Экспорт в excel</a>
                            </div>

                            <div class="bat_info pdf" style="display: inline-block; margin-left: 0px"><a
                                    href="/pdf_jas"
                                    style="display: inline-block">Печать в pdf</a>
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
                                    <th style="text-align: center">Автор комментария</th>
                                    <th style="text-align: center">Состояние</th>
                                </tr>
                                </thead>
                                <tbody id="body_table">
                                {{--                                @foreach($data_to_jas as $key=>$row)--}}
                                {{--                                    <tr>--}}
                                {{--                                        <td style="text-align: center">--}}
                                {{--                                            {{$date[$key]}}--}}

                                {{--                                        </td>--}}
                                {{--                                        <td style="text-align: center">{{$row->status}}</td>--}}
                                {{--                                        <td style="text-align: center">{{$row->opo}}</td>--}}
                                {{--                                        <td style="text-align: center">{{$row->elem_opo}}</td>--}}
                                {{--                                        <td style="text-align: center">{{$row->sobitie}}</td>--}}
                                {{--                                        <td id="{{$row->id}}" contenteditable="true"--}}
                                {{--                                            onblur="save_comment(this.id, this.textContent)"--}}
                                {{--                                            style="text-align: center">{{$row->comment}}</td>--}}
                                {{--                                        <td style="text-align: center">--}}

                                {{--                                            @if ($row->check == false)--}}
                                {{--                                                @can('events-kavit')--}}
                                {{--                                                    <button row-id="{{$row->id}}" onclick="commit(this)"--}}
                                {{--                                                            class="btn btn-info"--}}
                                {{--                                                            style="color: whitesmoke; font-size: 13px; background-color: indianred">--}}
                                {{--                                                        Квитировать--}}
                                {{--                                                    </button>--}}
                                {{--                                                @endcan--}}
                                {{--                                            @else--}}
                                {{--                                                {{'Просмотрено'}}--}}
                                {{--                                            @endif--}}

                                {{--                                        </td>--}}
                                {{--                                    </tr>--}}
                                {{--                                @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--    </div>--}}

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                let date = new Date();
                let dd = date.getDate();
                if (dd < 10) dd = '0' + dd;
                let mm = date.getMonth() + 1;
                if (mm < 10) mm = '0' + mm;
                let yyyy = date.getFullYear();
                document.getElementById('jas_end').value = yyyy + '-' + mm + '-' + dd;
                let startdate = new Date();
                startdate.setMonth(startdate.getMonth() - 1);
                dd = startdate.getDate();
                if (dd < 10) dd = '0' + dd;
                mm = startdate.getMonth() + 1;
                if (mm < 10) mm = '0' + mm;
                yyyy = startdate.getFullYear();
                document.getElementById('jas_start').value = yyyy + '-' + mm + '-' + dd;
                get_data()


            })

            function get_data() {

                @can('doc-create')
                let pdf = document.querySelector('.pdf');
                pdf.firstChild.href = '/pdf_jas/' + document.getElementById('jas_start').value + '/' + document.getElementById('jas_end').value;
                let excel = document.querySelector('.excel');
                excel.firstChild.href = '/excel_jas/' + document.getElementById('jas_start').value + '/' + document.getElementById('jas_end').value;
                @endcan


                // console.log(document.getElementById('jas_end').value)
                $.ajax({
                    url: '/get_jas/' + document.getElementById('jas_start').value + '/' + document.getElementById('jas_end').value,
                    type: 'GET',
                    success: (res) => {
                        if (res.length) {
                            if ($.fn.dataTable.isDataTable('#myTable')) {
                                $('#myTable').DataTable().destroy();
                            }
                            let table_body = document.getElementById('body_table')
                            table_body.innerHTML = '';
                            for (var row of res) {
                                var tr = document.createElement('tr')
                                let date = new Date(row['date']);
                                let dd = date.getDate();
                                if (dd < 10) dd = '0' + dd;
                                let mm = date.getMonth() + 1;
                                if (mm < 10) mm = '0' + mm;
                                let yyyy = date.getFullYear();

                                tr.innerHTML += `<td style="text-align: center">${dd}.${mm}.${yyyy}  ${row['date'].split('.')[0].split(' ')[1]}  </td>`
                                tr.innerHTML += `<td style="text-align: center">${row['status']}</td>`

                                tr.innerHTML += `<td style="text-align: center">${row['opo']}</td>`


                                tr.innerHTML += `<td style="text-align: center"><p onclick="go_to_tb(this)" style="cursor:pointer">${row['elem_opo']}</p></td>`
                                tr.innerHTML += `<td style="text-align: center">${row['sobitie']}</td>`
                                tr.innerHTML += `<td style="text-align: center" id='${row['id']}' contenteditable="true" onblur="save_comment(this.id, this.textContent)" >${row['comment']}</td>`
                                tr.innerHTML += `<td style="text-align: center">${row['author']}</td>`

                                if (!row['check']) {
                                    @can('events-kavit')
                                        tr.innerHTML += `<td style="text-align: center"><button row-id="${row['id']}" onclick="commit(this)" class="btn btn-info" style="color: whitesmoke; font-size: 13px; background-color: indianred">  Квитировать </button> </td>`
                                    @endcan
                                } else {
                                    tr.innerHTML += `<td style="text-align: center">Просмотрено</td>`;
                                }

                                table_body.appendChild(tr)

                            }
                            $('#myTable').DataTable({
                                "pagingType": "full_numbers",
                                destroy: true,
                                order: [[0, 'desc']],
                            });
                        } else {
                            if ($.fn.dataTable.isDataTable('#myTable')) {
                                $('#myTable').DataTable().destroy();
                            }
                            let table_body = document.getElementById('body_table')
                            table_body.innerHTML = '';
                            $('#myTable').DataTable({
                                "pagingType": "full_numbers",
                                destroy: true,
                                order: [[0, 'desc']],
                            });
                        }
                        console.log(res.length)

                    },
                    error: function (error) {
                        var table_body = document.getElementById('body_table')
                        table_body.innerText = ''
                    },

                })

            }

            function commit(button) {
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

            function save_comment(id_jas, text) {
                if (!text) {
                    text = ''
                }
                $.ajax({
                    url: '/save_comment/' + id_jas + '/' + text,
                    type: 'GET',
                    success: (res) => {
                        get_data()
                    }
                })
            }

            function go_to_tb(el) {
                let name = el.textContent;
                $.ajax({
                    url: '/get_tb/' + name,
                    type: 'GET',
                    success: (res) => {
                        if (Array.isArray(res)) {
                            localStorage.open_kc = Number(res[1].split('-')[1]);
                            localStorage.item = res[2];
                            window.location.href = '/ks'
                        } else {
                            localStorage.item = res;
                            window.location.href = '/opo'
                        }
                    }
                })
            }

        </script>
@endsection
