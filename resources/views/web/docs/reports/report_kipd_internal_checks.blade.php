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

        @can('report-edit')
        #table_for_search tr td:last-of-type {
            /*display: flex;*/
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 15px 0;
        }

        .form51 table tr th {
            padding: 2px 3px
        }

        .form51 table tr td {
            padding: 2px 3px
        }

        @endcan
        input[type="checkbox"] {
            position: relative;
            width: 30px;
            height: 15px;
            -webkit-appearance: none;
            background: #c6c6c6;
            outline: none;
            border-radius: 15px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, .2);
            transition: .5s
        }

        input:checked[type="checkbox"] {
            background: #4bd562;
        }

        input[type="checkbox"]::before {
            content: '';
            position: absolute;
            width: 15px;
            height: 15px;
            border-radius: 20px;
            top: 0;
            left: 0;
            background: #fff;
            transform: scale(1.1);
            box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
        }

        input:checked[type="checkbox"]::before {
            left: 15px
        }

        td {
            text-align: center;
        }

        table {
            -webkit-print-color-adjust: exact; /* благодаря этому заработал цвет*/
            white-space: -moz-pre-wrap; /* Mozilla, начиная с 1999 года */
            white-space: -pre-wrap; /* Opera 4-6 */
            white-space: -o-pre-wrap; /* Opera 7 */
            word-wrap: break-word;
            word-break: break-word;
        }
    </style>
    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline-block; margin-right: 10px">
                            План корректирующих
                            действий ПБ по внутренним проверкам за </h2>
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
                                        <div class="bat_info excel" style="display: inline-block"><a
                                                href="/excel_kipd_internal_checks/"
                                                style="display: inline-block">Экспорт в excel</a>
                                        </div>
                                        <div class="bat_info pdf" style="display: inline-block; margin-left: 0px"><a
                                                href="/pdf_kipd_internal_checks/"
                                                style="display: inline-block">Печать в pdf</a>
                                        </div>
                                    @endcan
                                    @can('entries-add')
                                        <div class="bat_add" style="margin-left: 0; display: inline-block"><a
                                                href="/docs/kipd_internal_checks/create" style="display: inline-block">Добавить
                                                запись</a>
                                        </div>
                                    @endcan
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:72.5vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px; width: 250%" class="form51">
                            <table id="table_for_search" style="display: table; table-layout: fixed; width: 100%">
                                @can('report-edit')
                                    <colgroup>
                                        <col style="width: 3%">
                                        <col style="width: 6%">
                                        <col style="width: 5%">
                                        <col style="width: 5%">
                                        <col style="width: 11%">
                                        <col style="width: 11%">
                                        <col style="width: 10%">
                                        <col style="width: 11%">
                                        <col style="width: 5%">
                                        <col style="width: 10%">
                                        <col style="width: 10%">
                                        <col style="width: 10%">
                                        <col style="width: 10%">
                                        <col style="width: 5%">
                                        <col style="width: 4%">
                                        <col style="width: 3%">
                                        <col style="width: 3%">
                                    </colgroup>
                                @endcan
                                <thead>
                                <tr>
                                <tr>
                                    <th rowspan="2">№</th>
                                    <th rowspan="2">Наименование<br> филиала ДО</th>
                                    <th rowspan="2">Подразделение</th>
                                    <th rowspan="2">Дата акта</th>
                                    <th rowspan="2">Номер акта</th>
                                    <th rowspan="2">Описание несоответствия</th>
                                    <th colspan="3">Мероприятия по устранению несоответствия</th>
                                    <th colspan="5">Корректирующие действия</th>
                                    <th rowspan="2">Индикативный <br>показатель</th>
                                    <th rowspan="2"></th>
                                    @can('report-edit')
                                        <th rowspan="2"></th>
                                    @endcan
                                </tr>
                                <tr>
                                    <th>Наименование мероприятия</th>
                                    <th>Ответственный исполнитель</th>
                                    <th>Срок выполнения</th>
                                    <th>Причины появления несоответствия</th>
                                    <th>Корректирующее действие</th>
                                    <th>Требуемые условия и ресурсы</th>
                                    <th>Ответственный исполнитель</th>
                                    <th>Дата выполнения</th>
                                </tr>
                                </thead>
                                <tbody id="body_table" style="">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var date = new Date();
            document.getElementById('select__year').value = date.getFullYear();
            get_data()
        })

        function get_data() {
            @can('doc-create')
            let pdf = document.querySelector('.pdf');
            pdf.firstChild.href = '/pdf_kipd_internal_checks/' + document.getElementById('select__year').value;
            let excel = document.querySelector('.excel');
            excel.firstChild.href = '/excel_kipd_internal_checks/' + document.getElementById('select__year').value;
            @endcan
            var table_body = document.getElementById('body_table')
            table_body.innerText = ''
            $.ajax({
                url: '/docs/get_kipd_internal_checks/' + document.getElementById('select__year').value,
                type: 'GET',
                success: (res) => {
                    var num = 1;
                    for (var row of res) {
                        var tr = document.createElement('tr')
                        tr.innerHTML += `<td style="text-align: center">${num}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['name_do']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['podrazdelenie']}</td>`
                        if (row['date_act']) {
                            let date = new Date(row['date_act']);
                            let dd = date.getDate();
                            if (dd < 10) dd = '0' + dd;
                            let mm = date.getMonth() + 1;
                            if (mm < 10) mm = '0' + mm;
                            let yyyy = date.getFullYear();
                            tr.innerHTML += `<td style="text-align: center;">${dd}.${mm}.${yyyy}</td>`
                        } else {
                            tr.innerHTML += `<td style="text-align: center"></td>`
                        }
                        tr.innerHTML += `<td style="text-align: center">${row['num_act']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['error_comment']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['name_event']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['person']}</td>`
                        if (row['date_check']) {
                            let date = new Date(row['date_check']);
                            let dd = date.getDate();
                            if (dd < 10) dd = '0' + dd;
                            let mm = date.getMonth() + 1;
                            if (mm < 10) mm = '0' + mm;
                            let yyyy = date.getFullYear();
                            tr.innerHTML += `<td style="text-align: center;">${dd}.${mm}.${yyyy}</td>`
                        } else {
                            tr.innerHTML += `<td style="text-align: center"></td>`
                        }

                        tr.innerHTML += `<td style="text-align: center">${row['reason']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['correct_event']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['usloviya']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['person_correct']}</td>`
                        if (row['date_check_correct']) {
                            let date = new Date(row['date_check_correct']);
                            let dd = date.getDate();
                            if (dd < 10) dd = '0' + dd;
                            let mm = date.getMonth() + 1;
                            if (mm < 10) mm = '0' + mm;
                            let yyyy = date.getFullYear();
                            tr.innerHTML += `<td style="text-align: center;">${dd}.${mm}.${yyyy}</td>`
                        } else {
                            tr.innerHTML += `<td style="text-align: center"></td>`
                        }
                        tr.innerHTML += `<td style="text-align: center">${row['indicator']}</td>`
                        if (row['in_use']) {
                            tr.innerHTML += `<td style="text-align: center"><input type="checkbox" onclick="unchecked(${row['id']})" checked></td>`
                        } else {
                            tr.innerHTML += `<td style="text-align: center"><input type="checkbox" onclick="unchecked(${row['id']})"></td>`
                        }
                        tr.innerHTML += ` @can('report-edit') <td style="text-align: center; min-width: auto">
                    <a href="#" onclick="edit_record(${row['id']})"><img style="width: 15px; height: 15px"  alt="" src="{{asset('assets/images/icons/edit.svg')}}" class="check_i"></a>
                    <a href="#" style="" onclick="remove_record(${row['id']})"><img style="opacity:1; width: 15px; height: 15px; margin-left: 4px"  alt="" src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i"></a>
                    </td> @endcan `
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
                url: '/docs/kipd_internal_checks/remove/' + id,
                type: 'GET',
                success: (res) => {
                    window.location.href = '/docs/kipd_internal_checks'
                }
            })
        }

        //скрипт, чтоб не учитывать
        function unchecked(id) {
            $.ajax({
                url: '/docs/kipd_internal_checks/checked/' + id,
                type: 'GET',
                success: (res) => {
                }
            })
        }

        //скрипт для изменения
        function edit_record(id) {
            window.location.href = '/docs/kipd_internal_checks/edit/' + id
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
