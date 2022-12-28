@extends('web.layouts.app')

@section('title')
    График комплексных ПАТ
@endsection

@section('content')
    {{--    Включаем всплывашку с новым сообщением о событии--}}
    @can('events-view')
        @include('web.admin.inc.new_JAS')
    @endcan
    @include('web.include.sidebar_doc')
    <style>
        th, td{
            word-break: break-word;
        }


.form51 table tr th{padding: 2px 3px}
.form51 table tr td{padding: 2px 3px}

        @can('report-edit')
        #table_for_search tr td:last-of-type {
            /*display: flex;*/
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 25px 0;
        }

        @endcan
        table {
            -webkit-print-color-adjust: exact; /* благодаря этому заработал цвет*/
            white-space: -moz-pre-wrap; /* Mozilla, начиная с 1999 года */
            white-space: -pre-wrap; /* Opera 4-6 */
            white-space: -o-pre-wrap; /* Opera 7 */
            word-wrap: break-word;
        / word-break: break-all;
        }
    </style>
    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline">График
                            комплексных противоаварийных тренировок I - II уровня на опасных производственных объектах
                            ООО «Газпром трансгаз Югорск» на
                        </h2>
                        <select class="select-css" id="select__year" onchange="get_data()"
                                style="width: 11%; display: inline-block; margin-left: 2%">
                            @for($i=2021; $i<=2030; $i++)
                                <option value="{{$i}}">{{$i}} год</option>
                            @endfor
                        </select>
                    </div>
                    <div class="doc_header" style="padding-bottom: 6px">
                        <table>
                            <tbody>
                            <tr>
                                <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}">
                                </td>
                                <td><input type="text" id="search_text" placeholder="Поиск..."></td>
                                <td>
                                    @can('doc-create')
                                        <div class="bat_info excel" style="display: inline-block; margin-left: 0px"><a
                                                href="/excel_pat_schedule/"
                                                style="display: inline-block">Экспорт в excel</a>
                                        </div>
                                        <div class="bat_info pdf" style="display: inline-block; margin-left: 0px"><a
                                                href="/pdf_pat_schedule/"
                                                style="display: inline-block">Печать в pdf</a>
                                        </div>
                                    @endcan
                                    <div class="bat_info" style="display: inline-block; margin-left: 0px"><a
                                            href="/docs/pat_themes"
                                            style="display: inline-block">Перечень тренировок</a>
                                    </div>
                                    @can('entries-add')
                                        <div class="bat_add" style="display: inline-block; margin-left: 0;"><a
                                                href="/docs/pat_schedule/create">Добавить запись</a></div>
                                    @endcan
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:73.5vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px; width: 130%" class="form51">
                            <table id="table_for_search" style="display: table; table-layout: fixed; width: 100%">
                                <thead>
                                <tr>
                                    <th style="text-align: center; width: 3%">№ п/п</th>
                                    <th style="text-align: center; width:8%; padding: 10px 2px">Наименование филиала
                                    </th>
                                    <th style="text-align: center; width:8%;padding: 10px 2px">Рег. № ОПО</th>
                                    <th style="text-align: center; width:8%;padding: 10px 2px">Наименование ОПО</th>
                                    <th style="text-align: center; padding: 10px 2px">Январь, <br>№ темы</th>
                                    <th style="text-align: center; padding: 10px 2px">Февраль, <br>№ темы</th>
                                    <th style="text-align: center; padding: 10px 2px">Март, <br>№ темы</th>
                                    <th style="text-align: center; padding: 10px 2px">Апрель, <br>№ темы</th>
                                    <th style="text-align: center; padding: 10px 2px">Май, <br>№ темы</th>
                                    <th style="text-align: center; padding: 10px 2px">Июнь, <br>№ темы</th>
                                    <th style="text-align: center; padding: 10px 2px">Июль, <br>№ темы</th>
                                    <th style="text-align: center; padding: 10px 2px">Август, <br>№ темы</th>
                                    <th style="text-align: center; padding: 10px 2px">Сентябрь, <br>№ темы</th>
                                    <th style="text-align: center; padding: 10px 2px">Октябрь, <br>№ темы</th>
                                    <th style="text-align: center; padding: 10px 2px">Ноябрь, <br>№ темы</th>
                                    <th style="text-align: center; padding: 10px 2px">Декабрь, <br>№ темы</th>
                                    @can('report-edit')
                                        <th></th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody id="body_table">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var date = new Date();
                document.getElementById('select__year').value = date.getFullYear()
                get_data()
            })

            function get_data() {
                @can('doc-create')
                let pdf = document.querySelector('.pdf');
                pdf.firstChild.href = '/pdf_pat_schedule/' + document.getElementById('select__year').value;
                let excel = document.querySelector('.excel');
                excel.firstChild.href = '/excel_pat_schedule/' + document.getElementById('select__year').value;
                @endcan
                var table_body = document.getElementById('body_table')
                table_body.innerText = ''
                $.ajax({
                    url: '/docs/pat_schedule/get_params/' + document.getElementById('select__year').value,
                    type: 'GET',
                    success: (res) => {
var num =1
                        for (var row of res) {
                            var tr = document.createElement('tr')
                            tr.innerHTML += `<td style="text-align: center">${num}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['name_filial']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['reg_num_opo']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['opo_name']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['jan']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['feb']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['mar']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['apr']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['may']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['jun']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['jul']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['aug']}</td>`

                            tr.innerHTML += `<td style="text-align: center">${row['sep']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['oct']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['nov']}</td>`

                            tr.innerHTML += `<td style="text-align: center">${row['dec']}</td>`

                            tr.innerHTML += ` @can('report-edit')<td style="text-align: center"><a href="#" onclick="edit_record(${row['id']})">
                                                                            <img alt=""
                                                                                 src="{{asset('assets/images/icons/edit.svg')}}" class="check_i">
                                                                        </a>
                                                                        <a href="#" onclick="remove_record(${row['id']})">
                                                                            <img alt=""
                                                                                 src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i">
                                                                        </a></td> @endcan`
                            table_body.appendChild(tr)
num+=1
                        }
                    },
                    error: function (error) {
                        var table_body = document.getElementById('body_table')
                        table_body.innerText = ''
                    },

                })
            }

            //скрипт для удаления
            function remove_record(id) {
                $.ajax({
                    url: '/docs/pat_schedule/remove/' + id,
                    type: 'GET',
                    success: (res) => {
                        window.location.href = '/docs/pat_schedule'
                    }
                })
            }

            //скрипт для изменения
            function edit_record(id) {
                window.location.href = '/docs/pat_schedule/edit/' + id
            }


            //скрипт для поиска
            var input = document.getElementById('search_text')
            input.oninput = function () {
                setTimeout(find_it, 100);
            };

            function find_it() {
                var table_boby_rows = document.getElementById('table_for_search').getElementsByTagName('tbody')[0].getElementsByTagName('tr')  //строки по которым ищем
                var search_text = new RegExp(document.getElementById('search_text').value, 'i');   //искомый текст
                for (var i = 0; i < table_boby_rows.length; i++) {  //проходимся по строкам
                    var flag_success = false   //станет true, если есть совпадение в строке
                    var tds_row = table_boby_rows[i].getElementsByTagName('td')   //ячейки строки
                    for (var j = 0; j < tds_row.length; j++) {   //проходимся по ячейкам
                        if (tds_row[j].textContent.match(search_text)) {
                            flag_success = true
                        }
                    }
                    if (flag_success) {
                        table_boby_rows[i].style.display = ""
                    } else {
                        table_boby_rows[i].style.display = "none"
                    }
                }
            }
        </script>



@endsection
