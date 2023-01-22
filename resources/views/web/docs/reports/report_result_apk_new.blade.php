@extends('web.layouts.app')
@section('title')
    Создание
@endsection

@section('content')
    {{--    Включаем всплывашку с новым сообщением о событии--}}
    @can('events-view')
        @include('web.admin.inc.new_JAS')
    @endcan
    @include('web.include.sidebar_doc')

    <div class="inside_content">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h2 class="text-muted" style="text-align: center">Добавление записи в результаты АПК,
                            корпоративного контроля и государственного надзора</h2>
                    </div>

                    <div class="inside_tab_padding form51"
                         style="height:77.5vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <col style="width: 5%">
                                <col style="width: 15%">
                                <col style="width: 20%">
                                <col style="width: 60%">
                                <thead>
                                <tr>
                                    <th colspan="3" style="text-align: center">Наименование</th>
                                    <th style="text-align: center">Содержание</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th colspan="3">Год</th>
                                    <td style="padding: 0px"><select class="select-css" id="year"
                                                                     style="height: 100%; width: 20%">
                                            @for($i=2015; $i<=2023; $i++)
                                                <option value="{{$i}}">{{$i}} год</option>
                                            @endfor
                                        </select></td>
                                </tr>
                                <tr>
                                    <th colspan="3">Наименование филиала / дочернего общества</th>
                                    <td style="padding: 0px"><select id="id_do" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            @foreach($do as $row)
                                                <option value="{{$row->id_do}}">{{$row->short_name_do}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th rowspan="5">1</th>
                                    <th rowspan="2">Проведено проверок II уровня АПК</th>
                                    <th style="text-align: center">План</th>
                                    <td style="padding: 0px"><input id="level2_plan" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">Факт</th>
                                    <td style="padding: 0px"><input id="level2_fact" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество выявленных нарушений</th>
                                    <td style="padding: 0px"><input id="level2_error" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество типовых и повторяющихся нарушений</th>
                                    <td style="padding: 0px"><input id="level2_error_repiat" type="number" min="0"
                                                                    step="1" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество устраненных нарушений</th>
                                    <td style="padding: 0px"><input id="level2_check" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="5">2</th>
                                    <th rowspan="2">Проведено проверок III уровня АПК</th>
                                    <th id="" style="text-align: center">План</th>
                                    <td style="padding: 0px"><input id="level3_plan" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">Факт</th>
                                    <td style="padding: 0px"><input id="level3_fact" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество выявленных нарушений</th>
                                    <td style="padding: 0px"><input id="level3_error" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество типовых и повторяющихся нарушений</th>
                                    <td style="padding: 0px"><input id="level3_error_repiat" type="number" min="0"
                                                                    step="1" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество устраненных нарушений</th>
                                    <td style="padding: 0px"><input id="level3_check" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="5">3</th>
                                    <th rowspan="2">Проведено проверок IV-V уровня АПК</th>
                                    <th id="" style="text-align: center">План</th>
                                    <td style="padding: 0px"><input id="level4_plan" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">Факт</th>
                                    <td style="padding: 0px"><input id="level4_fact" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество выявленных нарушений</th>
                                    <td style="padding: 0px"><input id="level4_error" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество типовых и повторяющихся нарушений</th>
                                    <td style="padding: 0px"><input id="level4_error_repiat" type="number" min="0"
                                                                    step="1" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество устраненных нарушений</th>
                                    <td style="padding: 0px"><input id="level4_check" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="5">4</th>
                                    <th id="" colspan="2">Проведено проверок ООО «Газпром газнадзор»</th>
                                    <td style="padding: 0px"><input id="num_gaznadzor" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество выявленных нарушений</th>
                                    <td style="padding: 0px"><input id="gaznadzor_error" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество типовых и повторяющихся нарушений</th>
                                    <td style="padding: 0px"><input id="gaznadzor_error_repiat" type="number" min="0"
                                                                    step="1" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество устраненных нарушений</th>
                                    <td style="padding: 0px"><input id="gaznadzor_check" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Кол-во нарушений, не устраненных в установленные сроки</th>
                                    <td style="padding: 0px"><input id="gaznadzor_check_late" type="number" min="0"
                                                                    step="1" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="5">5</th>
                                    <th id="" colspan="2">Проведено проверок Ростехнадзором</th>
                                    <td style="padding: 0px"><input id="num_rosteh" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество выявленных нарушений</th>
                                    <td style="padding: 0px"><input id="rosteh_error" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество типовых и повторяющихся нарушений</th>
                                    <td style="padding: 0px"><input id="rosteh_error_repiat" type="number" min="0"
                                                                    step="1" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Количество устраненных нарушений</th>
                                    <td style="padding: 0px"><input id="rosteh_check" type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Кол-во нарушений, не устраненных в установленные сроки</th>
                                    <td style="padding: 0px"><input id="rosteh_check_late" type="number" min="0"
                                                                    step="1" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a href="#" onclick="save()">Сохранить</a></div>
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a style="background-color: #CD5C5C" href="/docs/result_apk">Отменить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function test() {
            var date = new Date();
            document.getElementById('year').value = date.getFullYear()
        })

        function save() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var params = ['id_do', 'level2_plan', 'level2_fact', 'level2_error', 'level2_error_repiat', 'level2_check',
                'level3_plan', 'level3_fact', 'level3_error', 'level3_error_repiat', 'level3_check',
                'level4_plan', 'level4_fact', 'level4_error', 'level4_error_repiat', 'level4_check',
                'gaznadzor_check_late', 'gaznadzor_check', 'gaznadzor_error_repiat', 'gaznadzor_error', 'num_gaznadzor',
                'rosteh_check_late', 'rosteh_check', 'rosteh_error_repiat', 'rosteh_error', 'num_rosteh', 'year']
            var out_data = []
            var check_data = true
            for (var param of params) {
                var value = document.getElementById(param).value
                if (value) {
                    out_data[param] = value
                } else {
                    check_data = false
                }
            }
            if (check_data) {
                $.ajax({
                    url: '/docs/result_apk/save',
                    type: 'POST',
                    data: {
                        keys: JSON.stringify(Object.keys(out_data)),
                        values: JSON.stringify(Object.values(out_data))
                    },
                    success: (res) => {
                        if (typeof res === 'object') {
                            alert('Для указанного ДО уже есть запись для выбранного года!')
                        } else {
                            // console.log(res)
                            // window.location.href = '/docs/result_apk'
                        }

                    }
                })
            } else {
                alert('Не все поля заполнены!')
            }
        }

    </script>

@endsection
