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
        th, td{
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

        @endcan
        .selected_column{
            font-weight: bold;
        }
        table {
            -webkit-print-color-adjust: exact; /* благодаря этому заработал цвет*/
            white-space: -moz-pre-wrap; /* Mozilla, начиная с 1999 года */
            /*white-space: -pre-wrap; !* Opera 4-6 *!*/
            white-space: -o-pre-wrap; /* Opera 7 */
            /*word-wrap: break-word;*/
            /*word-break: break-all;*/
        }
        .form51 table tr th {
            padding: 3px;
        }
    </style>
    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline-block">Реестр заключений
                            экспертизы промышленной безопасности. Объект: </h2>
                        <select class="select-css" id="select__year" onchange="get_data()"
                                style="width: 20%; display: inline-block; margin-left: 2%">
                            <option value="all">По всем филиалам</option>
                        @foreach($do as $row)
                                <option value="{{$row->name_do}}">{{$row->name_do}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="doc_header" style="padding-bottom: 6px">
                        <table>
                            <tbody>
                            <tr>
                                <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}">
                                </td>
                                <td><input type="text" id="search_text" placeholder="Первый фильтр..."></td>
                                <td><input type="text" id="search_text_Second" placeholder="Второй фильтр..."></td>
                                <td><input type="text" id="search_text_third" placeholder="Третий фильтр..."></td>
                                <td>
                                    @can('doc-create')
                                        <div class="bat_info" style="display: inline-block"><a
                                                href="/docs/conclusions_industrial_safety/excel/{year}"
                                                style="display: inline-block">Экспорт в excel</a>
                                        </div>
                                    @endcan
                                    @can('entries-add')
                                        <div class="bat_add" style="margin-left: 0; display: inline-block"><a
                                                href="/docs/conclusions_industrial_safety/create"
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
                        <div style="background: #FFFFFF; border-radius: 6px; width: 350%" class="form51">
                            <table id="table_for_search" style="display: table; table-layout: fixed; width: 100%">
                                <colgroup>
                                    <col style="width: 1%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 3%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 5%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 2%">
                                    <col style="width: 1%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th rowspan="2" style="position: sticky; left: 2px; z-index: 20" onclick="sorted_table(0, this)">№ п/п</th>
                                    <th rowspan="2" style="position:sticky; left: 5.8%; z-index: 20" onclick="sorted_table(1, this)">Наименование центра финансовой
                                        отвественности
                                    </th>
                                    <th rowspan="2" onclick="sorted_table(2, this)">Наименование филиала</th>
                                    <th rowspan="2" onclick="sorted_table(3, this)">Вид ТУ, зданий и сооружений</th>
                                    <th colspan="9">Место проведения ЭПБ</th>
                                    <th rowspan="2" onclick="sorted_table(13, this)">Дата ввода в эксплуатацию</th>
                                    <th rowspan="2" onclick="sorted_table(14, this)">Дата проведения ЭПБ</th>
                                    <th colspan="2">Срок эксплуатации/ наработка на момент ЭПБ</th>
                                    <th colspan="2">Срок продления безопасной эксплуатации</th>
                                    <th colspan="2">Дата/наработка следующей ЭПБ</th>
                                    <th rowspan="2" onclick="sorted_table(21, this)">Уведомление о внесении в реестр (№ письма,
                                        дата)
                                    </th>
                                    <th rowspan="2" onclick="sorted_table(22, this)">Регистрационный номер заключения ЭПБ</th>
                                    <th rowspan="2" onclick="sorted_table(23, this)">Наличие условий действий заключений</th>
                                    <th rowspan="2" onclick="sorted_table(24, this)">Факт выполнения условий</th>
                                    <th rowspan="2" onclick="sorted_table(25, this)" style="">Условия действия заключений</th>
                                    <th rowspan="2" onclick="sorted_table(26, this)">Срок выполнения условий</th>
                                    <th rowspan="2" onclick="sorted_table(27, this)">Приоритетность</th>
                                    <th rowspan="2" onclick="sorted_table(28, this)">Номер заключения ЭПБ подрядной
                                        организации
                                    </th>
                                    <th rowspan="2" onclick="sorted_table(29, this)">Наименование экспертной организации</th>
                                    @can('report-edit')
                                        <th rowspan="2" style="width: 1%"></th>
                                    @endcan
                                </tr>
                                <tr>
                                    <th style="top:25px" onclick="sorted_table(4, this)">Наименование объекта</th>
                                    <th style="top:25px" onclick="sorted_table(5, this)">Наименов-е цеха/ местонахождения</th>
                                    <th style="top:25px" onclick="sorted_table(6, this)">№ цеха</th>
                                    <th style="top:25px" onclick="sorted_table(7, this)">Наименов-е ТУ, здания, сооружения</th>
                                    <th style="top:25px" onclick="sorted_table(8, this)">Изготовитель/ проектная организация</th>
                                    <th style="top:25px" onclick="sorted_table(9, this)"> Станц-й номер, рег.№, участок
                                        (км-км)
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(10, this)">Зав. №</th>
                                    <th style="top:25px" onclick="sorted_table(11, this)">Протяженность газопровода, км,
                                        кол-во, шт.
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(12, this)"> Инв.
                                        №ТУ, здания, сооружения
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(15, this)">Наработка ТУ, часов
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(16, this)"> Кол-во лет ТУ, зданию, сооружению
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(17, this)">Наработка ТУ, часов
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(18, this)"> Кол-во лет ТУ, зданию, сооружению
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(19, this)">Наработка до следующего ЭПБ
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(20, this)"> Дата следующего ЭПБ
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('select__year').value = 'Краснотурьинское ЛПУМГ';

            get_data()
        })
        function sorted_table(column, th){
            var class_list = th.classList
            for(var asc of document.getElementsByClassName('asc')){
                if (asc !== th){
                    asc.classList.remove('asc')
                    asc.style.background = ''
                }
            }
            for(var desc of document.getElementsByClassName('desc')){
                if (desc !== th){
                    desc.classList.remove('desc')
                    desc.style.background = ''
                }
            }
            if (class_list.contains('asc')){
                th.style.background = '#FADADD'
                th.classList.remove('asc')
                th.classList.add('desc')
                var sorting = '<'
            }else if (class_list.contains('desc')){
                th.style.background = ''
                th.classList.remove('desc')
                var sorting = false
            }else {
                th.style.background = '#00FF7F'
                th.classList.add('asc')
                var sorting = '>'
6            }
            if (sorting){
                if (sorting === '>'){
                    let sortedRows = Array.from(table_for_search.rows)
                        .slice(2)
                        .sort((rowA, rowB) => rowA.cells[column].innerHTML > rowB.cells[column].innerHTML ? 1 : -1);
                    table_for_search.tBodies[0].append(...sortedRows);
                }else {
                    let sortedRows = Array.from(table_for_search.rows)
                        .slice(2)
                        .sort((rowA, rowB) => rowA.cells[column].innerHTML < rowB.cells[column].innerHTML ? 1 : -1);
                    table_for_search.tBodies[0].append(...sortedRows);
                }
            }else {
                let sortedRows = Array.from(table_for_search.rows)
                    .slice(2)
                    .sort((rowA, rowB) => Number(rowA.cells[0].innerHTML) > Number(rowB.cells[0].innerHTML) ? 1 : -1);
                table_for_search.tBodies[0].append(...sortedRows);
            }
        }
        function get_data() {
            @can('doc-create')
            let excel = document.querySelector('.bat_info');
            excel.firstChild.href = '/excel_conclusions_industrial_safety/' + document.getElementById('select__year').value;
            @endcan
            var table_body = document.getElementById('body_table')
            table_body.innerText = ''
            $.ajax({
                url: '/docs/conclusions_industrial_safety/get_params/' + document.getElementById('select__year').value,
                type: 'GET',
                success: (res) => {
                    for (var row of res) {
                        var tr = document.createElement('tr');
                        tr.innerHTML += `<td style="text-align: center; position: sticky; left: 2px; background-color: white">${row['id']}</td>`
                        tr.innerHTML += `<td style="text-align: center; position: sticky; left: 5.8%; background-color: white">${row['center_name']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['name_do']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['type_tu']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['object_name']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['workshop_name']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['n_workshop']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['name_tu']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['manufacturer']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['station_number']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['factory_num']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['pipeline_length']}</td>`

                        tr.innerHTML += `<td style="text-align: center">${row['inv_tu_num']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['date_comiss']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['date_epb']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['runtime_tu']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['age_tu']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['runtime_ext_tu']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['age_ext_tu']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['runtime_epb']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['date_next_epb']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['notification']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['reg_num']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['conditions']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['completion_mark']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['conditions_concl']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['due_date']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['priority']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['concl_num']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['exp_org_name']}</td>`
                        tr.innerHTML += ` @can('report-edit') <td style="text-align: center; min-width: auto">
                    <a href="#" onclick="edit_record(${row['id']})"><img style="width: 15px; height: 15px; margin: 3px"  alt="" src="{{asset('assets/images/icons/edit.svg')}}" class="check_i"></a>
                    <a href="#" style="" onclick="remove_record(${row['id']})"><img style="opacity:1; width: 15px; height: 15px; margin: 3px"  alt="" src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i"></a>
                    </td>  @endcan`

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
                url: '/docs/conclusions_industrial_safety/remove/' + id,
                type: 'GET',
                success: (res) => {
                    window.location.href = '/docs/conclusions_industrial_safety'
                }
            })
        }


        //скрипт для изменения
        function edit_record(id) {
            window.location.href = '/docs/conclusions_industrial_safety/edit/' + id
        }


        ///скрипт для поиска
        var input = document.getElementById('search_text')
        input.oninput = function () {
            setTimeout(find_it, 100);
        };
        ///скрипт для поиска 2
        var input2 = document.getElementById('search_text_Second')
        input2.oninput = function () {
            setTimeout(find_it, 100);
        };
        ///скрипт для поиска 3
        var input3 = document.getElementById('search_text_third')
        input3.oninput = function () {
            setTimeout(find_it, 100);
        };

        function find_it() {
            var table_boby_rows = document.getElementById('table_for_search').getElementsByTagName('tbody')[0].getElementsByTagName('tr')  //строки по которым ищем
            var search_text = new RegExp(document.getElementById('search_text').value, 'i');   //искомый текст
            var search_text_sec = new RegExp(document.getElementById('search_text_Second').value, 'i');   //искомый текст
            var search_text_third = new RegExp(document.getElementById('search_text_third').value, 'i');   //искомый текст
            for (var i = 0; i < table_boby_rows.length; i++) {  //проходимся по строкам
                var flag_success = false   //станет true, если есть совпадение в строке
                var flag_success_sec = false   //станет true, если есть совпадение в строке
                var flag_success_third = false   //станет true, если есть совпадение в строке
                var tds_row = table_boby_rows[i].getElementsByTagName('td')   //ячейки строки
                for (var j = 0; j < tds_row.length; j++) {   //проходимся по ячейкам
                    if (tds_row[j].textContent.match(search_text)) {
                        flag_success = true
                    }
                    if (tds_row[j].textContent.match(search_text_sec)) {
                        flag_success_sec = true
                    }
                    if (tds_row[j].textContent.match(search_text_third)) {
                        flag_success_third = true
                    }
                }
                if (flag_success && flag_success_sec && flag_success_third) {
                    table_boby_rows[i].style.display = ""
                } else {
                    table_boby_rows[i].style.display = "none"
                }
            }
        }
    </script>

@endsection
