@extends('web.layouts.app')
@section('title')
    Документарный блок
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
    <div class="inside_content">

        <div class="card-header" , style="margin-top: 30px"><h2 class="text-muted" style="text-align: center">Сведения, характеризующие ОПО</h2></div>
        <div class="doc_header" style="padding-bottom: 6px">
            <table>
                <tbody>
                <tr>
                    <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}"></td>
                    <td><input type="text" id="search_text" placeholder="Поиск..."></td>
                    <td>
                        @can('entries-add')
                            <div class="bat_add"><a href="/docs/create_intelligence_opo">Добавить сведения</a></div>
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
                    <col style="width: 5%">
                    <col style="width: 30%">
                    <col style="width: 58%">
                    <col style="width: 7%">
                    <thead>
                    <tr>
                        <th style="text-align: center">Номер</th>
                        <th style="text-align: center">Полное наименование ОПО</th>
                        <th style="text-align: center">Место нахождения (адрес) ОПО</th>
                        @can('entries-edit')
                            <th></th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1 ?>
                    @foreach ($opoint as $row)
                        <tr>
                            <td style="text-align: center">{{ $i}}</td>
                            <td style="text-align: center">{{ $row->full_name_opo }}</td>
                            <td style="text-align: center" class="name_event">{{ $row->address_opo }}</td>
                            @can('entries-edit')
                                <td class="centered" style="text-align: center">
                                    <a href="/docs/edit_intelligence_opo/{{$row->id_add_info_opo}}"><img
                                            alt=""
                                            src="{{asset('assets/images/icons/edit.svg')}}"
                                            class="check_i"
                                            style="margin-left: 3px">
                                    </a>
                                    <a href="/docs/show_intelligence_opo/{{$row->id_add_info_opo}}"><img alt=""
                                                                                           src="{{asset('assets/images/icons/search.svg')}}"
                                                                                           class="check_i"
                                                                                            style="margin-left: 2px">
                                    </a>
                                    <a href="#" style="">
                                        <img style="margin-left: 2px" src="{{asset('assets/images/icons/trash.svg')}}" onclick="drop_info_opo({{$row->id_add_info_opo}})" class="trash_i"></a>
                                </td>
                            @endcan
                        </tr>
                        <?php $i++ ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
        function drop_info_opo(id_opo){
            $.ajax({
                url: '/docs/intelligence_opo/delete_all/'+id_opo,
                type: 'GET',
                success: (res) => {
                    window.location.href = '/docs/opo'
                }
            })
        }
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
