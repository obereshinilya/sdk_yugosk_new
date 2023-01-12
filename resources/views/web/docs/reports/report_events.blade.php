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
        table {
            -webkit-print-color-adjust: exact; /* благодаря этому заработал цвет*/
            white-space: -moz-pre-wrap; /* Mozilla, начиная с 1999 года */
            white-space: -pre-wrap; /* Opera 4-6 */
            white-space: -o-pre-wrap; /* Opera 7 */
            /*word-wrap: break-word;*/
            /*/ word-break: break-all;*/
        }
    </style>
    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline; margin-right: 20px;">
                            Отчет
                            о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных
                            Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром» за
                        </h2>
                        <select class="select-css" id="select__year" onchange="get_data()"
                                style="width: 11%; display: inline-block ; margin-left: 2%">
                            @for($i=2015; $i<=2023; $i++)
                                <option value="{{$i}}">{{$i}} год</option>
                            @endfor
                        </select>
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
                                                    href="/excel_report_events"
                                                    style="display: inline-block">Экспорт в excel</a>
                                            </div>
                                            <div class="bat_info pdf" style="display: inline-block; margin-left: 0px"><a
                                                    href="/pdf_report_events"
                                                    style="display: inline-block">Печать в pdf</a>
                                            </div>
                                        @endcan
                                        @can('entries-add')
                                            <div class="bat_add" style="margin-left: 0; display: inline-block"><a
                                                    href="/docs/report_events/create" style="display: inline-block">Добавить
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
                            <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                                <table id="table_for_search" style="display: table; table-layout: fixed; width: 100%">
                                    @can('report-edit')
                                        <colgroup>
                                            <col style="width: 5%">
                                            <col style="width: 10%">
                                            <col style="width: 10%">
                                            <col style="width: 10%">
                                            <col style="width: 10%">
                                            <col style="width: 10%">
                                            <col style="width: 10%">
                                            <col style="width: 20%">
                                            <col style="width: 10%">
                                            <col style="width: 5%">
                                        </colgroup>
                                    @endcan
                                    <thead>
                                    <tr>
                                        <th style="text-align: center" rowspan="2">№ п/п</th>
                                        <th style="text-align: center" rowspan="2">Наименование филиала/ дочернего
                                            общества
                                        </th>
                                        <th style="text-align: center" rowspan="2">Количество устранённых нарушений за
                                            отчётный период, ед.
                                        </th>
                                        <th style="text-align: center" rowspan="2">Количество не устранённых нарушений с
                                            истекшим сроком устранения, ед.
                                        </th>
                                        <th style="text-align: center" rowspan="2">Количество нарушений с не истекшим
                                            сроком устранения, ед.
                                        </th>
                                        <th style="text-align: center" colspan="2">Из них</th>
                                        <th style="text-align: center" rowspan="2">Примечание</th>
                                        <th style="text-align: center" rowspan="2">Дата записи</th>
                                        @can('report-edit')
                                            <th rowspan="2"></th>
                                        @endcan
                                    </tr>
                                    <tr>
                                        <th style="text-align: center">со сроком, установленным по Акту, ед.</th>
                                        <th style="text-align: center">с переносом срока устранения, ед.</th>
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
                    url: '/docs/report_events/remove/' + id,
                    type: 'GET',
                    success: (res) => {
                        window.location.href = '/docs/report_events'
                    }
                })
            }

            //скрипт для изменения
            function edit_record(id) {
                window.location.href = '/docs/report_events/edit/' + id
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
                @can('doc-create')
                let pdf = document.querySelector('.pdf');
                pdf.firstChild.href = '/pdf_report_events/' + document.getElementById('select__year').value;
                let excel = document.querySelector('.excel');
                excel.firstChild.href = '/excel_report_events/' + document.getElementById('select__year').value;
                @endcan
                var table_body = document.getElementById('body_table')
                table_body.innerText = ''
                $.ajax({
                    url: '/docs/report_events/get_params/' + document.getElementById('select__year').value,
                    type: 'GET',
                    success: (res) => {
                        //console.log(res)
                        var num = 1
                        var keys = Object.keys(res)
                        for (var key of keys) {
                            var i = 1
                            for (var row of res[key]) {
                                var tr = document.createElement('tr')
                                tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${num}</p></td>`
                                if (i == 1) {
                                    tr.innerHTML += `<td rowspan="${res[key].length}" style="text-align: center"><p style="margin: 0; display: inline; ">${row['name_do']}</p></td>`
                                }
                                tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['num_elim']}</p></td>`
                                tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['num_unrem']}</p></td>`
                                tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['num_unexp_deadlines']}</p></td>`
                                tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['num_act']}</p></td>`
                                tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['num_repiat']}</p></td>`
                                if (row['note']) {
                                    tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['note']}</p></td>`
                                } else {
                                    tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; "></p></td>`
                                }
                                let date = new Date(row['date_update']);
                                let dd = date.getDate();
                                if (dd < 10) dd = '0' + dd;
                                let mm = date.getMonth() + 1;
                                if (mm < 10) mm = '0' + mm;
                                let yyyy = date.getFullYear();


                                tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${dd}.${mm}.${yyyy}</p></td>`

                                tr.innerHTML += ` @can('report-edit') <td style="text-align: center; min-width: auto">
                    <a href="#" onclick="edit_record(${row['id']})"><img style="width: 15px; height: 15px; margin: 3px"  alt="" src="{{asset('assets/images/icons/edit.svg')}}" class="check_i"></a>
                    <a href="#" style="" onclick="remove_record(${row['id']})"><img style="opacity:1; width: 15px; height: 15px; margin: 3px; margin-left: 4px"  alt="" src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i"></a>
                    </td> @endcan`
                                table_body.appendChild(tr)
                                i++
                                num += 1
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
