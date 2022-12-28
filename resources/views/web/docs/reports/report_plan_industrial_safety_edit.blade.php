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
                        <h2 class="text-muted" style="text-align: center">Редактирование cведений о выполнении плана
                            работ в области промышленной
                            безопасности
                        </h2>
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
                                    <th style="text-align: center">Год</th>
                                    <td style="padding: 0px"><select disabled id="year" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option value="{{$data->year}}" selected>{{$data->year}} год</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наименование филиала/дочернего общества</th>
                                    <td style="padding: 0px"><select disabled id="name_filiala" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                                <option value="{{$data->name_filiala}}" selected>{{$data->name_filiala}}</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Цели в области ОТ и ПБ</th>
                                    <td style="padding: 0px"><input id="goals_OT_PB" style="height: 100%; width: 95%" value="{{$data->goals_OT_PB}}"
                                                                       class="text-field__input">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наименование риска</th>
                                    <td style="padding: 0px"><input id="name_risk" style="height: 100%; width: 95%" value="{{$data->name_risk}}"
                                                                       class="text-field__input">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Мероприятие</th>
                                    <td style="padding: 0px"><input id="events" style="height: 100%; width: 95%" value="{{$data->events}}"
                                                                       class="text-field__input">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Срок исполнения</th>
                                    <td style="padding: 0px"><input type="date" id="period_execution"
                                                                       style="height: 100%; width: 95%" value="{{$data->period_execution}}"
                                                                       class="text-field__input">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Ответственный исполнитель (Ф.И.О., должность)</th>
                                    <td style="padding: 0px"><input id="responsible" style="height: 100%; width: 95%" value="{{$data->responsible}}"
                                                                       class="text-field__input">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Отметка о выполнении</th>
                                    <td style="padding: 0px"><select id="completion_mark" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            @if($data->completion_mark == 'true')
                                                <option value="true" selected>Выполнено</option>
                                                <option value="false">Не выполнено</option>
                                            @else
                                                <option value="true">Выполнено</option>
                                                <option value="false" selected>Не выполнено</option>
                                            @endif
                                        </select></td>
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
                                       href="/docs/plan_industrial_safety">Отменить</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function update() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var params = ['name_filiala', 'goals_OT_PB', 'name_risk', 'events', 'period_execution', 'responsible', 'completion_mark']
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            $.ajax({
                url: '/docs/plan_industrial_safety/update/{{$data->id}}',
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                    console.log(res)
                    window.location.href = '/docs/plan_industrial_safety'
                }
            })
        }

    </script>

@endsection
