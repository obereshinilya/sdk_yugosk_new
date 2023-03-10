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
                ОПО</h2></div>
        <div class="doc_header" style="padding-bottom: 6px">
            <table>
                <tbody>
                <tr>
                    <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}"></td>
                    <td><input type="text" id="search_text" placeholder="Поиск..."></td>
                    <td>
                        @can('entries-add')
                            <div class="bat_add"><a href="/docs/directory_opo/create">Добавить ОПО</a></div>
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
                        <style>
                            .img {
                                position: absolute;
                                right: 0px;
                                bottom: 0px;
                                width: 20px;
                                border: 2px solid white;
                                border-radius: 2px;
                                background-color: white
                            }
                        </style>
                        <th onclick="sorted_table(1, this)" style="width: 5%">Номер
                            <img class="img" style="display: none" alt=""
                                 src="{{asset('assets/images/icons/arrow_bottom.svg')}}">
                        </th>
                        <th onclick="sorted_table(2, this)" style="width: 15.5%" class="filter short_name_do ref_opo">
                            Наименование филиала ДО
                            <img class="img" style="display: none" alt=""
                                 src="{{asset('assets/images/icons/arrow_bottom.svg')}}">
                        </th>
                        <th onclick="sorted_table(3, this)" style="width: 15.5%" class="filter full_name_opo ref_opo">
                            Наименование ОПО
                            <img class="img" style="display: none" alt=""
                                 src="{{asset('assets/images/icons/arrow_bottom.svg')}}">
                        </th>
                        <th onclick="sorted_table(4, this)" style="width: 10%" class="filter registration_date ref_opo">
                            Дата регистрации
                            <img class="img" style="display: none" alt=""
                                 src="{{asset('assets/images/icons/arrow_bottom.svg')}}">
                        </th>
                        <th onclick="sorted_table(5, this)" style="width: 6%" class="filter region_opo ref_opo">Регион
                            <img class="img" style="display: none" alt=""
                                 src="{{asset('assets/images/icons/arrow_bottom.svg')}}">
                        </th>
                        <th onclick="sorted_table(6, this)" style="width: 8%" class="filter reg_num ref_opo">Рег. №
                            <img class="img" style="display: none" alt=""
                                 src="{{asset('assets/images/icons/arrow_bottom.svg')}}">
                        </th>
                        <th onclick="sorted_table(7, this)" style="width: 8%" class="filter hazard_class ref_opo">Класс
                            опасности
                            <img class="img" style="display: none" alt=""
                                 src="{{asset('assets/images/icons/arrow_bottom.svg')}}">
                        </th>
                        <th onclick="sorted_table(8, this)" style="width: 10%" class="filter descstatus ref_opo">
                            Состояние
                            <img class="img" style="display: none" alt=""
                                 src="{{asset('assets/images/icons/arrow_bottom.svg')}}">
                        </th>
                        @can('entries-edit')
                            <th style="width: 3%"></th>
                        @endcan
                    </tr>

                    </thead>
                    <tbody>
                    @foreach ($opos as $row)
                        <tr>
                            <td style="text-align: center">{{ $row->id_opo }}</td>
                            <td style="text-align: center">{{ $row->short_name_do }}</td>
                            <td style="text-align: center" class="name_event">{{ $row->full_name_opo }}</td>
                            <td style="text-align: center"
                                class="name_event">{{ date('m.d.Y', strtotime($row->registration_date)) }}</td>
                            <td style="text-align: center">{{ $row->region_opo }}</td>
                            <td style="text-align: center" class="name_event">{{ $row->reg_num }}</td>
                            <td style="text-align: center">{{ $row->hazard_class }}</td>
                            <td style="text-align: center">{{ $row->descstatus }}</td>
                            @can('entries-edit')
                                <td class="centered" style="text-align: center">
                                    <a href="/docs/directory_opo/edit/{{$row->id_opo}}"><img
                                            alt=""
                                            src="{{asset('assets/images/icons/edit.svg')}}"
                                            class="check_i"
                                            style="margin-left: 10px; margin-right: 5px"></a>
                                    <a href="/docs/directory_opo/show/{{$row->id_opo}}"><img alt=""
                                                                                             src="{{asset('assets/images/icons/search.svg')}}"
                                                                                             class="check_i"
                                        ></a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    @include('web.include.filters_js')
    <script>
        var input = document.getElementById('search_text')
        input.oninput = function () {
            setTimeout(find_it, 100);
        };

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
                console.log(check_input.join('!!'))

                // input_form.name = fieldsheet.id.replace('fieldsheet_', '')
                // input_form.type = 'text'
                // input_form.value = check_input
                data[fieldsheet.id.replace('fieldsheet_', '')] = check_input.join('!!')

                // post_form.appendChild(input_form)
            }
            console.log(data)
            $.ajax({
                url: '/docs/get_opo_data',
                method: 'POST',
                data: data,
                success(res) {
                    let tbody = document.getElementById('table_for_search').getElementsByTagName('tbody')[0];
                    tbody.innerHTML = '';
                    let i = 1
                    for (var row of res) {
                        var tr = document.createElement('tr')
                        tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${i}</p></td>`
                        tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['short_name_do']}</p></td>`
                        tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['full_name_opo']}</p></td>`
                        tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['registration_date']}</p></td>`

                        tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['region_opo']}</p></td>`

                        tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['reg_num']}</p></td>`
                        tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['hazard_class']}</p></td>`
                        tr.innerHTML += `<td style="text-align: center"><p style="margin: 0; display: inline; ">${row['descstatus']}</p></td>`

                        tr.innerHTML += ` @can('report-edit') <td style="text-align: center; min-width: auto">
                     <a href="/docs/directory_opo/edit/${row['id_opo']}"><img alt=""
                                                                                         src="{{asset('assets/images/icons/edit.svg')}}"
                                                                                         class="check_i"
                                                                                         style=" margin-left: 10px; margin-right: 5px"></a>
                                <a href="/docs/directory_opo/show/${row['id_opo']}"><img alt=""
                                                                                       src="{{asset('assets/images/icons/search.svg')}}"
                                                                                       class="check_i"
                                                                                       ></a>
                    </td> @endcan`
                        tbody.appendChild(tr)

                        i++
                    }
                },
                error: function (error) {
                    var table_body = document.getElementById('body_table')
                    table_body.innerText = ''
                },


            })

        }

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

        function sorted_table(column, th) {
            var class_list = th.classList
            for (var asc of document.getElementsByClassName('asc')) {
                if (asc !== th) {
                    asc.classList.remove('asc')
                    asc.style.background = ''
                }
            }
            for (var desc of document.getElementsByClassName('desc')) {
                if (desc !== th) {
                    desc.classList.remove('desc')
                    desc.style.background = ''
                }
            }
            if (class_list.contains('asc')) {
                th.getElementsByClassName('img')[0].style.display = ''
                th.getElementsByClassName('img')[0].style.rotate = ''
                th.getElementsByClassName('img')[0].style.rotate = '180deg'
                th.classList.remove('asc')
                th.classList.add('desc')
                var sorting = '<'
            } else if (class_list.contains('desc')) {
                th.getElementsByClassName('img')[0].style.display = 'none'
                th.classList.remove('desc')
                var sorting = false
            } else {
                th.getElementsByClassName('img')[0].style.display = ''
                th.getElementsByClassName('img')[0].style.rotate = ''

                th.classList.add('asc')
                var sorting = '>'
            }
            if (sorting) {
                if (sorting === '>') {
                    let sortedRows = Array.from(table_for_search.rows)
                        .slice(1)
                        .sort((rowA, rowB) => rowA.cells[column].innerHTML > rowB.cells[column].innerHTML ? 1 : -1);
                    table_for_search.tBodies[0].append(...sortedRows);
                } else {
                    let sortedRows = Array.from(table_for_search.rows)
                        .slice(1)
                        .sort((rowA, rowB) => rowA.cells[column].innerHTML < rowB.cells[column].innerHTML ? 1 : -1);
                    table_for_search.tBodies[0].append(...sortedRows);
                }
            } else {
                let sortedRows = Array.from(table_for_search.rows)
                    .slice(1)
                    .sort((rowA, rowB) => Number(rowA.cells[0].innerHTML) > Number(rowB.cells[0].innerHTML) ? 1 : -1);
                table_for_search.tBodies[0].append(...sortedRows);
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
