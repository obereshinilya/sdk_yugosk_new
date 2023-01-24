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
                        <h2 class="text-muted" style="text-align: center">Добавление сведений о составе ОПО</h2>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:70vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <col style="width: 30%">
                                <col style="width: 70%">
                                <thead>
                                <tr>
                                    <th style="text-align: center">Наименование</th>
                                    <th style="text-align: center">Содержание</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th style="text-align: center">№ п/п</th>
                                    <td style="padding: 0px"><input type="text" id="number_pp"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наименование площадки, участка, цеха, здания, сооружения, входящих в состав ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="name_sites"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Краткая характеристика опасности</th>
                                    <td style="padding: 0px"><input type="text" id="brief_description"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наименование опасного вещества</th>
                                    <td style="padding: 0px"><input type="text" id="name_substance"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Проектные (эксплуатационные) характеристики технических устройств</th>
                                    <td style="padding: 0px"><input type="text" id="operational_character"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Числовое обозначение признака опасности</th>
                                    <td style="padding: 0px"><input type="text" id="numerical_designation"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a href="#" onclick="save()">Сохранить</a></div>
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a style="background-color: #CD5C5C" href="/docs/opo">Отменить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function save() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var params = [
                'id_add_info_opo', 'full_name_opo', 'type_name', 'section_number', 'address_opo', 'oktmo', 'date_commiss',
                'full_name_legal_entity', 'inn', 'chk_2_1', 'chk_2_2', 'chk_2_1_a',
                'chk_2_1_b', 'chk_2_1_v', 'chk_2_3', 'chk_2_4', 'chk_2_5', 'chk_2_6', 'chk_3_1', 'chk_3_2', 'chk_3_3', 'chk_3_4',
                'chk_4_1', 'chk_4_2', 'chk_4_3', 'chk_4_4', 'chk_4_5', 'chk_4_6', 'chk_4_7', 'chk_4_8', 'chk_4_9', 'chk_4_10',
                'chk_4_11', 'chk_4_11_a', 'chk_4_11_b', 'chk_4_11_v', 'chk_4_12', 'chk_5_1', 'chk_5_2', 'chk_5_3', 'number_pp',
                'name_sites', 'brief_description', 'name_substance', 'operational_character', 'numerical_designation',
                'full_name_le', 'applicants_address', 'head_position', 'surname_head', 'sign', 'date_signing',
                'registration_number', 'date_registration', 'date_change', 'name_rostekhnadzor', 'position_person_rostekh',
                'full_name_person_rostekh', 'sign_person_rostekh', 'date_person_rostekh'];
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            $.ajax({
                url: '/docs/intelligence_opo/save',
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                    window.location.href = '/docs/intelligence_opo/opo'
                }
            })
        }

    </script>

@endsection

