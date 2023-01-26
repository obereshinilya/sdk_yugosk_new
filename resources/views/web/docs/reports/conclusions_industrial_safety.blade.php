@extends('web.layouts.app')
@section('title')
    Отчеты
@endsection

@section('content')
    @push('app-css')
        <link href="{{ asset('css/app_short.css') }}" rel="stylesheet">
    @endpush
    {{--    Включаем всплывашку с новым сообщением о событии--}}
    @can('events-view')
        @include('web.admin.inc.new_JAS')
    @endcan
    @include('web.include.sidebar_doc')
    <style>
        th, td {
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
        .selected_column {
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
    <form method="POST"  style="display: none" action="{{ route('open_conclusions_industrial_safety') }}">
        @csrf
                <input id="arr_name_center" type="text" class="form-control" name="arr_name_center">
                <input id="arr_name_do" type="text" class="form-control" name="arr_name_do">
                <input id="arr_date_epb" type="text" class="form-control" name="arr_date_epb">
                <input id="arr_date_next_epb" type="text" class="form-control" name="arr_date_next_epb">
                <input id="arr_type_tu" type="text" class="form-control" name="arr_type_tu">
                <input id="arr_object_name" type="text" class="form-control" name="arr_object_name">
                <button type="submit" id="submit_button" class="btn btn-primary">
                    Сохранить
                </button>
    </form>

    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline-block; margin: 5px">Реестр заключений
                            экспертизы промышленной безопасности</h2>
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
                                    <div class="bat_info" style="display: inline-block"><a
                                            href="/docs/conclusions_industrial_safety_main"
                                            style="display: inline-block">Сброс фильтров</a>
                                    </div>
                                    @can('doc-create')
                                        <div class="bat_info" style="display: inline-block; margin-left: 0px"><a
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
                         style="height:68.5vh; padding: 0px; margin: 0px; overflow-y: auto">
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
                                <style>
                                    label {
                                        font: 14px 'Fira Sans', sans-serif;
                                    }
                                    .checkbox{
                                        float: left;
                                        width: 90%;
                                        text-align: left;
                                    }
                                    input{
                                        margin: 0.4rem;
                                    }
                                    fieldset{
                                        position: absolute; width: 250px; height: 500px; right: -240px; bottom: -510px; background-color: white; z-index: 30; padding: 3px; overflow-y: auto
                                    }
                                    .img{
                                        position: absolute; right: 0px; bottom: 0px; width: 20px; border: 2px solid white; border-radius: 2px; background-color: white
                                    }
                                    .img:hover{
                                        border: 2px solid darkgray;
                                    }
                                </style>
                                <thead>
                                <tr>
                                    <th rowspan="2" style="position: sticky; left: 2px; z-index: 20"
                                        onclick="sorted_table(0, this)">№ п/п
                                    </th>
                                    <th rowspan="2" style="position:sticky; left: 5.8%; z-index: 20"><p onclick="sorted_table(1, this.parentNode)">Наименование центра финансовой
                                            отвественности</p>
                                        <img class="img"  alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}" onclick="hide_all_field('fieldsheet_name_center'); if(document.getElementById('fieldsheet_name_center').style.display === 'none'){document.getElementById('fieldsheet_name_center').style.display = ''}else {document.getElementById('fieldsheet_name_center').style.display = 'none'}">
                                        <fieldset id="fieldsheet_name_center" style="display: none">
                                            <div class="doc_header" style="padding: 0px; width: 100%;  top: 0px; position: sticky">
                                                <input type="text" id="search_fieldsheet_name_center" placeholder="Поиск...">
                                                <div class="bat_add" style="margin-left: 0px;">
                                                    <a
                                                        onclick="get_data()"
                                                        style="display: inline-block; margin-left: 0px">Применить</a>
                                                    <a
                                                        onclick="checked('fieldsheet_name_center')"
                                                        style="display: inline-block; margin-left: 0px">Вкл/выкл все</a>
                                                </div>
                                            </div>

                                            @foreach($center as $row)
                                            <div class="checkbox">
                                                @if($row['in'])
                                                <input type="checkbox" class="checkbox_button" name="{{$row['center_name']}}" checked>
                                                @else
                                                <input type="checkbox" class="checkbox_button" name="{{$row['center_name']}}">
                                                @endif
                                                <label for="{{$row['center_name']}}">{{$row['center_name']}}</label>
                                            </div>
                                            @endforeach
                                        </fieldset>
                                    </th>
                                    <th rowspan="2"><p onclick="sorted_table(2, this.parentNode)">Наименование филиала</p>
                                        <img class="img"  alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}" onclick="hide_all_field('fieldsheet_name_do'); if(document.getElementById('fieldsheet_name_do').style.display === 'none'){document.getElementById('fieldsheet_name_do').style.display = ''}else {document.getElementById('fieldsheet_name_do').style.display = 'none'}">
                                        <fieldset id="fieldsheet_name_do" style="display: none">
                                            <div class="doc_header" style="padding: 0px; width: 100%;  top: 0px; position: sticky">
                                                <input type="text" id="search_fieldsheet_name_do" placeholder="Поиск...">
                                                <div class="bat_add" style="margin-left: 0px; top: 0px; position: sticky">
                                                    <a
                                                        onclick="get_data()"
                                                        style="display: inline-block; margin-left: 0px">Применить</a>
                                                    <a
                                                        onclick="checked('fieldsheet_name_do')"
                                                        style="display: inline-block; margin-left: 0px">Вкл/выкл все</a>
                                                </div>
                                            </div>
                                            @foreach($do as $row)
                                                <div class="checkbox">
                                                    @if($row['in'])
                                                        <input type="checkbox" class="checkbox_button" name="{{$row['name_do']}}" checked>
                                                    @else
                                                        <input type="checkbox" class="checkbox_button" name="{{$row['name_do']}}">
                                                    @endif
                                                    <label for="{{$row['name_do']}}">{{$row['name_do']}}</label>
                                                </div>
                                            @endforeach
                                        </fieldset>
                                    </th>
                                    <th rowspan="2"><p onclick="sorted_table(3, this.parentNode)">Вид ТУ, зданий и сооружений</p>
                                        <img class="img"  alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}" onclick="hide_all_field('fieldsheet_type_tu'); if(document.getElementById('fieldsheet_type_tu').style.display === 'none'){document.getElementById('fieldsheet_type_tu').style.display = ''}else {document.getElementById('fieldsheet_type_tu').style.display = 'none'}">
                                        <fieldset id="fieldsheet_type_tu" style="display: none">
                                            <div class="doc_header" style="padding: 0px; width: 100%;  top: 0px; position: sticky">
                                                <input type="text" id="search_fieldsheet_type_tu" placeholder="Поиск...">
                                                <div class="bat_add" style="margin-left: 0px">
                                                    <a
                                                        onclick="get_data()"
                                                        style="display: inline-block; margin-left: 0px">Применить</a>
                                                    <a
                                                        onclick="checked('fieldsheet_type_tu')"
                                                        style="display: inline-block; margin-left: 0px">Вкл/выкл все</a>
                                                </div>
                                            </div>

                                            @foreach($tu as $row)
                                                <div class="checkbox">
                                                    @if($row['in'])
                                                        <input type="checkbox" class="checkbox_button" name="{{$row['type_tu']}}" checked>
                                                    @else
                                                        <input type="checkbox" class="checkbox_button" name="{{$row['type_tu']}}">
                                                    @endif
                                                    <label for="{{$row['type_tu']}}">{{$row['type_tu']}}</label>
                                                </div>
                                            @endforeach
                                        </fieldset>
                                    </th>
                                    <th colspan="9">Место проведения ЭПБ</th>
                                    <th rowspan="2" onclick="sorted_table(13, this)">Дата ввода в эксплуатацию</th>
{{--                                    <th rowspan="2" onclick="sorted_table(14, this)">Дата проведения ЭПБ</th>--}}

                                    <th rowspan="2"><p onclick="sorted_table(14, this.parentNode)">Дата проведения ЭПБ</p>
                                        <img class="img"  alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}" onclick="hide_all_field('fieldsheet_date_epb'); if(document.getElementById('fieldsheet_date_epb').style.display === 'none'){document.getElementById('fieldsheet_date_epb').style.display = ''}else {document.getElementById('fieldsheet_date_epb').style.display = 'none'}">
                                        <fieldset id="fieldsheet_date_epb" style="display: none">
                                            <div class="doc_header" style="padding: 0px; width: 100%;  top: 0px; position: sticky">
                                                <input type="text" id="search_fieldsheet_date_epb" placeholder="Поиск...">
                                                <div class="bat_add" style="margin-left: 0px">
                                                    <a
                                                        onclick="get_data()"
                                                        style="display: inline-block; margin-left: 0px">Применить</a>
                                                    <a
                                                        onclick="checked('fieldsheet_date_epb')"
                                                        style="display: inline-block; margin-left: 0px">Вкл/выкл все</a>
                                                </div>
                                            </div>

                                            @foreach($date_epb as $row)
                                                <div class="checkbox">
                                                    @if($row['in'])
                                                        <input type="checkbox" class="checkbox_button" name="{{$row['date_epb']}}" checked>
                                                    @else
                                                        <input type="checkbox" class="checkbox_button" name="{{$row['date_epb']}}">
                                                    @endif
                                                    <label for="{{$row['date_epb']}}">{{$row['date_epb']}}</label>
                                                </div>
                                            @endforeach
                                        </fieldset>
                                    </th>


                                    <th colspan="2">Срок эксплуатации/ наработка на момент ЭПБ</th>
                                    <th colspan="2">Срок продления безопасной эксплуатации</th>
                                    <th colspan="2">Дата/наработка следующей ЭПБ</th>
                                    <th rowspan="2" onclick="sorted_table(21, this)">Уведомление о внесении в реестр (№
                                        письма,
                                        дата)
                                    </th>
                                    <th rowspan="2" onclick="sorted_table(22, this)">Регистрационный номер заключения
                                        ЭПБ
                                    </th>
                                    <th rowspan="2" onclick="sorted_table(23, this)">Наличие условий действий
                                        заключений
                                    </th>
                                    <th rowspan="2" onclick="sorted_table(24, this)">Факт выполнения условий</th>
                                    <th rowspan="2" onclick="sorted_table(25, this)" style="">Условия действия
                                        заключений
                                    </th>
                                    <th rowspan="2" onclick="sorted_table(26, this)">Срок выполнения условий</th>
                                    <th rowspan="2" onclick="sorted_table(27, this)">Приоритетность</th>
                                    <th rowspan="2" onclick="sorted_table(28, this)">Номер заключения ЭПБ подрядной
                                        организации
                                    </th>
                                    <th rowspan="2" onclick="sorted_table(29, this)">Наименование экспертной
                                        организации
                                    </th>
                                    @can('report-edit')
                                        <th rowspan="2" style="width: 1%"></th>
                                    @endcan
                                </tr>
                                <tr>
{{--                                    <th style="top:25px" onclick="sorted_table(4, this)">Наименование объекта</th>--}}


                                    <th style="top:25px"><p onclick="sorted_table(4, this.parentNode)">Наименование объекта</p>
                                        <img class="img"  alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}" onclick="hide_all_field('fieldsheet_object');if(document.getElementById('fieldsheet_object').style.display === 'none'){document.getElementById('fieldsheet_object').style.display = ''}else {document.getElementById('fieldsheet_object').style.display = 'none'}">
                                        <fieldset id="fieldsheet_object" style="display: none">
                                            <div class="doc_header" style="padding: 0px; width: 100%;  top: 0px; position: sticky">
                                                <input type="text" id="search_fieldsheet_object" placeholder="Поиск...">
                                                <div class="bat_add" style="margin-left: 0px; top: 0px; position: sticky">
                                                    <a
                                                        onclick="get_data()"
                                                        style="display: inline-block; margin-left: 0px">Применить</a>
                                                    <a
                                                        onclick="checked('fieldsheet_object')"
                                                        style="display: inline-block; margin-left: 0px">Вкл/выкл все</a>
                                                </div>
                                            </div>

                                            @foreach($object as $row)
                                                <div class="checkbox">
                                                    @if($row['in'])
                                                        <input type="checkbox" class="checkbox_button" name="{{$row['object_name']}}" checked>
                                                    @else
                                                        <input type="checkbox" class="checkbox_button" name="{{$row['object_name']}}">
                                                    @endif
                                                    <label for="{{$row['object_name']}}">{{$row['object_name']}}</label>
                                                </div>
                                            @endforeach
                                        </fieldset>
                                    </th>






                                    <th style="top:25px" onclick="sorted_table(5, this)">Наименов-е цеха/
                                        местонахождения
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(6, this)">№ цеха</th>
                                    <th style="top:25px" onclick="sorted_table(7, this)">Наименов-е ТУ, здания,
                                        сооружения
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(8, this)">Изготовитель/ проектная
                                        организация
                                    </th>
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
                                    <th style="top:25px" onclick="sorted_table(16, this)"> Кол-во лет ТУ, зданию,
                                        сооружению
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(17, this)">Наработка ТУ, часов
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(18, this)"> Кол-во лет ТУ, зданию,
                                        сооружению
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(19, this)">Наработка до следующего ЭПБ
                                    </th>
{{--                                    <th style="top:25px" onclick="sorted_table(20, this)"> Дата следующего ЭПБ--}}
{{--                                    </th>--}}
                                    <th style="top:25px"><p onclick="sorted_table(19, this.parentNode)">Дата следующего ЭПБ</p>
                                        <img class="img"  alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}" onclick="hide_all_field('fieldsheet_date_next_epb'); if(document.getElementById('fieldsheet_date_next_epb').style.display === 'none'){document.getElementById('fieldsheet_date_next_epb').style.display = ''}else {document.getElementById('fieldsheet_date_next_epb').style.display = 'none'}">
                                        <fieldset id="fieldsheet_date_next_epb" style="display: none">
                                            <div class="doc_header" style="padding: 0px; width: 100%;  top: 0px; position: sticky">
                                                <input type="text" id="search_fieldsheet_date_next_epb" placeholder="Поиск...">
                                                <div class="bat_add" style="margin-left: 0px; top: 0px; position: sticky">
                                                    <a
                                                        onclick="get_data()"
                                                        style="display: inline-block; margin-left: 0px">Применить</a>
                                                    <a
                                                        onclick="checked('fieldsheet_date_next_epb')"
                                                        style="display: inline-block; margin-left: 0px">Вкл/выкл все</a>
                                                </div>
                                            </div>
                                            @foreach($date_next_epb as $row)
                                                <div class="checkbox">
                                                    @if($row['in'])
                                                        <input type="checkbox" class="checkbox_button" name="{{$row['date_next_epb']}}" checked>
                                                    @else
                                                        <input type="checkbox" class="checkbox_button" name="{{$row['date_next_epb']}}">
                                                    @endif
                                                    <label for="{{$row['date_next_epb']}}">{{$row['date_next_epb']}}</label>
                                                </div>
                                            @endforeach
                                        </fieldset>
                                    </th>



                                </tr>
                                </thead>
                                <tbody id="body_table" style="">
                                @foreach($data_one as $key=>$data)
                                    <tr>
                                        <td style="text-align: center; position: sticky; left: 2px; background-color: white">{{$data->id}}</td>
                                        <td style="text-align: center; position: sticky; left: 5.8%; background-color: white">{{$data->center_name}}</td>
                                        <td style="text-align: center">{{$data->name_do}}</td>
                                        <td style="text-align: center">{{$data->type_tu}}</td>
                                        <td style="text-align: center">{{$data->object_name}}</td>
                                        <td style="text-align: center">{{$data->workshop_name}}</td>
                                        <td style="text-align: center">{{$data->n_workshop}}</td>
                                        <td style="text-align: center">{{$data->name_tu}}</td>
                                        <td style="text-align: center">{{$data->manufacturer}}</td>
                                        <td style="text-align: center">{{$data->station_number}}</td>
                                        <td style="text-align: center">{{$data->factory_num}}</td>
                                        <td style="text-align: center">{{$data->pipeline_length}}</td>

                                        <td style="text-align: center">{{$data->inv_tu_num}}</td>
                                        <td style="text-align: center">{{$data->date_comiss}}</td>
                                        <td style="text-align: center">{{$data->date_epb}}</td>
                                        <td style="text-align: center">{{$data->runtime_tu}}</td>
                                        <td style="text-align: center">{{$data->age_tu}}</td>
                                        <td style="text-align: center">{{$data->runtime_ext_tu}}</td>
                                        <td style="text-align: center">{{$data->age_ext_tu}}</td>
                                        <td style="text-align: center">{{$data->runtime_epb}}</td>
                                        <td style="text-align: center">{{$data->date_next_epb}}</td>
                                        <td style="text-align: center">{{$data->notification}}</td>
                                        <td style="text-align: center">{{$data->reg_num}}</td>
                                        <td style="text-align: center">{{$data->conditions}}</td>
                                        <td style="text-align: center">{{$data->completion_mark}}</td>
                                        <td style="text-align: center">{{$data->conditions_concl}}</td>
                                        <td style="text-align: center">{{$data->due_date}}</td>
                                        <td style="text-align: center">{{$data->priority}}</td>
                                        <td style="text-align: center">{{$data->concl_num}}</td>
                                        <td style="text-align: center">{{$data->exp_org_name}}</td>
                                        @can('report-edit')
                                            <td style="text-align: center; min-width: auto">
                                                <a href="#" onclick="edit_record({{$data->id}})"><img
                                                        style="width: 15px; height: 15px; margin: 3px" alt=""
                                                        src="{{asset('assets/images/icons/edit.svg')}}" class="check_i"></a>
                                                <a href="#" style="" onclick="remove_record({{$data->id}})"><img
                                                        style="opacity:1; width: 15px; height: 15px; margin: 3px" alt=""
                                                        src="{{asset('assets/images/icons/trash.svg')}}"
                                                        class="trash_i"></a>
                                            </td>  @endcan
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="height: 7vh">
                        <table class="table table-hover " style="width: border-box; margin-bottom: 0px; float: left; width: 100%">
                            <tbody>
                            <tr>
                                <td style="border-right: 0px"><p style="font-size: 18px">Всего записей:{{$i}}</p></td>
                                <td>  {{ $data_one->links() }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            @can('doc-create')
            // let excel = document.querySelector('.bat_info');
            // excel.firstChild.href = '/excel_conclusions_industrial_safety/' + document.getElementById('select__year').value;
            @endcan
            checked()
        })
        function hide_all_field(id){
            for(var field of document.getElementsByTagName('fieldset')){
                if (field.id !== id)
                field.style.display = 'none'
            }
        }
        function checked(id){
            if (id){
                var true_button = false
                var checkboxes = document.getElementById(id).getElementsByClassName('checkbox_button')
                for (var check of checkboxes){
                    if (check.hasAttribute('checked')){
                        true_button = true
                    }
                }
                if (true_button){
                    for (var check of checkboxes){
                        check.removeAttribute('checked')
                    }
                }else {
                    for (var check of checkboxes){
                        check.setAttribute('checked', true)
                    }
                }
            }else {
                for (var check of document.getElementsByClassName('checkbox_button')){
                    check.addEventListener('click', function(){
                        if (this.hasAttribute('checked')){
                            this.removeAttribute('checked')
                        }else {
                            this.setAttribute('checked', true)
                        }
                    })
                }
            }
        }
        function get_data() {
            var fieldsheet_name_center = document.getElementById('fieldsheet_name_center').getElementsByTagName('input')
            var arr_name_center = []
            var name_centre_check = true
            for(var row of fieldsheet_name_center){
                if (row.hasAttribute('checked')){
                    arr_name_center.push(row.getAttribute('name'))
                }else {
                    name_centre_check = false
                }
            }
            if (arr_name_center.length == 0 || name_centre_check){
                arr_name_center = 'all'
            }
            var fieldsheet_name_do = document.getElementById('fieldsheet_name_do').getElementsByTagName('input')
            var arr_name_do = []
            var name_do_check = true
            for(var row of fieldsheet_name_do){
                if (row.hasAttribute('checked')){
                    arr_name_do.push(row.getAttribute('name'))
                }else {
                    name_do_check = false
                }
            }
            if (arr_name_do.length == 0 || name_do_check ){
                arr_name_do = 'all'
            }
            var fieldsheet_type_tu = document.getElementById('fieldsheet_type_tu').getElementsByTagName('input')
            var arr_type_tu = []
            var type_tu_check = true
            for(var row of fieldsheet_type_tu){
                if (row.hasAttribute('checked')){
                    arr_type_tu.push(row.getAttribute('name'))
                }else {
                    type_tu_check = false
                }
            }
            if (arr_type_tu.length == 0 || type_tu_check){
                arr_type_tu = 'all'
            }
            var fieldsheet_object = document.getElementById('fieldsheet_object').getElementsByTagName('input')
            var arr_object_name = []
            var object_name_check = true
            for(var row of fieldsheet_object){
                if (row.hasAttribute('checked')){
                    arr_object_name.push(row.getAttribute('name'))
                }else {
                    object_name_check = false
                }
            }
            if (arr_object_name.length == 0 || object_name_check){
                arr_object_name = 'all'
            }
            var fieldsheet_date_epb = document.getElementById('fieldsheet_date_epb').getElementsByTagName('input')
            var arr_date_epb = []
            var date_epb_check = true
            for(var row of fieldsheet_date_epb){
                if (row.hasAttribute('checked')){
                    arr_date_epb.push(row.getAttribute('name'))
                }else {
                    date_epb_check = false
                }
            }
            if (date_epb_check.length == 0 || date_epb_check){
                arr_date_epb = 'all'
            }
            var fieldsheet_date_next_epb = document.getElementById('fieldsheet_date_next_epb').getElementsByTagName('input')
            var arr_date_next_epb = []
            var date_next_epb_check = true
            for(var row of fieldsheet_date_next_epb){
                if (row.hasAttribute('checked')){
                    arr_date_next_epb.push(row.getAttribute('name'))
                }else {
                    date_next_epb_check = false
                }
            }
            if (date_next_epb_check.length == 0 || date_next_epb_check){
                arr_date_next_epb = 'all'
            }

            document.getElementById('arr_date_epb').value = arr_date_epb
            document.getElementById('arr_date_next_epb').value = arr_date_next_epb
            document.getElementById('arr_object_name').value = arr_object_name
            document.getElementById('arr_name_center').value = arr_name_center
            document.getElementById('arr_name_do').value = arr_name_do
            document.getElementById('arr_type_tu').value = arr_type_tu
            document.getElementById('submit_button').click()

            // console.log(arr_name_center)
            // window.location.href = '/docs/conclusions_industrial_safety/' + arr_name_center+'/'+arr_name_do+'/'+arr_type_tu;
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
                th.style.background = '#FADADD'
                th.classList.remove('asc')
                th.classList.add('desc')
                var sorting = '<'
            } else if (class_list.contains('desc')) {
                th.style.background = ''
                th.classList.remove('desc')
                var sorting = false
            } else {
                th.style.background = '#00FF7F'
                th.classList.add('asc')
                var sorting = '>'
                6
            }
            if (sorting) {
                if (sorting === '>') {
                    let sortedRows = Array.from(table_for_search.rows)
                        .slice(2)
                        .sort((rowA, rowB) => rowA.cells[column].innerHTML > rowB.cells[column].innerHTML ? 1 : -1);
                    table_for_search.tBodies[0].append(...sortedRows);
                } else {
                    let sortedRows = Array.from(table_for_search.rows)
                        .slice(2)
                        .sort((rowA, rowB) => rowA.cells[column].innerHTML < rowB.cells[column].innerHTML ? 1 : -1);
                    table_for_search.tBodies[0].append(...sortedRows);
                }
            } else {
                let sortedRows = Array.from(table_for_search.rows)
                    .slice(2)
                    .sort((rowA, rowB) => Number(rowA.cells[0].innerHTML) > Number(rowB.cells[0].innerHTML) ? 1 : -1);
                table_for_search.tBodies[0].append(...sortedRows);
            }
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
        var input_f1 = document.getElementById('search_fieldsheet_name_center')
        input_f1.oninput = function () {
            setTimeout(find_field('fieldsheet_name_center'), 100);
        };
        var input_f2 = document.getElementById('search_fieldsheet_date_epb')
        input_f2.oninput = function () {
            setTimeout(find_field('fieldsheet_date_epb'), 100);
        };
        var input_f3 = document.getElementById('search_fieldsheet_date_next_epb')
        input_f3.oninput = function () {
            setTimeout(find_field('fieldsheet_date_next_epb'), 100);
        };
        var input_f4 = document.getElementById('search_fieldsheet_object')
        input_f4.oninput = function () {
            setTimeout(find_field('fieldsheet_object'), 100);
        };
        var input_f5 = document.getElementById('search_fieldsheet_name_do')
        input_f5.oninput = function () {
            setTimeout(find_field('fieldsheet_name_do'), 100);
        };
        var input_f6 = document.getElementById('search_fieldsheet_type_tu')
        input_f6.oninput = function () {
            setTimeout(find_field('fieldsheet_type_tu'), 100);
        };
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
            var check_full = false
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
                    check_full = true
                } else {
                    table_boby_rows[i].style.display = "none"
                }
            }
            if (!check_full){
                var tr = document.createElement('tr')
                tr.id = 'time_row'
                tr.innerHTML = '<td colspan="31" style="text-align: left">На данной странице ничего не найдено</td>'
                document.getElementById('table_for_search').getElementsByTagName('tbody')[0].appendChild(tr);
            }else {
                try{
                    document.getElementById('time_row').parentNode.removeChild(document.getElementById('time_row'))
                }catch (e){

                }
            }
        }
        function find_field(id) {
            var table_boby_rows = document.getElementById(id).getElementsByClassName('checkbox')  //строки по которым ищем
            console.log(table_boby_rows)
            var search_text = new RegExp(document.getElementById('search_'+id).value, 'i');   //искомый текст
            var check_full = false
            for (var i = 0; i < table_boby_rows.length; i++) {  //проходимся по строкам
                var flag_success = false   //станет true, если есть совпадение в строке
                var tds_row = table_boby_rows[i].getElementsByClassName('checkbox_button')   //ячейки строки
                console.log(tds_row)
                for (var j = 0; j < tds_row.length; j++) {   //проходимся по ячейкам
                    if (tds_row[j].getAttribute('name').match(search_text)) {
                        flag_success = true
                    }
                }
                if (flag_success) {
                    table_boby_rows[i].style.display = ""
                    check_full = true
                } else {
                    table_boby_rows[i].style.display = "none"
                }
            }
        }
    </script>

@endsection
