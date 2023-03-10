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
            padding: 20px 0;
        }

        @endcan
        table {
            -webkit-print-color-adjust: exact; /* благодаря этому заработал цвет*/
            white-space: -moz-pre-wrap; /* Mozilla, начиная с 1999 года */
            white-space: -pre-wrap; /* Opera 4-6 */
            white-space: -o-pre-wrap; /* Opera 7 */
            word-wrap: break-word;
            word-break: break-word;
        }

        th {
            text-align: center;
        }
    </style>
    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline-block; margin-right: 10px">
                            Выполнение
                            плана-графика аттестации в области промышленной безопасности за </h2>
                        <input style="width: 5%; display: inline-block; margin-right: 10px" type="number"
                               id="select__year" class="text-field__input" min="1970" max="2030"
                               onblur="get_data()"></input>
                        <h2 class="text-muted" style="text-align: center; display: inline; ">год</h2>
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
                                              action="{{ route('excel_fulfillment') }}">
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
                                    @endcan
                                    @can('entries-add')
                                        <div class="bat_add" style="margin-left: 0; display: inline-block"><a
                                                href="/docs/fulfillment_certification/create"
                                                style="display: inline-block">Добавить
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
                        <div style="background: #FFFFFF; border-radius: 6px; width: 200%" class="form51">
                            <table id="table_for_search" style="display: table; table-layout: fixed; width: 100%">
                                <thead>
                                <tr>
                                    <th style="width: 6%" rowspan="3" class="filter short_name_do fulfillment">
                                        Наименование филиала общества
                                    </th>
                                    <th colspan="5">Руководители и члены ЦЭК ДО
                                    </th>
                                    <th colspan="8">Работники администрации ДО</th>
                                    <th colspan="5">Руководители и члены ЭК филиалов</th>
                                    <th colspan="8">Работники филиалов ДО</th>
                                    @can('report-edit')
                                        <th rowspan="3" style="width: 3%"></th>
                                    @endcan
                                </tr>
                                <tr>
                                    <th colspan="3" style="position: sticky; top: 21px">Аттестация по промышленной
                                        безопасности в Ростехнадзоре (чел.)
                                    </th>
                                    <th colspan="2" style="position: sticky; top: 21px">Повышение квалификации, чел</th>
                                    <th colspan="3" style="position: sticky; top: 21px">Аттестация по промышленной
                                        безопасности в Ростехнадзоре (чел.)
                                    </th>
                                    <th colspan="3" style="position: sticky; top: 21px">Аттестация по промышленной
                                        безопасности с использованием ИС
                                        ЕПТ(чел.)
                                    </th>
                                    <th colspan="2" style="position: sticky; top: 21px">Повышение квалификации по ОТ,
                                        чел
                                    </th>
                                    <th colspan="3" style="position: sticky; top: 21px"> Аттестация по промышленной
                                        безопасности (чел.)
                                    </th>
                                    <th colspan="2" style="position: sticky; top: 21px">Повышение квалификации, чел</th>
                                    <th colspan="3" style="position: sticky; top: 21px">Аттестация по промышленной
                                        безопасности в Ростехнадзоре (чел.)
                                    </th>
                                    <th colspan="3" style="position: sticky; top: 21px"> Аттестация по промышленной
                                        безопасности с использованием ИС
                                        ЕПТ(чел.)
                                    </th>
                                    <th colspan="2" style="position: sticky; top: 21px">Повышение квалификации по ПБ,
                                        чел
                                    </th>
                                </tr>
                                <tr>
                                    <th style="position: sticky; top: 58px" class="filter rostech_cec fulfillment">
                                        всего
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter rostech_cec_plan fulfillment">
                                        план
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter rostech_cec_fact fulfillment">
                                        факт
                                    </th>
                                    <th style="position: sticky; top: 58px"
                                        class="filter skills_up_cec_plan fulfillment">план
                                    </th>
                                    <th style="position: sticky; top: 58px"
                                        class="filter skills_up_cec_fact fulfillment">факт
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter rostech_adm_do fulfillment">
                                        всего
                                    </th>
                                    <th style="position: sticky; top: 58px"
                                        class="filter rostech_adm_do_plan fulfillment">план
                                    </th>
                                    <th style="position: sticky; top: 58px"
                                        class="filter rostech_adm_do_fact fulfillment">факт
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter is_ept_adm_do fulfillment">
                                        всего
                                    </th>
                                    <th style="position: sticky; top: 58px"
                                        class="filter is_ept_adm_do_plan fulfillment">план
                                    </th>
                                    <th style="position: sticky; top: 58px"
                                        class="filter is_ept_adm_do_fact fulfillment">факт
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter ot_adm_do_plan fulfillment">
                                        план
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter ot_adm_do_fact fulfillment">
                                        факт
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter pb_ec fulfillment">всего</th>
                                    <th style="position: sticky; top: 58px" class="filter pb_ec_plan fulfillment">план
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter pb_ec_fact fulfillment">факт
                                    </th>
                                    <th style="position: sticky; top: 58px"
                                        class="filter skills_up_ec_plan fulfillment">план
                                    </th>
                                    <th style="position: sticky; top: 58px"
                                        class="filter skills_up_ec_fact fulfillment">факт
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter rostech_do fulfillment">
                                        всего
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter rostech_do_plan fulfillment">
                                        план
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter rostech_do_fact fulfillment">
                                        факт
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter is_ept_do fulfillment">всего
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter is_ept_do_plan fulfillment">
                                        план
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter is_ept_do_fact fulfillment">
                                        факт
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter pb_do_plan fulfillment">план
                                    </th>
                                    <th style="position: sticky; top: 58px" class="filter pb_do_fact fulfillment">факт
                                    </th>
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
    @include('web.include.filters_js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var date = new Date();
            document.getElementById('select__year').value = date.getFullYear();

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
                url: '/docs/fulfillment_certification/get_params',
                type: 'POST',
                data: data,
                success: (res) => {
                    for (var row of res) {
                        var tr = document.createElement('tr')
                        tr.innerHTML += `<td style="text-align: center">${row['short_name_do']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['rostech_cec']}</td>`

                        tr.innerHTML += `<td style="text-align: center">${row['rostech_cec_plan']}</td>`


                        tr.innerHTML += `<td style="text-align: center">${row['rostech_cec_fact']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['skills_up_cec_plan']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['skills_up_cec_fact']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['rostech_adm_do']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['rostech_adm_do_plan']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['rostech_adm_do_fact']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['is_ept_adm_do']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['is_ept_adm_do_plan']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['is_ept_adm_do_fact']}</td>`

                        tr.innerHTML += `<td style="text-align: center">${row['ot_adm_do_plan']}</td>`


                        tr.innerHTML += `<td style="text-align: center">${row['ot_adm_do_fact']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['pb_ec']}</td>`

                        tr.innerHTML += `<td style="text-align: center">${row['pb_ec_plan']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['pb_ec_fact']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['skills_up_ec_plan']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['skills_up_ec_fact']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['rostech_do']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['rostech_do_plan']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['rostech_do_fact']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['is_ept_do']}</td>`

                        tr.innerHTML += `<td style="text-align: center">${row['is_ept_do_plan']}</td>`


                        tr.innerHTML += `<td style="text-align: center">${row['is_ept_do_fact']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['pb_do_plan']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['pb_do_fact']}</td>`

                        tr.innerHTML += ` @can('report-edit') <td style="text-align: center; min-width: auto">
                    <a href="#" onclick="edit_record(${row['id']})"><img style="width: 15px; height: 15px; margin: 3px"  alt="" src="{{asset('assets/images/icons/edit.svg')}}" class="check_i"></a>
                    <a href="#" style="" onclick="remove_record(${row['id']})"><img style="opacity:1; width: 15px; height: 15px; margin: 3px"  alt="" src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i"></a>
                    </td> @endcan `
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
                url: '/docs/fulfillment_certification/remove/' + id,
                type: 'GET',
                success: (res) => {
                    window.location.href = '/docs/fulfillment_certification'
                }
            })
        }


        //скрипт для изменения
        function edit_record(id) {
            window.location.href = '/docs/fulfillment_certification/edit/' + id
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
