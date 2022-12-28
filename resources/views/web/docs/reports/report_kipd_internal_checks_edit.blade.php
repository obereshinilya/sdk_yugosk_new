@extends('web.layouts.app')
@section('title')
    Редактивание
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
                        <h2 class="text-muted" style="text-align: center">Редактирование записи в плане корректирующих действий ПБ по внутренним проверкам</h2>
                    </div>

                    <div class="inside_tab_padding form51"
                         style="height:77.5vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <col style="width: 15%">
                                <col style="width: 35%">
                                <col style="width: 50%">
{{--                                <col style="width: 60%">--}}
                                <thead>
                                <tr>
                                    <th colspan="2" style="text-align: center">Наименование</th>
                                    <th style="text-align: center">Содержание</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th colspan="2" style="text-align: center">Год</th>
                                    <td style="padding: 0px"><select disabled class="select-css" id="year"
                                                                     style="height: 100%; width: 20%">
                                                <option value="{{$edition_data->year}}">{{$edition_data->year}} год</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Наименование филиала ДО</th>
                                    <td style="padding: 0px"><select id="name_DO" disabled style="height: 100%; width: 50%"
                                                                     class="select-css">
                                                <option value="{{$edition_data->name_DO}}">{{$edition_data->name_DO}}</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Наименование подразделения</th>
                                    <td style="padding: 0px"><input id="podrazdelenie" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$edition_data->podrazdelenie}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Дата акта</th>
                                    <td style="padding: 0px"><input id="date_act" type="date" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$edition_data->date_act}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Номер акта</th>
                                    <td style="padding: 0px"><input id="num_act" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$edition_data->num_act}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Описание несоответствия</th>
                                    <td style="padding: 0px"><input id="error_comment" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$edition_data->error_comment}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" rowspan="3">Мероприятия по устранению несоответствия</th>
                                    <th style="text-align: center">Наименование мероприятия</th>
                                    <td style="padding: 0px"><input id="person" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$edition_data->person}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Ответственный исполнитель</th>
                                    <td style="padding: 0px"><input id="name_event" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$edition_data->name_event}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Срок выполнения</th>
                                    <td style="padding: 0px"><input id="date_check" type="date" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$edition_data->date_check}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" rowspan="5">Корректирующие действия</th>
                                    <th style="text-align: center">Причины появления несоответствия</th>
                                    <td style="padding: 0px"><input id="reason" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$edition_data->reason}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Корректирующее действие</th>
                                    <td style="padding: 0px"><input id="correct_event" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$edition_data->correct_event}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Требуемые условия и ресурсы</th>
                                    <td style="padding: 0px"><input id="usloviya" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$edition_data->usloviya}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Ответственный исполнитель</th>
                                    <td style="padding: 0px"><input id="person_correct" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$edition_data->person_correct}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Дата выполнения</th>
                                    <td style="padding: 0px"><input id="date_check_correct" type="date" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$edition_data->date_check_correct}}">
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
                                    <a style="background-color: #CD5C5C" href="/docs/kipd_internal_checks">Отменить</a>
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

            var params = ['name_DO', 'date_act', 'num_act', 'error_comment', 'person',
            'name_event', 'date_check', 'reason', 'correct_event', 'usloviya',
            'person_correct', 'date_check_correct', 'podrazdelenie']
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            $.ajax({
                url: '/docs/kipd_internal_checks/update/'+{{$edition_data->id}},
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                    if (typeof res == 'object'){
                        alert('Не указан срок выполнения!')
                    }else {
                   //     console.log(res)
                        window.location.href = '/docs/kipd_internal_checks'
                    }
                }
            })
        }

    </script>

@endsection
