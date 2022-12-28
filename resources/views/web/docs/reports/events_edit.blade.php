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
                        <h2 class="text-muted" style="text-align: center">Редактирование записи в Мероприятия
                            по устранению имеющихся нарушений действующих норм и правил, выявленных
                            Северо-Уральским управлением ООО «Газпром газнадзор» при эксплуатации объектов ЕСГ ПАО
                            «Газпром»
                        </h2>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:70vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <col style="width: 10%">
                                <col style="width: 20%">
                                <col style="width: 70%">
                                <thead>
                                <tr>
                                    <th style="text-align: center" colspan="2">Наименование</th>
                                    <th style="text-align: center">Содержание</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th colspan="2" style="text-align: center">Год</th>
                                    <td style="padding: 0px"><select class="select-css" id="year"
                                                                     style="height: 100%; width: 20%">
                                            <option value="{{$data->year}}">{{$data->year}} год</option>
                                            @for($i=2021; $i<=2030; $i++)
                                                @if($i==$data->year)
                                                    @continue
                                                @else
                                                    <option value="{{$i}}">{{$i}} год</option>
                                                @endif
                                            @endfor
                                        </select></td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="text-align: center">Наименование филиала ДО</th>
                                    <td style="padding: 0px"><select id="name_do" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option value="{{$data->name_do}}">{{$data->name_do}}</option>
                                            @foreach($do as $row)
                                                @if($data->name_do==$row->short_name_do)
                                                    @continue
                                                @else
                                                    <option
                                                        value="{{$row->short_name_do}}">{{$row->short_name_do}}</option>
                                                @endif
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Организация, которой выдан акт
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="org"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data->org}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Выявленные нарушения норм и правил (из
                                        акта обследования)
                                    </th>
                                    <td style="padding: 0px"><textarea type="text" id="viols"
                                                                    style="height: 100%; width: 95%"
                                                                       class="text-field__input">{{$data->viols}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">№ акта
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="act_num"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->act_num}}"></td>
                                </tr>
                                <tr>
                                    <th colspan="2"> Дата выдачи акта</th>
                                    <td style="padding: 0px"><input type="date" id="date_issue"
                                                                    style="height: 100%; width: 30%"
                                                                    class="text-field__input"
                                                                    value="{{$data->date_issue}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Мероприятия дочернего общества</th>
                                    <td style="padding: 0px"><input type="text" id="events"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data->events}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Ответственный за устранение</th>
                                    <td style="padding: 0px"><input type="text" id="person"
                                                                    style="height: 100%; width: 95%; float: left;"
                                                                    class="text-field__input" value="{{$data->person}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" rowspan="2">Установленный срок выполнения</th>
                                    <th style="text-align: center">без учета переноса срока</th>
                                    <td style="padding: 0px"><input type="date" id="date_base"
                                                                    style="height: 100%; width: 30%; float: left;"
                                                                    class="text-field__input"
                                                                    value="{{$data->date_base}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">с учётом переноса срока</th>
                                    <td style="padding: 0px"><input type="date" id="date_repiat"
                                                                    style="height: 100%; width: 30%; float: left;"
                                                                    class="text-field__input"
                                                                    value="{{$data->date_repiat}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Фактический срок выполнения</th>
                                    <td style="padding: 0px"><input type="date" id="date_fact"
                                                                    style="height: 100%; width: 30%; float: left;"
                                                                    class="text-field__input"
                                                                    value="{{$data->date_fact}}"></td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="text-align: center">Отметка о выполнении</th>
                                    <td style="padding: 0px"><select id="completion_mark"
                                                                     style="height: 100%; width: 20%"
                                                                     class="select-css">
                                            <option
                                                value="{{$data->completion_mark}}">{{$data->completion_mark? 'Выполнено': 'Не выполнено'}}</option>
                                            <option
                                                value="{{$data->completion_mark? 1 : 0}}">{{$data->completion_mark? 'Не выполнено': 'Выполнено'}}</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Примечание</th>
                                    <td style="padding: 0px"><input type="text" id="note"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data->note}}">
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
                                    <a style="background-color: #CD5C5C" href="/docs/events">Отменить</a>
                                </div>
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

            var params = ['name_do', 'org', 'viols', 'act_num', 'date_issue', 'events', 'person', 'date_base', 'date_repiat', 'date_fact', 'completion_mark', 'note']

            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            $.ajax({
                url: '/docs/events/update/{{$data->id}}',
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {

                    window.location.href = '/docs/events'
                }
            })
        }
    </script>

@endsection
