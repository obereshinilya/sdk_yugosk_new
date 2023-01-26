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

        <div class="card-header" , style="margin-top: 30px"><h2 class="text-muted" style="text-align: center">Справочник
                элементов ОПО</h2></div>
        <div class="doc_header" style="padding-bottom: 6px">
            <table>
                <tbody>
                <tr>
                    <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}"></td>
                    <td><input type="text" id="search_text" placeholder="Поиск..."></td>
                    <td>
                        @can('entries-add')
                            <div class="bat_add"><a href="/docs/directory_obj/create">Добавить элемент ОПО</a></div>
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
                        <th style="width: 20%">Филиал дочернего общества</th>
                        <th style="width: 21%">Наименование ОПО</th>
                        <th style="width: 21%">Наименование элемента ОПО</th>
                        <th style="width: 15%">Состояние</th>
                        @can('entries-edit')
                            <th style="width: 3%"></th>
                        @endcan
                    </tr>

                    </thead>
                    <tbody>
                    <?php $i =1 ?>
                    @foreach ($objects as $row)
                        <tr>
                            <td style="text-align: center">{{ $i }}</td>
                            <td style="text-align: center">{{ $row->short_name_do }}</td>
                            <td style="text-align: center" class="name_event">{{ $row->full_name_opo }}</td>
                            <td style="text-align: center" class="name_event">{{ $row->full_name_obj }}</td>
                            <td style="text-align: center">{{ $row->descstatus }}</td>
                            @can('entries-edit')
                                <td class="centered" style="text-align: center">
                                    <a href="/docs/directory_obj/edit/{{$row->id_obj}}"><img alt=""
                                                                                             src="{{asset('assets/images/icons/edit.svg')}}"
                                                                                             class="check_i"
                                                                                             style="margin-left: 30px"></a>
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

    {{--        <div class="inside_tab_padding" style="height: 66.3vh; margin-top: 30px">--}}
    {{--            <div style="background: #FFFFFF; border-radius: 6px; width: 1220px" class="row_block form51">--}}
    {{--                <table>--}}
    {{--                    <thead>--}}
    {{--                    <tr>--}}
    {{--                        <th>Номер</th>--}}
    {{--                        <th>Наименование ДО</th>--}}
    {{--                        <th>Наименование ОПО</th>--}}
    {{--                        <th>Идентификатор</th>--}}
    {{--                        <th></th>--}}
    {{--                    </tr>--}}

    {{--                    </thead>--}}
    {{--                    <tbody >--}}
    {{--                    @foreach ($opos as $row)--}}
    {{--                        <tr>--}}
    {{--                            <td style="text-align: center">{{ $row->id_opo }}</td>--}}
    {{--                            <td style="text-align: center">{{ $row->short_name_do }}</td>--}}
    {{--                            <td style="text-align: center">{{ $row->full_name_opo }}</td>--}}
    {{--                            <td style="text-align: center">{{ $row->guid }}</td>--}}
    {{--                            <td  class="centered">--}}

    {{--                                <a href="{{ route('edit_OPO',$row->idOPO) }}"><img  alt="" src="{{asset('assets/images/icons/edit.svg')}}" class="check_i" style="margin-left: 20px"></a>--}}
    {{--                                <a href="{{ route('show_OPO',$row->idOPO) }}"><img  alt="" src="{{asset('assets/images/icons/search.svg')}}" class="open_i" style="margin-left: 25px"></a>--}}

    {{--                                {!! Form::open(['method' => 'GET','route' => ['delete_OPO', $row->idOPO],'style'=>'display:inline']) !!}--}}
    {{--                                <input type="image" name="picture" src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i" style="width: 15px; height: 15px; margin-top:3px; margin-right: 130px" />--}}
    {{--                                {!! Form::close() !!}--}}
    {{--                            </td>--}}
    {{--                        </tr>--}}
    {{--                    @endforeach--}}
    {{--                    </tbody>--}}
    {{--                </table>--}}
    {{--            </div>--}}
    {{--        </div>--}}


@endsection
