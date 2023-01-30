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
    <form method="POST" style="display: none" action="{{ route('open_conclusions_industrial_safety') }}">
        @csrf
        <div id="post_form">

            <button type="submit" id="submit_button" class="btn btn-primary">
                Сохранить
            </button>
        </div>

    </form>

    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline-block; margin: 5px">Реестр
                            заключений
                            экспертизы промышленной безопасности</h2>
                    </div>
                    <div class="doc_header" style="padding-bottom: 6px">
                        <table>
                            <tbody>
                            <tr>
                                <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}">
                                </td>
                                <td><input type="text" id="search_text" oninput="find_it()"
                                           placeholder="Первый фильтр..."></td>
                                <td><input type="text" id="search_text_Second" oninput="find_it()"
                                           placeholder="Второй фильтр..."></td>
                                <td><input type="text" id="search_text_third" oninput="find_it()"
                                           placeholder="Третий фильтр..."></td>
                                <td>
                                    <div class="bat_info" style="display: inline-block"><a
                                            href="/docs/conclusions_industrial_safety_main"
                                            style="display: inline-block">Сброс фильтров</a>
                                    </div>
                                    @can('doc-create')
                                        <div class="bat_info" style="display: inline-block; margin-left: 0px"><a
                                                href="/excel_conclusions_industrial_safety_main"
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

                                    .checkbox {
                                        float: left;
                                        width: 90%;
                                        text-align: left;
                                    }

                                    input {
                                        margin: 0.4rem;
                                    }

                                    fieldset {
                                        position: absolute;
                                        width: 250px;
                                        height: 500px;
                                        right: -240px;
                                        bottom: -510px;
                                        background-color: white;
                                        z-index: 30;
                                        padding: 3px;
                                        overflow-y: auto
                                    }

                                    .img {
                                        position: absolute;
                                        right: 0px;
                                        bottom: 0px;
                                        width: 20px;
                                        border: 2px solid white;
                                        border-radius: 2px;
                                        background-color: white
                                    }

                                    .img:hover {
                                        border: 2px solid darkgray;
                                    }
                                </style>
                                <thead>
                                <tr>
                                    <th rowspan="2" style="position: sticky; left: 2px; z-index: 20"
                                        onclick="sorted_table(0, this)">№ п/п
                                    </th>
                                    <th rowspan="2" style="position:sticky; left: 5.8%; z-index: 20"><p
                                            onclick="sorted_table(1, this.parentNode)">Наименование центра финансовой
                                            отвественности</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('center_name', this.parentNode); hide_all_field('fieldsheet_center_name')">
                                    </th>
                                    <th rowspan="2" style="position:sticky; left: 16.7%; z-index: 20"><p
                                            onclick="sorted_table(2, this.parentNode)">Наименование филиала</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('name_do', this.parentNode); hide_all_field('fieldsheet_name_do')">
                                    </th>
                                    <th rowspan="2"><p onclick="sorted_table(3, this.parentNode)">Вид ТУ, зданий и
                                            сооружений</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('type_tu', this.parentNode); hide_all_field('fieldsheet_type_tu')">
                                    </th>
                                    <th colspan="9">Место проведения ЭПБ</th>
                                    <th rowspan="2"><p onclick="sorted_table(13, this)">Дата ввода в эксплуатацию</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('date_comiss', this.parentNode); hide_all_field('fieldsheet_date_comiss')">
                                    </th>

                                    <th rowspan="2"><p onclick="sorted_table(14, this.parentNode)">Дата проведения
                                            ЭПБ</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('date_epb', this.parentNode); hide_all_field('fieldsheet_date_epb')">
                                    </th>

                                    <th colspan="2">Срок эксплуатации/ наработка на момент ЭПБ</th>
                                    <th colspan="2">Срок продления безопасной эксплуатации</th>
                                    <th colspan="2">Дата/наработка следующей ЭПБ</th>
                                    <th rowspan="2"><p onclick="sorted_table(21, this)">Уведомление о внесении в реестр
                                            (№
                                            письма,
                                            дата) </p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('notification', this.parentNode); hide_all_field('fieldsheet_notification')">
                                    </th>
                                    <th rowspan="2"><p onclick="sorted_table(22, this)">Регистрационный номер заключения
                                            ЭПБ </p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('reg_num', this.parentNode); hide_all_field('fieldsheet_reg_num')">
                                    </th>
                                    <th rowspan="2"><p onclick="sorted_table(23, this)">Наличие условий действий
                                            заключений </p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('conditions', this.parentNode); hide_all_field('fieldsheet_conditions')">
                                    </th>
                                    <th rowspan="2"><p onclick="sorted_table(24, this)">Факт выполнения условий</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('completion_mark', this.parentNode); hide_all_field('fieldsheet_completion_mark')">
                                    </th>
                                    <th rowspan="2" style=""><p onclick="sorted_table(25, this)">Условия действия
                                            заключений</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('conditions_concl', this.parentNode); hide_all_field('fieldsheet_conditions_concl')">
                                    </th>
                                    <th rowspan="2"><p onclick="sorted_table(26, this)">Срок выполнения условий</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('due_date', this.parentNode); hide_all_field('fieldsheet_due_date')">
                                    </th>
                                    <th rowspan="2"><p onclick="sorted_table(27, this)">Приоритетность</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('priority', this.parentNode); hide_all_field('fieldsheet_priority')">
                                    </th>
                                    <th rowspan="2"><p onclick="sorted_table(28, this)">Номер заключения ЭПБ подрядной
                                            организации </p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('concl_num', this.parentNode); hide_all_field('fieldsheet_concl_num')">
                                    </th>
                                    <th rowspan="2"><p onclick="sorted_table(29, this)">Наименование экспертной
                                            организации </p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('exp_org_name', this.parentNode); hide_all_field('fieldsheet_exp_org_name')">
                                    </th>
                                    @can('report-edit')
                                        <th rowspan="2" style="width: 1%"></th>
                                    @endcan
                                </tr>
                                <tr>
                                    <th style="top:25px"><p onclick="sorted_table(4, this.parentNode)">Наименование
                                            объекта</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('object_name', this.parentNode); hide_all_field('fieldsheet_object_name')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(5, this)">Наименов-е цеха/
                                            местонахождения</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('workshop_name', this.parentNode); hide_all_field('fieldsheet_workshop_name')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(6, this)">№ цеха</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('n_workshop', this.parentNode); hide_all_field('fieldsheet_n_workshop')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(7, this)">Наименов-е ТУ, здания,
                                            сооружения</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('name_tu', this.parentNode); hide_all_field('fieldsheet_name_tu')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(8, this)">Изготовитель/ проектная
                                            организация</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('manufacturer', this.parentNode); hide_all_field('fieldsheet_manufacturer')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(9, this)"> Станц-й номер, рег.№,
                                            участок
                                            (км-км)</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('station_number', this.parentNode); hide_all_field('fieldsheet_station_number')">
                                    </th>
                                    <th style="top:25px" onclick="sorted_table(10, this)"><p
                                            onclick="sorted_table(10, this)">Зав. №</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('factory_num', this.parentNode); hide_all_field('fieldsheet_factory_num')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(11, this)">Протяженность газопровода,
                                            км,
                                            кол-во, шт.</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('pipeline_length', this.parentNode); hide_all_field('fieldsheet_pipeline_length')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(12, this)">Инв.
                                            №ТУ, здания, сооружения</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('inv_tu_num', this.parentNode); hide_all_field('fieldsheet_inv_tu_num')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(15, this)">Наработка ТУ, часов</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('runtime_tu', this.parentNode); hide_all_field('fieldsheet_runtime_tu')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(16, this)">Кол-во лет ТУ, зданию,
                                            сооружению</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('age_tu', this.parentNode); hide_all_field('fieldsheet_age_tu')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(17, this)">Наработка ТУ, часов</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('runtime_ext_tu', this.parentNode); hide_all_field('fieldsheet_runtime_ext_tu')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(18, this)">Кол-во лет ТУ, зданию,
                                            сооружению</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('age_ext_tu', this.parentNode); hide_all_field('fieldsheet_age_ext_tu')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(19, this)">Наработка до следующего
                                            ЭПБ</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('runtime_epb', this.parentNode); hide_all_field('fieldsheet_runtime_epb')">
                                    </th>
                                    <th style="top:25px"><p onclick="sorted_table(20, this.parentNode)">Дата следующего
                                            ЭПБ</p>
                                        <img class="img" alt=""
                                             src="{{asset('assets/images/icons/arrow_bottom.svg')}}"
                                             onclick="get_group_conclusion('date_next_epb', this.parentNode); hide_all_field('fieldsheet_date_next_epb')">
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="body_table" style="">
                                @foreach($data_one as $key=>$data)
                                    <tr>
                                        <td style="text-align: center; position: sticky; left: 2px; background-color: white">{{$data->id}}</td>
                                        <td style="text-align: center; position: sticky; left: 5.8%; background-color: white">{{$data->center_name}}</td>
                                        <td style="text-align: center; position: sticky; left: 16.7%; background-color: white">{{$data->name_do}}</td>
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
                        <table class="table table-hover "
                               style="width: border-box; margin-bottom: 0px; float: left; width: 100%">
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
            checked()
        })

        function get_group_conclusion(column, th) {
            if (!document.getElementById('fieldsheet_' + column)) {
                let params = {};
                let fieldsheets = document.getElementsByTagName('fieldset');
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
                    params[fieldsheet.id.replace('fieldsheet_', '')] = check_input.join(',');
                }
                console.log(params)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/get_group_conclusion/' + column,
                    type: 'POST',
                    data: params,
                    success: (res) => {
                        var fieldset = document.createElement('fieldset')
                        fieldset.id = 'fieldsheet_' + column
                        fieldset.innerHTML += `<div class="doc_header" style="padding: 0px; width: 100%;  top: 0px; position: sticky">
                                                <input type="text" id="search_fieldsheet_${column}" style="margin: 9px 0px" placeholder="Поиск..." oninput="find_field('fieldsheet_${column}')">
                                                <div class="bat_add" style="margin-left: 0px;">
                                                    <a
                                                        onclick="get_data()"
                                                        style="display: inline-block; margin-left: 0px">Применить</a>
                                                    <a
                                                        onclick="checked('fieldsheet_${column}')"
                                                        style="display: inline-block; margin-left: 0px">Вкл/выкл все</a>
                                                </div>
                                            </div>`
                        for (var row of res) {
                            fieldset.innerHTML += `<div class="checkbox">
                                            <input type="checkbox" class="checkbox_button" name="${row[column]}" checked>
                                            <label for="${row[column]}">${row[column]}</label>
                                         </div>`
                        }
                        th.appendChild(fieldset)
                        checked()
                    }
                })
            }
        }

        function hide_all_field(id) {
            for (var field of document.getElementsByTagName('fieldset')) {
                if (field.id == id) {
                    if (field.style.display === 'none') {
                        field.style.display = ''
                    } else {
                        field.style.display = 'none'
                    }
                } else {
                    field.style.display = 'none'
                }
            }
        }

        function checked(id) {
            if (id) {
                var true_button = false
                var checkboxes = document.getElementById(id).getElementsByClassName('checkbox_button')
                for (var check of checkboxes) {
                    if (check.hasAttribute('checked')) {
                        true_button = true
                    }
                }
                if (true_button) {
                    for (var check of checkboxes) {
                        check.removeAttribute('checked')
                    }
                } else {
                    for (var check of checkboxes) {
                        check.setAttribute('checked', true)
                    }
                }
            } else {
                for (var check of document.getElementsByClassName('checkbox_button')) {
                    check.addEventListener('click', function () {
                        if (this.hasAttribute('checked')) {
                            this.removeAttribute('checked')
                        } else {
                            this.setAttribute('checked', true)
                        }
                    })
                }
            }
        }


        function get_data() {
            var fieldsheets = document.getElementsByTagName('fieldset')
            var post_form = document.getElementById('post_form')
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
                var input_form = document.createElement('input')
                input_form.name = fieldsheet.id.replace('fieldsheet_', '')
                input_form.type = 'text'
                input_form.value = check_input
                post_form.appendChild(input_form)
            }
            document.getElementById('submit_button').click()
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
            if (!check_full) {
                var tr = document.createElement('tr')
                tr.id = 'time_row'
                tr.innerHTML = '<td colspan="31" style="text-align: left">На данной странице ничего не найдено</td>'
                document.getElementById('table_for_search').getElementsByTagName('tbody')[0].appendChild(tr);
            } else {
                try {
                    document.getElementById('time_row').parentNode.removeChild(document.getElementById('time_row'))
                } catch (e) {

                }
            }
        }

        function find_field(id) {
            var table_boby_rows = document.getElementById(id).getElementsByClassName('checkbox')  //строки по которым ищем
            var search_text = new RegExp(document.getElementById('search_' + id).value, 'i');   //искомый текст
            var check_full = false
            for (var i = 0; i < table_boby_rows.length; i++) {  //проходимся по строкам
                var flag_success = false   //станет true, если есть совпадение в строке
                var tds_row = table_boby_rows[i].getElementsByClassName('checkbox_button')   //ячейки строки
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
