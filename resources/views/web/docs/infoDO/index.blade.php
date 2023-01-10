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
    @can('events-view')
        <div class="top_table">
            @include('web.include.toptable')
        </div>
    @endcan
    <div class="inside_content">

        <div class="card-header" style="margin-top: 30px"><h2 class="text-muted" style="text-align: center">Справочник филиалов
                ДО</h2></div>
        <div class="doc_header" style="padding-bottom: 6px">
            <table>
                <tbody>
                <tr>
                    <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}"></td>
                    <td><input type="text" id="search_text" placeholder="Поиск..."></td>
                    <td>
                        @can('entries-add')
                            <div class="bat_add"><a href="/docs/directory_do/create">Добавить филиал ДО</a></div>
                        @endcan
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="inside_tab_padding"
             style="overflow-y: auto; height: 54.5vh; padding-left: 0px; padding-right: 0px; margin-top: 0px">
            <div style="background: #FFFFFF; border-radius: 6px" class="row_block form51">
                <table id="table_for_search" style="display: table; table-layout: fixed">
                    <thead>
                    <tr>
                        <th style="width: 5%">Номер</th>
                        <th style="width: 25%">Краткое наименование филиала ДО</th>
                        <th style="width: 45%">Наименование филиала ДО</th>
                        <th style="width: 10%">Регион</th>
                        <th style="width: 10%">Состояние</th>
                                                @can('entries-edit')
                                                <th style="width: 5%"></th>
                                                @endcan
                    </tr>

                    </thead>
                    <tbody>
                    @foreach ($opos as $row)
                        <tr>
                            <td style="text-align: center">{{ $row->id_do }}</td>
                            <td style="text-align: center">{{ $row->short_name_do }}</td>
                            <td style="text-align: center" class="name_event">{{ $row->full_name_do }}</td>
                            <td style="text-align: center">{{ $row->region }}</td>
                            <td style="text-align: center">{{ $row->descstatus }}</td>
                            <td class="centered" style="text-align: center">

                                <a href="/docs/directory_do/edit/{{$row->id_do}}"><img alt=""
                                                                                         src="{{asset('assets/images/icons/edit.svg')}}"
                                                                                         class="check_i"
                                                                                         style=" margin-left: 10px; margin-right: 5px"></a>
                                <a href="/docs/directory_do/show/{{$row->id_do}}"><img alt=""
                                                                                       src="{{asset('assets/images/icons/search.svg')}}"
                                                                                       class="check_i"
                                                                                       ></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
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
