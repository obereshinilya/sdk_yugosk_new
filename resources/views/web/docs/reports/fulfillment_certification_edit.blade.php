@extends('web.layouts.app')
@section('title')
    Редактирование
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
                        <h2 class="text-muted" style="text-align: center">Редактирование записи в выполнение
                            плана-графика
                            аттестации в области промышленной безопасности</h2>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:77.5vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <col style="width: 10%">
                                <col style="width: 20%">
                                <col style="width: 20%">
                                <col style="width: 50%">
                                <thead>
                                <tr>
                                    <th colspan="3" style="text-align: center">Наименование</th>
                                    <th style="text-align: center">Содержание</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th colspan="3">Наименование филиала общества</th>
                                    <td style="padding: 0px"><select id="id_do" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option
                                                value="{{$data->id_do}}">{{\App\Models\Main_models\RefDO::where('id_do',$data->id_do)->value('short_name_do')}}</option>
                                            @foreach($do as $row)
                                                @if($row->id_do==$data->id_do)
                                                    @continue
                                                @else
                                                    <option
                                                        value="{{$row->id_do}}">{{$row->short_name_do}}</option>
                                                @endif
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th rowspan="5">Руководители и члены ЦЭК ДО</th>
                                    <th rowspan="3">Аттестация по промышленной безопасности в Ростехнадзоре (чел.)</th>
                                    <th>всего</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="rostech_cec" value="{{$data->rostech_cec}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">план</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="rostech_cec_plan"
                                                                    value="{{$data->rostech_cec_plan}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">факт</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="rostech_cec_fact"
                                                                    value="{{$data->rostech_cec_fact}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="2">Повышение квалификации, чел</th>
                                    <th id="">план</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="skills_up_cec_plan"
                                                                    value="{{$data->skills_up_cec_plan}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">факт</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="skills_up_cec_fact"
                                                                    value="{{$data->skills_up_cec_fact}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="8">Работники администрации ДО</th>
                                    <th rowspan="3">Аттестация по промышленной безопасности в Ростехнадзоре (чел.)</th>
                                    <th>всего</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="rostech_adm_do"
                                                                    value="{{$data->rostech_adm_do}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>план</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="rostech_adm_do_plan"
                                                                    value="{{$data->rostech_adm_do_plan}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>факт</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="rostech_adm_do_fact"
                                                                    value="{{$data->rostech_adm_do_fact}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="3">Аттестация по промышленной безопасности с использованием ИС
                                        ЕПТ(чел.)
                                    </th>
                                    <th>всего</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="is_ept_adm_do" value="{{$data->is_ept_adm_do}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>план</th>
                                    <td style="padding: 0px"><input type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="is_ept_adm_do_plan"
                                                                    value="{{$data->is_ept_adm_do_plan}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>факт</th>
                                    <td style="padding: 0px"><input type="number" min="0" step="1"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="is_ept_adm_do_fact"
                                                                    value="{{$data->is_ept_adm_do_fact}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="2">Повышение квалификации по ОТ, чел</th>
                                    <th>план</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="ot_adm_do_plan"
                                                                    value="{{$data->ot_adm_do_plan}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>факт</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="ot_adm_do_fact"
                                                                    value="{{$data->ot_adm_do_fact}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="5">Руководители и члены ЭК филиалов</th>
                                    <th rowspan="3">Аттестация по промышленной безопасности (чел.)</th>
                                    <th>всего</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="pb_ec" value="{{$data->pb_ec}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>план</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="pb_ec_plan" value="{{$data->pb_ec_plan}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>факт</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="pb_ec_fact" value="{{$data->pb_ec_fact}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="2">Повышение квалификации, чел</th>
                                    <th>план</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="skills_up_ec_plan"
                                                                    value="{{$data->skills_up_ec_plan}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>факт</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="skills_up_ec_fact"
                                                                    value="{{$data->skills_up_ec_fact}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="8">Работники филиалов ДО</th>
                                    <th rowspan="3">Аттестация по промышленной безопасности в Ростехнадзоре (чел.)</th>
                                    <th>всего</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="rostech_do" value="{{$data->rostech_do}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>план</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="rostech_do_plan"
                                                                    value="{{$data->rostech_do_plan}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>факт</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="rostech_do_fact"
                                                                    value="{{$data->rostech_do_fact}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="3">Аттестация по промышленной безопасности с использованием ИС
                                        ЕПТ(чел.)
                                    </th>
                                    <th>всего</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="is_ept_do" value="{{$data->is_ept_do}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>план</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="is_ept_do_plan"
                                                                    value="{{$data->is_ept_do_plan}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>факт</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="is_ept_do_fact"
                                                                    value="{{$data->is_ept_do_fact}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="2">Повышение квалификации по ПБ, чел</th>
                                    <th>план</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="pb_do_plan" value="{{$data->pb_do_plan}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>факт</th>
                                    <td style="padding: 0px"><input type="number" style="height: 100%; width: 95%"
                                                                    min="0" step="1"
                                                                    class="text-field__input"
                                                                    id="pb_do_fact" value="{{$data->pb_do_fact}}">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a href="#" onclick="update()">Сохранить</a></div>
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a style="background-color: #CD5C5C"
                                       href="/docs/fulfillment_certification">Отменить</a>
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

        function update() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var params = ['id_do', 'rostech_cec', 'rostech_cec_plan', 'rostech_cec_fact', 'skills_up_cec_plan', 'skills_up_cec_fact', 'rostech_adm_do', 'rostech_adm_do_plan', 'rostech_adm_do_fact', 'is_ept_adm_do', 'is_ept_adm_do_plan', 'is_ept_adm_do_fact', 'ot_adm_do_plan', 'ot_adm_do_fact', 'pb_ec', 'pb_ec_plan', 'pb_ec_fact', 'skills_up_ec_plan', 'skills_up_ec_fact', 'rostech_do', 'rostech_do_plan', 'rostech_do_fact', 'is_ept_do', 'is_ept_do_plan', 'is_ept_do_fact', 'pb_do_plan', 'pb_do_fact']
            var out_data = []
            for (var param of params) {
                var value = document.getElementById(param).value

                out_data[param] = value

            }

            $.ajax({
                url: '/docs/fulfillment_certification/update/{{$data->id}}',
                type: 'POST',
                data: {
                    keys: JSON.stringify(Object.keys(out_data)),
                    values: JSON.stringify(Object.values(out_data))
                },
                success: (res) => {

                    // console.log(res)
                    window.location.href = '/docs/fulfillment_certification'


                }
            })

        }
    </script>

@endsection
