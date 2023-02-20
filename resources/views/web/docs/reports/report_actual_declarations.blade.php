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
                                        <form method="POST" style="display: none"
                                              action="{{ route('excel_actual') }}">
                                            @csrf
                                            <div id="excel_form">
                                            </div>
                                            <button type="submit" id="excel_button" class="btn btn-primary">
                                                Сохранить
                                            </button>
                                        </form>
                                        <div class="bat_info excel" style="display: inline-block"><a
                                                href="#" onclick="print_data('excel')"
                                                style="display: inline-block">Экспорт в excel</a>
                                        </div>
                                        <form method="POST" style="display: none"
                                              action="{{ route('pdf_actual') }}">
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
                                    <th style="text-align: center" class="filter name_DPB actual_declarations">
                                        Наименование ДПБ
                                    </th>
                                    <th style="text-align: center" class="filter parts_DPB actual_declarations">
                                        Составные части ДПБ
                                    </th>
                                    <th style="text-align: center" class="filter massage_rtn actual_declarations">
                                        Введена в действие уведомлением Ростехнадзора рег. №,
                                        дата
                                    </th>
                                    <th style="text-align: center" class="filter reg_num_dpb actual_declarations">Рег. №
                                        ДПБ в Ростехнадзоре
                                    </th>
                                    <th style="text-align: center" class="filter name_zepb actual_declarations">
                                        Наименование ЗЭПБ
                                    </th>
                                    <th style="text-align: center" class="filter reg_num_date_zepb actual_declarations">
                                        Рег.№ ЗЭПБ в Ростехнадзоре,
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
    @include('web.include.filters_js')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            get_data()
        })

        function get_data() {
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
            console.log(data)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/docs/actual_declarations/get_params',
                method: 'POST',
                data: data,
                success(res) {
                    let tbody = document.getElementById('table_for_search').getElementsByTagName('tbody')[0];
                    tbody.innerHTML = '';
                    console.log(res)
                    let num = 1
                    for (var row of res) {
                        var tr = document.createElement('tr')
                        tr.innerHTML += `<td style="text-align: center">${num}</td>`
                        tr.innerHTML += `<td style="text-align: center" class="filter name_DPB actual_declarations">${row['name_DPB']}</td>`
                        tr.innerHTML += `<td style="text-align: center" class="filter parts_DPB actual_declarations">${row['parts_DPB']}</td>`
                        tr.innerHTML += `<td style="text-align: center" class="filter massage_rtn actual_declarations">${row['massage_rtn']}</td>`
                        tr.innerHTML += `<td style="text-align: center" class="filter reg_num_dpb actual_declarations">${row['reg_num_dpb']}</td>`
                        tr.innerHTML += `<td style="text-align: center" class="filter name_zepb actual_declarations">${row['name_zepb']}</td>`
                        tr.innerHTML += `<td style="text-align: center" class="filter reg_num_date_zepb actual_declarations">${row['reg_num_date_zepb']}</td>`
                        tr.innerHTML += ` @can('report-edit') <td style="text-align: center"><a href="#" onclick="edit_record(${row['id']})">
                                                                            <img style="margin-left: 8px" alt=""
                                                                                 src="{{asset('assets/images/icons/edit.svg')}}" class="check_i">
                                                                        </a>
                                                                        <a href="#" onclick="remove_record(${row['id']})">
                                                                            <img style="margin-left: 5px" alt=""
                                                                                 src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i">
                                                                        </a></td> @endcan`
                        tbody.appendChild(tr)
                        num += 1
                    }



                    {{--var table_body = document.getElementById('body_table')--}}
                    {{--table_body.innerText = ''--}}
                    {{--$.ajax({--}}
                    {{--    url: '/docs/actual_declarations/get_params',--}}
                    {{--    type: 'GET',--}}
                    {{--    success: (res) => {--}}
                    {{--        var num = 1--}}
                    {{--        for (var row of res) {--}}
                    {{--            var tr = document.createElement('tr')--}}
                    {{--            tr.innerHTML += `<td style="text-align: center">${num}</td>`--}}
                    {{--            tr.innerHTML += `<td style="text-align: center" class="filter name_DPB actual_declarations">${row['name_DPB']}</td>`--}}
                    {{--            tr.innerHTML += `<td style="text-align: center" class="filter parts_DPB actual_declarations">${row['parts_DPB']}</td>`--}}
                    {{--            tr.innerHTML += `<td style="text-align: center" class="filter massage_rtn actual_declarations">${row['massage_rtn']}</td>`--}}
                    {{--            tr.innerHTML += `<td style="text-align: center" class="filter reg_num_dpb actual_declarations">${row['reg_num_dpb']}</td>`--}}
                    {{--            tr.innerHTML += `<td style="text-align: center" class="filter name_zepb actual_declarations">${row['name_zepb']}</td>`--}}
                    {{--            tr.innerHTML += `<td style="text-align: center" class="filter reg_num_date_zepb actual_declarations">${row['reg_num_date_zepb']}</td>`--}}
                    {{--            tr.innerHTML += ` @can('report-edit') <td style="text-align: center"><a href="#" onclick="edit_record(${row['id']})">--}}
                    {{--                                                                <img style="margin-left: 8px" alt=""--}}
                    {{--                                                                     src="{{asset('assets/images/icons/edit.svg')}}" class="check_i">--}}
                    {{--                                                            </a>--}}
                    {{--                                                            <a href="#" onclick="remove_record(${row['id']})">--}}
                    {{--                                                                <img style="margin-left: 5px" alt=""--}}
                    {{--                                                                     src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i">--}}
                    {{--                                                            </a></td> @endcan`--}}
                    {{--            table_body.appendChild(tr)--}}
                    {{--            num += 1--}}
                    {{--        }--}}
                },
                error: function (error) {
                    let tbody = document.getElementById('table_for_search').getElementsByTagName('tbody')[0];
                    tbody.innerHTML = '';
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
