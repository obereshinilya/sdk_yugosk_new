@extends('web.layouts.app')
@section('title')
    Справочник видов аварий, инцидентов и предпоссылок к инцидентам
@endsection

@section('content')
    @can('events-view')
        {{--    Включаем всплывашку с новым сообщением о событии--}}
        @include('web.admin.inc.new_JAS')
    @endcan
    @include('web.include.sidebar_doc')
    @can('events-view')
        <div class="top_table">
            @include('web.include.toptable')
        </div>
    @endcan
    <style>
        td::selection {
            background: yellow;
        }
    </style>

    <div class="inside_content">
        <div class="card-header" , style="margin-top: 30px"><h2 class="text-muted" style="text-align: center">Справочник
                видов аварий, инцидентов и предпоссылок к инцидентам</h2></div>
        <div class="doc_header" style="padding-bottom: 6px">
            <table>
                <tbody>
                <tr>
                    <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}"></td>
                    <td><input type="text" id="search_text" placeholder="Поиск..."></td>
                    <td>
                        @can('entries-add')
                            <div class="bat_add"><a href="/docs/incidents/create">Добавить</a></div>
                        @endcan
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="inside_tab_padding"
             style="overflow-y: auto; height: 54.5vh; padding-left: 0px; padding-right: 0px; margin-top: 0px">
            <div style="background: #FFFFFF; border-radius: 6px" class="row_block form51">
                <table style="display: table; table-layout: fixed" id="table_for_search">
                    <thead>
                    <tr>
                        <th style="width: 20%">Техногенное событие</th>
                        <th style="width: 80%">Вид</th>
                    </tr>
                    </thead>
                    <tbody id="body_table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
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
                            console.log(tds_row[j].childNodes)
                            flag_success = true
                            tds_row[j].firstChild.style.background = 'yellow';
                        } else {
                            tds_row[j].firstChild.style.background = 'none';

                        }
                    }

                }
            } else {
                for (var i = 0; i < table_boby_rows.length; i++) {  //проходимся по строкам
                    tds_row = table_boby_rows[i].getElementsByTagName('td')   //ячейки строки
                    for (var j = 0; j < tds_row.length; j++) {   //проходимся по ячейка
                        tds_row[j].firstChild.style.background = 'none';
                    }
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            get_data()
        })

        function get_data() {
            var table_body = document.getElementById('body_table')
            table_body.innerText = ''
            $.ajax({
                url: '/docs/incidents/get_params/',
                type: 'GET',
                success: (res) => {
                    console.log(res)
                    var keys = Object.keys(res)
                    for (var key of keys) {
                        var i = 1
                        for (var row of res[key]) {
                            var tr = document.createElement('tr')

                            if (i == 1) {
                                tr.innerHTML += `<td rowspan="${res[key].length}" style="text-align: center"><p style="display:inline; margin:0;">${row['type']}</p></td>`
                            }
                            tr.innerHTML += `<td style="text-align: center"><p style="display:inline; margin:0;">${row['type_incident']}</p></td>`
                            table_body.appendChild(tr)
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
