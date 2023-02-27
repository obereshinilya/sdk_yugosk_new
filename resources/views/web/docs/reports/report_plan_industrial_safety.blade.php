@extends('web.layouts.app')
@section('title')
    Отчеты
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
            padding: 15px 0;
        }
        @endcan
    </style>

    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline-block; margin-right: 10px">
                            Сведения о выполнении
                            плана работ в области
                            промышленной
                            безопасности за
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
                                              action="{{ route('excel_plan_industrial') }}">
                                            @csrf
                                            <div id="excel_form">
                                            </div>
                                            <button type="submit" id="excel_button" class="btn btn-primary">
                                                Сохранить
                                            </button>
                                        </form>
                                        <div class="bat_info" style="display: inline-block"><a
                                                href="#"
                                                onclick="print_data('excel')"
                                                style="display: inline-block">Экспорт в excel</a>
                                        </div>
                                        <form method="POST" style="display: none"
                                              action="{{ route('pdf_plan_industrial') }}">
                                            @csrf
                                            <div id="pdf_form">
                                            </div>
                                            <button type="submit" id="pdf_button" class="btn btn-primary">
                                                Сохранить
                                            </button>
                                        </form>
                                        <div class="bat_info" style="display: inline-block; margin-left: 0px"><a
                                                href="#"
                                                onclick="print_data('pdf')" style="display: inline-block">Печать в
                                                pdf</a>
                                        </div>
                                    @endcan
                                    @can('entries-add')
                                        <div class="bat_add" style="display: inline-block; margin-left: 0"><a
                                                href="/docs/plan_industrial_safety/create">Добавить запись</a></div>
                                    @endcan
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:72.5vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table id="table_for_search" style="display: table; table-layout: fixed; width: 100%">
                                @can('report-edit')
                                    <colgroup>
                                        <col style="width: 17%">
                                        <col style="width: 15%">
                                        <col style="width: 12%">
                                        <col style="width: 13%">
                                        <col style="width: 8%">
                                        <col style="width: 14%">
                                        <col style="width: 8%">
                                        <col style="width: 8%">
                                        <col style="width: 5%">
                                    </colgroup>
                                @endcan
                                <thead>
                                <tr>
                                    <th style="text-align: center;" class="filter short_name_do plan_industrial">
                                        Наименование филиала ДО
                                    </th>
                                    <th style="text-align: center;" class="filter goals_OT_PB plan_industrial">Цели в
                                        области ОТ и ПБ
                                    </th>
                                    <th style="text-align: center;" class="filter name_risk plan_industrial">
                                        Наименование риска
                                    </th>
                                    <th style="text-align: center;" class="filter events plan_industrial">Мероприятие
                                    </th>
                                    <th style="text-align: center;" class="filter period_execution plan_industrial">Срок
                                        исполнения
                                    </th>
                                    <th style="text-align: center;" class="filter responsible plan_industrial">
                                        Ответственный исполнитель (Ф.И.О., должность)
                                    </th>
                                    <th style="text-align: center;" class="filter completion_mark plan_industrial">
                                        Отметка о выполнении
                                    </th>
                                    <th style="text-align: center;" class="filter indicative_indicat plan_industrial">
                                        Индикативный показатель
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

            // console.log(document.getElementById('select__year').value)
            data['year'] = document.getElementById('select__year').value


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/docs/get_plan_industrial_safety',
                type: 'POST',
                data: data,
                success: (res) => {
                    for (var row of res) {
                        var tr = document.createElement('tr')
                        tr.innerHTML += `<td style="text-align: center">${row['short_name_do']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['goals_OT_PB']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['name_risk']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['events']}</td>`
                        if (row['period_execution']) {
                            let date = new Date(row['period_execution']);
                            let dd = date.getDate();
                            if (dd < 10) dd = '0' + dd;
                            let mm = date.getMonth() + 1;
                            if (mm < 10) mm = '0' + mm;
                            let yyyy = date.getFullYear();
                            tr.innerHTML += `<td style="text-align: center;">${dd}.${mm}.${yyyy}</td>`
                        } else {
                            tr.innerHTML += `<td style="text-align: center;"></td>`

                        }
                        tr.innerHTML += `<td style="text-align: center">${row['responsible']}</td>`
                        if (row['completion_mark']) {
                            tr.innerHTML += `<td style="text-align: center">Выполнено</td>`
                        } else {
                            tr.innerHTML += `<td style="text-align: center">Не выполнено</td>`
                        }
                        tr.innerHTML += `<td style="text-align: center">${row['indicative_indicat']}</td>`
                        tr.innerHTML += ` @can('report-edit') <td style="text-align: center"><a href="#" onclick="edit_record(${row['id']})">
                                                                            <img style="margin-left: 8px" alt=""
                                                                                 src="{{asset('assets/images/icons/edit.svg')}}" class="check_i">
                                                                        </a>
                                                                        <a href="#" onclick="remove_record(${row['id']})">
                                                                            <img style="margin-left: 5px" alt=""
                                                                                 src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i">
                                                                        </a></td> @endcan`
                        table_body.appendChild(tr)
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
                url: '/docs/plan_industrial_safety/remove/' + id,
                type: 'GET',
                success: (res) => {
                    window.location.href = '/docs/plan_industrial_safety'
                }
            })
        }

        //скрипт для изменения
        function edit_record(id) {
            window.location.href = '/docs/plan_industrial_safety/edit/' + id
        }


        ///скрипт для поиска
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
