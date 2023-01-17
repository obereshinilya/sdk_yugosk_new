@extends('web.layouts.app')

@section('title')
    Отчеты
@endsection

@section('content')
    @include('web.include.sidebar_doc')
    @can('events-view')
        @include('web.admin.inc.new_JAS')
    @endcan
    <div style="height: 75.3vh">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h2 class="text-muted" style="text-align: center; display: inline-block">Результаты АПК </h2>
                        <select class="select-css" id="select__year" onchange="get_data()"
                                style="width: 9%; display: inline-block; margin-left: 1%">
                            @for($i=2015; $i<=2023; $i++)
                                <option value="{{$i}}">{{$i}} год</option>
                            @endfor
                        </select>
                        @can('doc-create')
                            <div class="bat_info" style="display: inline-block; margin-left: 0px"><a
                                    href="#"
                                    onclick="window.location.href = '/excel_result_apk/' + document.getElementById('select__year').value"
                                    style="display: inline-block">Экспорт в excel</a>
                            </div>
                            <div class="bat_info" style="display: inline-block; margin-left: 0px"><a
                                    href="#openModal"
                                    style="display: inline-block">Печать в pdf</a>
                            </div>
                        @endcan
                        @can('entries-add')
                            <div class="bat_add"
                                 style="float: right; display: inline-block; margin-right: 5%; margin-top: 25px; margin-left: 0">
                                <a href="/docs/result_apk/create">Добавить запись</a></div>
                        @endcan
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:75.5vh; padding-left: 0px; margin-top: 0px; width: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <div style="padding: 0px; margin: 0px; width: 100%; overflow: hidden">
                                <div class="statickTable" style="width: 30%; display: inline-block; float: left">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th style="position:sticky; top:0" id="id_do" colspan="2">Наименование
                                                филиала / дочернего общества
                                            </th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2">Проведено проверок II уровня АПК</th>
                                            <th id="level2_plan" style="text-align: center">План</th>
                                        </tr>
                                        <tr>
                                            <th id="level2_fact">Факт</th>
                                        </tr>
                                        <tr>
                                            <th id="level2_error" colspan="2">Количество выявленных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th id="level2_error_repiat" colspan="2">Количество типовых и повторяющихся
                                                нарушений
                                            </th>
                                        </tr>
                                        <tr>
                                            <th id="level2_check" colspan="2">Количество устраненных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th id="level2_percent" colspan="2">% устраненных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2">Проведено проверок III уровня АПК</th>
                                            <th id="level3_plan" style="text-align: center">План</th>
                                        </tr>
                                        <tr>
                                            <th id="level3_fact">Факт</th>
                                        </tr>
                                        <tr>
                                            <th id="level3_error" colspan="2">Количество выявленных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th id="level3_error_repiat" colspan="2">Количество типовых и повторяющихся
                                                нарушений
                                            </th>
                                        </tr>
                                        <tr>
                                            <th id="level3_check" colspan="2">Количество устраненных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th id="level3_percent" colspan="2">% устраненных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2">Проведено проверок IV-V уровня АПК</th>
                                            <th id="level4_plan" style="text-align: center">План</th>
                                        </tr>
                                        <tr>
                                            <th id="level4_fact">Факт</th>
                                        </tr>
                                        <tr>
                                            <th id="level4_error" colspan="2">Количество выявленных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th id="level4_error_repiat" colspan="2">Количество типовых и повторяющихся
                                                нарушений
                                            </th>
                                        </tr>
                                        <tr>
                                            <th id="level4_check" colspan="2">Количество устраненных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th id="level4_percent" colspan="2">% устраненных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th id="num_gaznadzor" colspan="2">Проведено проверок ООО «Газпром
                                                газнадзор»
                                            </th>
                                        </tr>
                                        <tr>
                                            <th id="gaznadzor_error" colspan="2">Количество выявленных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th id="gaznadzor_error_repiat" colspan="2">Количество типовых и
                                                повторяющихся нарушений
                                            </th>
                                        </tr>
                                        <tr>
                                            <th id="gaznadzor_check" colspan="2">Количество устраненных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th id="gaznadzor_check_late" colspan="2">Кол-во нарушений, не устраненных в
                                                установленные сроки
                                            </th>
                                        </tr>
                                        <tr>
                                            <th id="gaznadzor_percent" colspan="2">% устраненных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th id="num_rosteh" colspan="2">Проведено проверок Ростехнадзором</th>
                                        </tr>
                                        <tr>
                                            <th id="rosteh_error" colspan="2">Количество выявленных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th id="rosteh_error_repiat" colspan="2">Количество типовых и повторяющихся
                                                нарушений
                                            </th>
                                        </tr>
                                        <tr>
                                            <th id="rosteh_check" colspan="2">Количество устраненных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th id="rosteh_check_late" colspan="2">Кол-во нарушений, не устраненных в
                                                установленные сроки
                                            </th>
                                        </tr>
                                        <tr>
                                            <th id="rosteh_percent" colspan="2">% устраненных нарушений</th>
                                        </tr>
                                        <tr>
                                            <th rowspan="4">Индикативные показатели</th>
                                            <th id="ind_graph" style="text-align: center">Выполнение графика АПК</th>
                                        </tr>
                                        <tr>
                                            <th id="ind_repiat_apk">Типовые/повторяющиеся нарушения АПК</th>
                                        </tr>
                                        <tr>
                                            <th id="ind_repiat_gaznadzor">Типовые/повторяющиеся нарушения корп.
                                                контроль
                                            </th>
                                        </tr>
                                        <tr>
                                            <th id="ind_rosteh">Типовые/повторяющиеся нарушения РТН</th>
                                        </tr>
                                        @can('report-edit')
                                            <tr>
                                                <th id="tr_del_edit" style="padding: 0px" colspan="2"></th>
                                            </tr>
                                        @endcan
                                        </thead>
                                    </table>
                                </div>
                                <div class="dynamicTable" style="width: 70%; display: inline-block; overflow: auto">
                                    <table style="width: auto">
                                        <tbody id="body_table" style="white-space: nowrap">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="openModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#close" class="close">×</a>
                </div>
                <div class="modal-body">
                    <table class="modal_table map_hover">
                        <tbody>
                        <tr>
                            <td><select class="select-css" id="select__print" onchange="get_print()"
                                        style="display: inline-block; margin-left: 2%">
                                    <option value="apk">проверки АПК</option>
                                    <option value="gazprom">проверки ООО «Газпром газнадзор»</option>
                                    <option value="rostech">проверки Ростехнадзор</option>
                                </select>
                            </td>
                            <td>
                                <div class="bat_info print__pdf" style="display: inline-block"><a
                                        href="#openModal"
                                        style="display: inline-block">Печать</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var date = new Date();
            document.getElementById('select__year').value = date.getFullYear()
            let pdf = document.querySelector('.print__pdf');
            pdf.firstChild.href = /pdf_result_apk/ + document.getElementById('select__year').value + '/' + document.getElementById('select__print').value;

            get_data()
        })

        function get_print() {
            let pdf = document.querySelector('.print__pdf');
            pdf.firstChild.href = /pdf_result_apk/ + document.getElementById('select__year').value + '/' + document.getElementById('select__print').value;
        }

        function get_data() {
            $.ajax({
                url: '/docs/get_result_apk/' + document.getElementById('select__year').value,
                type: 'GET',
                success: (res) => {
                    var table_body = document.getElementById('body_table')
                    table_body.innerText = ''
                    for (var key of Object.keys(res)) {
                        var num_record = Object.keys(res['id']).length
                        if (key !== 'id' && key !== 'year') {
                            var tr = document.createElement('tr')
                            var height = document.getElementById(key).clientHeight
                            for (var j = 1; j <= num_record; j++) {
                                // if (!res[key][j]){
                                //     res[key][j] = ' '
                                // }
//console.log(key)
//				if(key == 'name_DO'){
//tr.innerHTML += `<td style="height: ${height}px; padding-top: 0px; padding-bottom: 0px; position:sticky; top:90px">${res[key][j]}</td>`
//				}else{
                                tr.innerHTML += `<td style="height: ${height}px; padding-top: 0px; padding-bottom: 0px; ">${res[key][j]}</td>`
//				}
                            }
                            table_body.appendChild(tr)
                        }
                    }
                    var tr_edit_remove = document.createElement('tr')
                    tr_edit_remove.id = 'new_tr_remove'
                    tr_edit_remove.innerHTML = ''
                    for (var j = 1; j <= num_record; j++) {
                        tr_edit_remove.innerHTML += ` @can('report-edit')<td style="text-align: center; min-width: auto">
                    <a href="#" onclick="edit_record(${res['id'][j]})"><img style="opacity:1; width: 15px; height: 15px; margin: 3px; margin-left: 40px"  alt="" src="{{asset('assets/images/icons/edit.svg')}}" class="check_i"></a>
                    <a href="#" style="" onclick="remove_record(${res['id'][j]})"><img style="opacity:1; width: 15px; height: 15px; margin: 3px; margin-left: 10px"  alt="" src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i"></a>
                    </td> @endcan`
                    }
                    table_body.appendChild(tr_edit_remove)
                    document.getElementById('tr_del_edit').style.height = (document.getElementById('new_tr_remove').clientHeight - 1) + 'px'
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
                url: '/docs/result_apk/remove/' + id,
                type: 'GET',
                success: (res) => {
                    window.location.href = '/docs/result_apk'
                }
            })
        }

        //скрипт для изменения
        function edit_record(id) {
            window.location.href = '/docs/result_apk/edit/' + id
        }
    </script>
    <style>
        .form51 table tr td:last-of-type {
            padding: 10px 15px;
            min-width: auto;
            border-right: 1px solid #ececec;
        }
    </style>
@endsection


