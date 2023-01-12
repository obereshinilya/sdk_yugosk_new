@extends('web.layouts.app')
@section('title')
    Документарный блок
@endsection

@section('content')
    {{--    Включаем всплывашку с новым сообщением о событии--}}
    @can('events-view')
        @include('web.admin.inc.new_JAS')
    @endcan

    @include('web.include.sidebar_doc')
    <div class="top_table">
        @include('web.include.toptable')
    </div>
    <style>
        .form51 table tr th {
            padding: 5px 10px;
        }
    </style>

    <div style="height: 69.3vh">

        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center; color: ${color_text}">
                        <h2 class="text-muted" style="text-align: center; color: ${color_text}; display: inline-block">
                            Оценка состояния промышленной безопасности</h2>

                        <select class="select-css" id="select__year" onchange="get_data()"
                                style="width: 11%; display: inline-block ; margin-left: 2%">
                            @for($i=2021; $i<=2030; $i++)
                                <option value="{{$i}}">{{$i}} год</option>
                            @endfor
                        </select>
                    </div>
                    <div class="doc_header" style="padding-bottom: 6px; width: 75%">
                        <table>
                            <tbody>
                            <tr>
                                <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}">
                                </td>
                                <td><input type="text" id="search_text" style="float: left; width: 40%"
                                           placeholder="Поиск..."></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:83%; padding-left: 0px; margin-top: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table id="table_for_search" style="display: table; table-layout: fixed">
                                <thead>
                                <tr>
                                    <th rowspan="2">Дата</th>
                                    <th colspan="2">Выполнение плана КиПД</th>
                                    <th rowspan="2">Результаты ПК за соблюдением требований ПБ</th>
                                    <th rowspan="2">Результаты гос. надзора</th>
                                    <th rowspan="2">Результаты корп. контроля</th>
                                    <th rowspan="2">Оценка уровня аварийности на ОПО</th>
                                    <th rowspan="2">Оценка готовности персонала ОПО</th>
                                    <th rowspan="2">Информация о выполнении плана работ в области ПБ</th>
                                    <th rowspan="2">Выполнение планов КР и ДТОиР ОПО</th>
                                    <th rowspan="2">Достижение целей в области ПБ</th>
                                    <th rowspan="2">Итоговая оценка</th>
                                </tr>
                                <tr>
                                    <th>по результатам внутренних проверок</th>
                                    <th>утвержденного по итогам анализа ЕСУПБ</th>
                                </tr>
                                </thead>
                                <tbody id="tbody_main_report">

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
            document.getElementById('select__year').value = date.getFullYear()
            get_data()
        })

        function get_data() {
            $.ajax({
                url: '/get_indicator/' + document.getElementById('select__year').value,
                type: 'GET',
                success: (res) => {
                    var table_body = document.getElementById('tbody_main_report')
                    table_body.innerText = ''
                    for (var row of res) {
                        var tr = document.createElement('tr')
                        var color_text = '#858585'
                        if (Number(row['sum_ind']) < 9 && Number(row['sum_ind']) >= 6) {
                            tr.style.background = '#FFE599'
                        } else if (Number(row['sum_ind']) >= 9) {
                            tr.style.background = '#C5E0B3'
                        } else {
                            tr.style.background = '#FF0000'
                            color_text = 'white'
                        }
                        let date = new Date(row['date']);
                        let dd = date.getDate();
                        if (dd < 10) dd = '0' + dd;

                        let mm = date.getMonth() + 1;
                        if (mm < 10) mm = '0' + mm;

                        let yyyy = date.getFullYear();

                        tr.innerHTML += `<td style="text-align: center; color: ${color_text}">${dd}.${mm}.${yyyy}</td>`
                        tr.innerHTML += `<td style="text-align: center; color: ${color_text}">${row['ind_kipd_internal_checks']}</td>`
                        tr.innerHTML += `<td style="text-align: center; color: ${color_text}">${row['ind_performance_plan_kipd']}</td>`
                        tr.innerHTML += `<td style="text-align: center; color: ${color_text}">${row['ind_result_apk']}</td>`
                        tr.innerHTML += `<td style="text-align: center; color: ${color_text}">${row['ind_rosteh']}</td>`
                        tr.innerHTML += `<td style="text-align: center; color: ${color_text}">${row['ind_gaznadzor']}</td>`
                        tr.innerHTML += `<td style="text-align: center; color: ${color_text}">${row['ind_sved_avar']}</td>`
                        tr.innerHTML += `<td style="text-align: center; color: ${color_text}">${row['ind_emergency_drills']}</td>`
                        tr.innerHTML += `<td style="text-align: center; color: ${color_text}">${row['ind_plan_industial_safety']}</td>`
                        tr.innerHTML += `<td style="text-align: center; color: ${color_text}">${row['ind_kr_dtoip']}</td>`
                        tr.innerHTML += `<td style="text-align: center; color: ${color_text}">${row['ind_goals']}</td>`
                        tr.innerHTML += `<td style="text-align: center; color: ${color_text}">${row['sum_ind']}</td>`
                        table_body.appendChild(tr)
                    }
                },
            })
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
