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
            padding-left: 7px;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        @endcan
    </style>
    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline-block; margin-right: 10px">
                            Сведения о
                            противоаварийных тренировках, проведенных на
                            ОПО в </h2>
                        <input style="width: 5%; display: inline-block; margin-right: 10px" type="number"
                               id="select__year" class="text-field__input" min="1970" max="2030"
                               onblur="get_data()"></input>
                        <h2 class="text-muted" style="text-align: center; display: inline;">году</h2>
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
                                        <div class="bat_info" style="display: inline-block"><a
                                                href="#"
                                                onclick="window.location.href = '/excel_emergency_drills/' + document.getElementById('select__year').value"
                                                style="display: inline-block">Экспорт в excel</a>
                                        </div>
                                        <div class="bat_info" style="display: inline-block; margin-left: 0px"><a
                                                href="#"
                                                onclick="window.location.href = '/pdf_emergency_drills/' + document.getElementById('select__year').value"
                                                style="display: inline-block">Печать в pdf</a>
                                        </div>
                                    @endcan
                                    @can('entries-add')
                                        <div class="bat_add" style="margin-left: 0; display: inline-block"><a
                                                href="/docs/emergency_drills/create" style="display: inline-block">Добавить
                                                запись</a>
                                        </div>
                                    @endcan
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:73.5vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px; width: 150%" class="form51">
                            <table id="table_for_search" style="display: table">
                                @can('report-edit')
                                    <colgroup>
                                        <col style="width: 5%">
                                        <col style="width: 10%">
                                        <col style="width: 5%">
                                        <col style="width: 5%">
                                        <col style="width: 5%">
                                        <col style="width: 10%">
                                        <col style="width: 10%">
                                        <col style="width: 5%">
                                        <col style="width: 10%">
                                        <col style="width: 10%">
                                        <col style="width: 10%">
                                        <col style="width: 10%">
                                        <col style="width: 3%">
                                    </colgroup>
                                @endcan
                                <thead>
                                <tr>
                                    <th rowspan="2" style="text-align: center; padding: 10px 7px">№ п/п</th>
                                    <th rowspan="2" style="text-align: center">Наименование филиала ДО</th>
                                    <th colspan="3" style="text-align: center">Количество ПАТ</th>
                                    <th rowspan="2" style="text-align: center">Наименование ПАТ
                                    </th>
                                    <th rowspan="2" style="text-align: center">Наименование, рег. № ОПО</th>
                                    <th rowspan="2" style="text-align: center">Дата ПАТ</th>
                                    <th rowspan="2" style="text-align: center">№ и дата протокола проведения ПАТ</th>
                                    <th rowspan="2" style="text-align: center">Основание проведения ПАТ
                                    </th>
                                    <th rowspan="2" style="text-align: center">Оценка</th>
                                    <th rowspan="2" style="text-align: center">Индикативный показатель</th>
                                    @can('report-edit')
                                        <th rowspan="2"></th>
                                    @endcan
                                </tr>
                                <tr>
                                    <th style="text-align: center">План на год</th>
                                    <th style="text-align: center">План тек.</th>
                                    <th style="text-align: center">Факт</th>
                                </tr>
                                </thead>
                                <tbody id="body_table">
                                <tr>
                                    <td colspan="12" style="font-size: 24px">Нет данных</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //скрипт для удаления
        function remove_record(id) {
            $.ajax({
                url: '/docs/emergency_drills/remove/' + id,
                type: 'GET',
                success: (res) => {
                    window.location.href = '/docs/emergency_drills'
                }
            })
        }

        //скрипт для изменения
        function edit_record(id) {
            window.location.href = '/docs/emergency_drills/edit/' + id
        }


        ///скрипт для поиска
        var input = document.getElementById('search_text')
        input.oninput = function () {
            setTimeout(find_it, 100);
        };

        function find_it() {
            var table_boby_rows = document.getElementById('table_for_search').getElementsByTagName('tbody')[0].getElementsByTagName('tr')  //строки по которым ищем
            if (document.getElementById('search_text').value) {
                var search_text = new RegExp(document.getElementById('search_text').value, 'i');   //искомый текст
                for (var i = 0; i < table_boby_rows.length; i++) {  //проходимся по строкам
                    var flag_success = false   //станет true, если есть совпадение в строке
                    var tds_row = table_boby_rows[i].getElementsByTagName('td')   //ячейки строки
                    for (var j = 0; j < tds_row.length; j++) {   //проходимся по ячейкам
                        if (tds_row[j].textContent.match(search_text)) {
                            flag_success = true
                            tds_row[j].firstChild.style.background = 'yellow';
                        } else {
                            if (tds_row[j].getElementsByTagName('p').length) {
                                tds_row[j].firstChild.style.background = 'none';
                            }
                        }
                    }

                }
            } else {
                for (var i = 0; i < table_boby_rows.length; i++) {  //проходимся по строкам
                    tds_row = table_boby_rows[i].getElementsByTagName('td')   //ячейки строки
                    for (var j = 0; j < tds_row.length; j++) {   //проходимся по ячейка
                        if (tds_row[j].getElementsByTagName('p').length) {
                            tds_row[j].firstChild.style.background = 'none';
                        }
                    }
                }
            }
        }

        //скрипт для селекта с выбором года
        document.addEventListener('DOMContentLoaded', function () {
            var date = new Date();
            document.getElementById('select__year').value = date.getFullYear();
            get_data()
        })

        function get_data() {
            var table_body = document.getElementById('body_table')
            table_body.innerText = ''
            $.ajax({
                url: '/docs/emergency_drills/get_params/' + document.getElementById('select__year').value,
                type: 'GET',
                success: (res) => {
                    var num = 1
                    var keys = Object.keys(res)
                    for (var key of keys) {
                        var i = 1
                        for (var row of res[key]) {
                            var tr = document.createElement('tr')
                            tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${num}</p></td>`
                            if (i == 1) {
                                console.log(res)
                                tr.innerHTML += `<td rowspan="${res[key].length}" style="text-align: center"><p style="margin: 0; display: inline; ">${key}</p></td>`
                            }
                            tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['plan_PAT']}</p></td>`
                            tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['plan_month_PAT']}</p></td>`
                            tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['fact_PAT']}</p></td>`
                            tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['workout_theme']}</p></td>`
                            tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['name_reg_№_OPO']}</p></td>`
                            if (row['date_PAT']) {
                                let date = new Date(row['date_PAT']);
                                let dd = date.getDate();
                                if (dd < 10) dd = '0' + dd;
                                let mm = date.getMonth() + 1;
                                if (mm < 10) mm = '0' + mm;
                                let yyyy = date.getFullYear();
                                tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${dd}.${mm}.${yyyy}</p></td>`
                            } else {
                                tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; "></p></td>`

                            }
                            tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['№_date_protocol_PAT']}</p></td>`
                            tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['basis_PAT']}</p></td>`
                            if (row['grade']) {
                                tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">Удов.</p></td>`
                            } else {
                                tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">Не удов.</p></td>`
                            }
                            tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['indicative_indicator']}</td>`
                            tr.innerHTML += ` @can('report-edit') <td style="text-align: center; min-width: auto">
                    <a href="#" onclick="edit_record(${row['id']})"><img style="width: 15px; height: 15px; margin: 3px"  alt="" src="{{asset('assets/images/icons/edit.svg')}}" class="check_i"></a>
                    <a href="#" style="" onclick="remove_record(${row['id']})"><img style="opacity:1; width: 15px; height: 15px; margin: 3px; margin-left: 4px"  alt="" src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i"></a>
                    </td> @endcan`
                            table_body.appendChild(tr)
                            num += 1
                            i++
                        }
                    }
                },
                error: function (error) {
                    var table_body = document.getElementById('body_table')
                    table_body.innerText = ''
                },

            })
        }
    </script>

@endsection
