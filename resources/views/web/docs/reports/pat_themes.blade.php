@extends('web.layouts.app')
@section('title')
    Перечень тем противоаварийных тренировок
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
    <div class="inside_content">
        <div class="card-header" , style="margin-top: 30px"><h2 class="text-muted" style="text-align: center">Перечень
                тем противоаварийных тренировок
            </h2></div>
        <div class="doc_header" style="padding-bottom: 6px">
            <table>
                <tbody>
                <tr>
                    <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}"></td>
                    <td><input type="text" id="search_text" placeholder="Поиск..."></td>
                    <td>
                        @can('entries-add')
                            <div class="bat_add"><a href="/docs/pat_themes/create">Добавить</a></div>
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
                        <th style="width: 5%">№</th>
                        <th style="width: 90%">Наименование темы противоаварийной тренировки</th>
                        @can('report-edit')
                            <th style="width: 5%"></th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <td style="text-align: center">{{ $row->id }}</td>
                            <td style="text-align: center">{{ $row->pat_desc }}</td>
                            @can('report-edit')
                                <td style="text-align: center; min-width: auto">
                                    <a href="#" onclick="edit_record({{$row->id}})"><img
                                            style="width: 15px; height: 15px; margin: 3px; margin-left: 14px" alt=""
                                            src="{{asset('assets/images/icons/edit.svg')}}" class="check_i"></a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
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

        //скрипт для изменения
        function edit_record(id) {
            window.location.href = '/docs/pat_themes/edit/' + id
        }
    </script>


@endsection
