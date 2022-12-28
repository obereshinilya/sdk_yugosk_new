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
                        <h2 class="text-muted" style="text-align: center">Добавление записи в план работ в области
                            промышленной безопасности
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
                                            @for($i=2021; $i<=2030; $i++)
                                                <option value="{{$i}}">{{$i}} год</option>
                                            @endfor
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Структурное подразделение</th>
                                    <td style="padding: 0px"><input type="text" id="struct_unit"
                                                                    class="text-field__input"
                                                                    style="width: 95%"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Цели в области ОТ и ПБ</th>
                                    <td style="padding: 0px"><input type="text" id="goals" class="text-field__input"
                                                                    style="width: 95%">
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наименование риска</th>
                                    <td style="padding: 0px"><input type="text" id="risk"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Мероприятие</th>
                                    <td style="padding: 0px"><input type="text" id="event"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Стоимость (тыс.руб.) без НДС</th>
                                    <td style="padding: 0px"><input type="number" id="cost"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Источник финансирования</th>
                                    <td style="padding: 0px"><input type="text" id="src"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Срок исполнения</th>
                                    <td style="padding: 0px"><input type="date" id="completion_date"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Ответственный исполнитель (Ф.И.О., должность)</th>
                                    <td style="padding: 0px"><input type="text" id="person"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Отметка о выполнении</th>
                                    <td style="padding: 0px"><select id="completion_mark"
                                                                     style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option value="1">Выполнено</option>
                                            <option value="0">Не выполнено</option>
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
                                    <a style="background-color: #CD5C5C"
                                       href="/docs/plan_of_industrial_safety">Отменить</a></div>
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

            var params = ['struct_unit', 'goals', 'risk', 'event', 'cost', 'src', 'completion_date', 'person', 'completion_mark', 'year']
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }

            $.ajax({
                url: '/docs/plan_of_industrial_safety/save',
                type: 'POST',
                data: {
                    keys: JSON.stringify(Object.keys(out_data)),
                    values: JSON.stringify(Object.values(out_data))
                },
                success: (res) => {
                    // console.log(res)
                    window.location.href = '/docs/plan_of_industrial_safety'
                }
            })


        }
    </script>

@endsection

