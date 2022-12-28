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

.form51 table tr th{padding: 2px 3px}
.form51 table tr td{padding: 2px 3px}

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
                        <h2 class="text-muted" style="text-align: center; display: inline-block">Цели ООО «Газпром
                            трансгаз Югорск» в области
                            производственной безопасности на
                        </h2>
                        <select class="select-css" id="select__year" onchange="get_data()"
                                style="width: 11%; display: inline-block; margin-left: 2%">
                            @for($i=2015; $i<=2023; $i++)
                                <option value="{{$i}}">{{$i}} год</option>
                            @endfor
                        </select>
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
                                                href="/excel_goals_trans_yugorsk/"
                                                style="display: inline-block">Экспорт в excel</a>
                                        </div>
                                        <div class="bat_info pdf" style="display: inline-block; margin-left: 0px"><a
                                                href="/pdf_goals_trans_yugorsk/"
                                                style="display: inline-block">Печать в pdf</a>
                                        </div>
                                    @endcan
                                    @can('entries-add')
                                        <div class="bat_add" style="margin-left: 0; display: inline-block"><a
                                                style="display: inline-block" href="/docs/goals_trans_yugorsk/create">Добавить
                                                запись</a>
                                        </div>
                                    @endcan
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:70vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table id="table_for_search" style="display: table">
                                @can('report-edit')
                                    <colgroup>
                                        <col style="width: 6%">
                                        <col style="width: 20%">
                                        <col style="width: 20%">
                                        <col style="width: 12%">
                                        <col style="width: 18%">
                                        <col style="width: 10%">
                                        <col style="width: 10%">
                                        <col style="width: 5%">
                                    </colgroup>
                                @endcan
                                <thead>
                                <tr>
                                    <th style="text-align: center">№ п/п</th>
                                    <th style="text-align: center">Цели в области производственной безопасности</th>
                                    <th style="text-align: center">Ожидаемый результат при достижении цели</th>
                                    <th style="text-align: center">Срок достижения цели</th>
                                    <th style="text-align: center">Подразделение, ответственное за достижение
                                        результата
                                    </th>
                                    <th style="text-align: center">Отметка о выполнении</th>
                                    <th style="text-align: center">Индикативный показатель</th>
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
            var date = new Date();
            document.getElementById('select__year').value = date.getFullYear()
            get_data()
        })

        function get_data() {
            @can('doc-create')
            let pdf = document.querySelector('.pdf');
            pdf.firstChild.href = '/pdf_goals_trans_yugorsk/' + document.getElementById('select__year').value;
            let excel = document.querySelector('.excel');
            excel.firstChild.href = '/excel_goals_trans_yugorsk/' + document.getElementById('select__year').value;
            @endcan
            var table_body = document.getElementById('body_table')
            table_body.innerText = ''
            $.ajax({
                url: '/docs/goals_trans_yugorsk/get_params/' + document.getElementById('select__year').value,
                type: 'GET',
                success: (res) => {
var num =1
//console.log( document.getElementById('select__year').value)
                    for (var row of res) {
                        var tr = document.createElement('tr')
                        tr.innerHTML += `<td style="text-align: center">${num}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['safety_goals']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['result_goal']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['data_goal']}</td>`
                        tr.innerHTML += `<td style="text-align: center">${row['department']}</td>`
                        if(Number(row['completion_mark']) > 0){
                            tr.innerHTML += `<td style="text-align: center">Выполнено</td>`
                        }else{
                            tr.innerHTML += `<td style="text-align: center">Не выполнено</td>`
                        }
                        tr.innerHTML += `<td style="text-align: center">${row['indicative_indicator']}</td>`
                        tr.innerHTML += ` @can('report-edit') <td style="text-align: center"><a href="#" onclick="edit_record(${row['id']})">
                                                                            <img alt=""
                                                                                 src="{{asset('assets/images/icons/edit.svg')}}" class="check_i">
                                                                        </a>
                                                                        <a href="#" onclick="remove_record(${row['id']})">
                                                                            <img alt=""
                                                                                 src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i">
                                                                        </a></td> @endcan`
                        table_body.appendChild(tr)
num+=1
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
                url: '/docs/goals_trans_yugorsk/remove/' + id,
                type: 'GET',
                success: (res) => {
                    window.location.href = '/docs/goals_trans_yugorsk'
                }
            })
        }

        //скрипт для изменения
        function edit_record(id) {
            window.location.href = '/docs/goals_trans_yugorsk/edit/' + id
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
