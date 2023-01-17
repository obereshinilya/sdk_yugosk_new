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
                        <h2 class="text-muted" style="text-align: center">Добавление записи в cведения о
                            противоаварийных тренировках,
                            проведенных на ОПО
                        </h2>
                    </div>

                    <div class="inside_tab_padding form51"
                         style="height:70vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <col style="width: 30%">
                                <col style="width: 10%">
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
                                            @for($i=2015; $i<=2023; $i++)
                                                <option value="{{$i}}">{{$i}} год</option>
                                            @endfor
                                        </select></td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="text-align: center">Наименование филиала ДО</th>
                                    <td style="padding: 0px"><select id="id_do" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            @foreach($do as $row)
                                                <option value="{{$row->id_do}}">{{$row->short_name_do}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" rowspan="3">Количество ПАТ</th>
                                    <th style="text-align: center">План на год</th>
                                    <td style="padding: 0px"><input type="number" step="1" id="plan_PAT"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">План тек.</th>
                                    <td style="padding: 0px"><input type="number" step="1" id="plan_month_PAT"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Факт</th>
                                    <td style="padding: 0px"><input type="number" step="1" id="fact_PAT"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Наименование (тема) противоаварийной
                                        тренировки
                                    </th>
                                    <td style="padding-top: 0px; padding-bottom: 0px"><select id="workout_theme"
                                                                                              style="height: 100%; width: 95%"
                                                                                              class="select-css">
                                            @foreach(\App\Pat_themes::all() as $row)
                                                <option value="{{$row->pat_desc}}">{{$row->pat_desc}}</option>
                                            @endforeach
                                        </select></td>

                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Наименование, рег. № ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="name_reg_№_OPO"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Дата ПАТ</th>
                                    <td style="padding: 0px"><input id="date_PAT"
                                                                    style="height: 100%; width: 30%; float: left;"
                                                                    type="date" class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">№ и дата протокола проведения ПАТ</th>
                                    <td style="padding: 0px"><input type="text" id="№_date_protocol_PAT"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Основание проведения ПАТ (плановая,
                                        внеплановая - указать причину)
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="basis_PAT"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="text-align: center">Оценка</th>
                                    <td style="padding: 0px"><select id="grade" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option value="true">Удовл.</option>
                                            <option value="false">Не удовл.</option>
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
                                    <a style="background-color: #CD5C5C" href="/docs/emergency_drills">Отменить</a>
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

            var params = ['id_do', 'plan_PAT', 'fact_PAT', 'workout_theme', 'name_reg_№_OPO', 'date_PAT', '№_date_protocol_PAT', 'basis_PAT', 'grade', 'year', 'plan_month_PAT']
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            if (!out_data['date_PAT']) {
                alert('Не заполнена дата ПАТ!')
            } else {
                $.ajax({
                    url: '/docs/emergency_drills/save',
                    type: 'POST',
                    data: {
                        keys: JSON.stringify(Object.keys(out_data)),
                        values: JSON.stringify(Object.values(out_data))
                    },
                    success: (res) => {
                        // console.log(out_data)
                        window.location.href = '/docs/emergency_drills'
                    }
                })
            }
        }

    </script>

@endsection
