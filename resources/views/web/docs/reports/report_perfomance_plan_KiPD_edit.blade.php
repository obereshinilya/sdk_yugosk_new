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
                        <h2 class="text-muted" style="text-align: center">Редактирование выполнения плана КиПД,
                            утвержденного по
                            результатам анализа ЕСУПБ в ПАО «Газпром»
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
                                    <td style="padding: 0px">
                                        <input disabled style="width: 20%; " type="number"
                                               id="year" class="text-field__input" min="1970" max="2030"
                                               value="{{$data->year}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Наименование филиала</th>
                                    <td style="padding: 0px"><select id="id_do" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option
                                                value="{{$data->id_do}}">{{\App\Models\Main_models\RefDO::where('id_do','=',$data->id_do)->value('short_name_do')}}</option>
                                            @foreach($do as $row)
                                                @if($row->short_name_do==\App\Models\Main_models\RefDO::where('id_do','=',$data->id_do)->value('short_name_do'))
                                                    @continue
                                                @else
                                                    <option
                                                        value="{{$row->id_do}}">{{$row->short_name_do}}</option>
                                                @endif
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Корректирующие и предупреждающие действия</th>
                                    <td style="padding: 0px"><textarea id="correct_action"
                                                                       style="height: 100%; width: 95%"
                                                                       class="text-field__input">{{$data->correct_action}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Ответственный исполнитель</th>
                                    <td style="padding: 0px"><textarea id="respons_executor"
                                                                       style="height: 100%; width: 95%"
                                                                       class="text-field__input">{{$data->respons_executor}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Срок выполнения</th>
                                    <td style="padding: 0px"><input id="deadline" type="date"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->deadline}}"></td>
                                </tr>

                                <tr>
                                    <th style="text-align: center">Отметка о выполнении</th>
                                    <td style="padding: 0px"><select id="completion_mark"
                                                                     style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            @if($data->completion_mark == 'true')
                                                <option value="false">Не выполнено</option>
                                                <option value="true" selected>Выполнено</option>
                                            @else
                                                <option value="false" selected>Не выполнено</option>
                                                <option value="true">Выполнено</option>
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
                                    <a style="background-color: #CD5C5C" href="/docs/perfomance_plan_KiPD">Отменить</a>
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

            var params = ['correct_action', 'respons_executor', 'deadline', 'completion_mark', 'year', 'id_do']
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            $.ajax({
                url: '/docs/perfomance_plan_KiPD/update/{{$data->id}}',
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                    // console.log(out_data)
                    // console.log(res)
                    window.location.href = '/docs/perfomance_plan_KiPD'
                }
            })
        }

    </script>

@endsection
