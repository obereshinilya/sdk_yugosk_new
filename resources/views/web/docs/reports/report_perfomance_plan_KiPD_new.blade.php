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
                        <h2 class="text-muted" style="text-align: center">Добавление записи в выполнения плана КиПД,
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
                                    <td style="padding: 0px"><select class="select-css" id="year"
                                                                     style="height: 100%; width: 20%">
                                            @for($i=2015; $i<=2023; $i++)
                                                <option value="{{$i}}">{{$i}} год</option>
                                            @endfor
                                        </select></td>
                                </tr>
                                <tr>
                                    <th>Наименование филиала</th>
                                    <td style="padding: 0px"><select id="id_do" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option value="">Наименование филиала...</option>
                                            @foreach($do as $row)
                                                <option
                                                    value="{{$row->id_do}}">{{$row->short_name_do}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Корректирующие и предупреждающие действия</th>
                                    <td style="padding: 0px"><textarea id="correct_action"
                                                                       style="height: 100%; width: 95%"
                                                                       class="text-field__input"></textarea></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Ответственный исполнитель</th>
                                    <td style="padding: 0px"><textarea id="respons_executor"
                                                                       style="height: 100%; width: 95%"
                                                                       class="text-field__input"></textarea></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Срок выполнения</th>
                                    <td style="padding: 0px"><input id="deadline" type="date"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>

                                <tr>
                                    <th style="text-align: center">Отметка о выполнении</th>
                                    <td style="padding: 0px"><select id="completion_mark"
                                                                     style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option value="false">Не выполнено</option>
                                            <option value="true">Выполнено</option>
                                        </select></td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a href="#" onclick="save()">Сохранить</a></div>
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

            var params = ['correct_action', 'respons_executor', 'deadline', 'completion_mark', 'year', 'id_do']
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            if (!out_data['deadline']) {
                alert('Не указан срок исполнения!')
            } else {
                $.ajax({
                    url: '/docs/perfomance_plan_KiPD/save',
                    type: 'POST',
                    data: {
                        keys: JSON.stringify(Object.keys(out_data)),
                        values: JSON.stringify(Object.values(out_data))
                    },
                    success: (res) => {
                        // console.log(res)
                        window.location.href = '/docs/perfomance_plan_KiPD'
                    }
                })
            }

        }

    </script>

@endsection

