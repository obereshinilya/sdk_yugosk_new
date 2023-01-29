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
            word-wrap: break-word;
        / word-break: break-all;
        }
    </style>
    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline-block; margin-right: 10px">
                            Реестр актуальных
                            деклараций промышленной
                            безопасности
                            опасных производственных объектов
                        </h2>
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
                                                href="/excel_actual_declarations"
                                                style="display: inline-block">Экспорт в excel</a>
                                        </div>
                                        <div class="bat_info pdf" style="display: inline-block; margin-left: 0px"><a
                                                href="/pdf_actual_declarations"
                                                style="display: inline-block">Печать в pdf</a>
                                        </div>
                                    @endcan
                                    @can('entries-add')
                                        <div class="bat_add" style="margin-left: 0; display: inline-block"><a
                                                href="/docs/actual_declarations/create" style="display: inline-block">Добавить
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
                                        <col style="width: 12%">
                                        <col style="width: 15%">
                                        <col style="width: 17%">
                                        <col style="width: 15%">
                                        <col style="width: 15%">
                                        <col style="width: 15%">
                                        <col style="width: 6%">
                                    </colgroup>
                                @endcan
                                <thead>
                                <tr>
                                    <th style="text-align: center">№ п/п</th>
                                    <th style="text-align: center">Наименование ДПБ</th>
                                    <th style="text-align: center">Составные части ДПБ</th>
                                    <th style="text-align: center">Введена в действие уведомлением Ростехнадзора рег. №,
                                        дата
                                    </th>
                                    <th style="text-align: center">Рег. № ДПБ в Ростехнадзоре</th>
                                    <th style="text-align: center">Наименование ЗЭПБ</th>
                                    <th style="text-align: center">Рег.№ ЗЭПБ в Ростехнадзоре,
                                        дата
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            get_data()
        })

        function get_data() {
            @can('doc-create')
            let pdf = document.querySelector('.bat_info');
            pdf.firstChild.href = '/pdf_actual_declarations';
            let excel = document.querySelector('.bat_info');
            excel.firstChild.href = '/excel_actual_declarations';
            @endcan
            var table_body = document.getElementById('body_table')
            table_body.innerText = ''
            $.ajax({
                url: '/docs/actual_declarations/get_params',
                type: 'GET',
                success: (res) => {
                    var num = 1
                    for (var row of res) {
                        var tr = document.createElement('tr')
                        tr.innerHTML += `<td style="text-align: center">${num}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['name_DPB']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['parts_DPB']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['massage_rtn']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['reg_num_dpb']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['name_zepb']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['reg_num_date_zepb']}</td>`
                        tr.innerHTML += ` @can('report-edit') <td style="text-align: center"><a href="#" onclick="edit_record(${row['id']})">
                                                                            <img style="margin-left: 8px" alt=""
                                                                                 src="{{asset('assets/images/icons/edit.svg')}}" class="check_i">
                                                                        </a>
                                                                        <a href="#" onclick="remove_record(${row['id']})">
                                                                            <img style="margin-left: 5px" alt=""
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
                url: '/docs/actual_declarations/remove/' + id,
                type: 'GET',
                success: (res) => {
                    window.location.href = '/docs/actual_declarations'
                }
            })
        }

        //скрипт для изменения
        function edit_record(id) {
            window.location.href = '/docs/actual_declarations/edit/' + id
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
