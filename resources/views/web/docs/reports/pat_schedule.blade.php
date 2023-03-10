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
        th, td {
            word-break: break-word;
        }


        .form51 table tr th {
            padding: 2px 3px
        }

        .form51 table tr td {
            padding: 2px 3px
        }

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
                        <h2 class="text-muted" style="text-align: center; display: inline; margin-right: 10px">График
                            комплексных противоаварийных тренировок I - II уровня на опасных производственных объектах
                            ООО «Газпром трансгаз Югорск» на
                        </h2>
                        <input style="width: 5%; display: inline-block; margin-right: 10px" type="number"
                               id="select__year" class="text-field__input" min="1970" max="2030"
                               onblur="get_data()"></input>
                        <h2 class="text-muted" style="text-align: center; display: inline;">год</h2>
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
                                        <form method="POST" style="display: none"
                                              action="{{ route('excel_pat_schedule') }}">
                                            @csrf
                                            <div id="excel_form">
                                            </div>
                                            <button type="submit" id="excel_button" class="btn btn-primary">
                                                Сохранить
                                            </button>
                                        </form>
                                        <div class="bat_info excel" style="display: inline-block; margin-left: 0px"><a
                                                href="#" onclick="print_data('excel')"
                                                style="display: inline-block">Экспорт в excel</a>
                                        </div>
                                        <form method="POST" style="display: none"
                                              action="{{ route('pdf_pat_schedule') }}">
                                            @csrf
                                            <div id="pdf_form">
                                            </div>
                                            <button type="submit" id="pdf_button" class="btn btn-primary">
                                                Сохранить
                                            </button>
                                        </form>
                                        <div class="bat_info pdf" style="display: inline-block; margin-left: 0px"><a
                                                href="#" onclick="print_data('pdf')"
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
                                    <th style="text-align: center; width:8%; padding: 10px 2px"
                                        class="filter short_name_do pat_schedule">Наименование филиала
                                    </th>
                                    <th style="text-align: center; width:8%;padding: 10px 2px"
                                        class="filter reg_num_opo pat_schedule">Рег. № ОПО
                                    </th>
                                    <th style="text-align: center; width:8%;padding: 10px 2px"
                                        class="filter full_name_opo pat_schedule">Наименование ОПО
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px" class="filter jan pat_schedule">
                                        Январь, <br>№ темы
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px" class="filter feb pat_schedule">
                                        Февраль, <br>№ темы
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px" class="filter mar pat_schedule">
                                        Март, <br>№ темы
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px" class="filter apr pat_schedule">
                                        Апрель, <br>№ темы
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px" class="filter may pat_schedule">
                                        Май, <br>№ темы
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px" class="filter jun pat_schedule">
                                        Июнь, <br>№ темы
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px" class="filter jul pat_schedule">
                                        Июль, <br>№ темы
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px" class="filter aug pat_schedule">
                                        Август, <br>№ темы
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px" class="filter sep pat_schedule">
                                        Сентябрь, <br>№ темы
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px" class="filter oct pat_schedule">
                                        Октябрь, <br>№ темы
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px" class="filter nov pat_schedule">
                                        Ноябрь, <br>№ темы
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px" class="filter dec pat_schedule">
                                        Декабрь, <br>№ темы
                                    </th>
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
        @include('web.include.filters_js')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var date = new Date();
                document.getElementById('select__year').value = date.getFullYear()
                get_data()
            })

            function get_data() {
                var table_body = document.getElementById('body_table')
                table_body.innerText = ''
                var fieldsheets = document.getElementsByTagName('fieldset')
                var data = {}
                for (var fieldsheet of fieldsheets) {
                    var check_input_all = fieldsheet.getElementsByTagName('input')
                    var check_input = []
                    var all_input_checked = true

                    for (var one_input of check_input_all) {
                        if (one_input.hasAttribute('checked')) {
                            check_input.push(one_input.getAttribute('name'))
                        } else {
                            all_input_checked = false
                        }
                    }
                    console.log(check_input.join(','))
                    data[fieldsheet.id.replace('fieldsheet_', '')] = check_input.join('!!')
                }
                data['year'] = document.getElementById('select__year').value
                console.log(data)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/docs/pat_schedule/get_params',
                    type: 'POST',
                    data: data,
                    success: (res) => {
                        var num = 1
                        for (var row of res) {
                            var tr = document.createElement('tr')
                            tr.innerHTML += `<td style="text-align: center">${num}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['short_name_do']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['reg_num_opo']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['full_name_opo']}</td>`
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
                            num += 1
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
