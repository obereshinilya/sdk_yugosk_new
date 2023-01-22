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
                        <h2 class="text-muted" style="text-align: center">Добавление записи в Отчет
                            о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных
                            Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром»
                        </h2>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:70vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <col style="width: 30%">
                                <col style="width: 20%">
                                <col style="width: 50%">
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
                                    <th style="text-align: center" colspan="2">Количество устранённых нарушений за
                                        отчётный период, ед.
                                    </th>
                                    <td style="padding: 0px"><input type="number" step="1" id="num_elim"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Количество не устранённых нарушений с
                                        истекшим сроком устранения, ед.
                                    </th>
                                    <td style="padding: 0px"><input type="number" step="1" id="num_unrem"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Количество нарушений с не истекшим сроком
                                        устранения, ед.
                                    </th>
                                    <td style="padding: 0px"><input type="number" step="1" id="num_unexp_deadlines"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th rowspan="2"> Из них</th>
                                    <th style="text-align: center">со сроком, установленным по Акту, ед.
                                    </th>
                                    <td style="padding: 0px"><input type="number" step="1" id="num_act"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">с переносом срока устранения, ед.</th>
                                    <td style="padding: 0px"><input type="number" step="1" id="num_repiat"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Примечание</th>
                                    <td style="padding: 0px"><input type="text" id="note"
                                                                    style="height: 100%; width: 95%; float: left;"
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
                                    <a style="background-color: #CD5C5C" href="/docs/report_events">Отменить</a>
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

            var params = ['id_do', 'num_elim', 'num_unrem', 'num_unexp_deadlines', 'num_act', 'num_repiat', 'note', 'year',]
            var out_data = []
            var check_param = true
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
                if (!out_data[param]) {
                    check_param = false
                }
            }

            if (check_param) {
                if ((Number(out_data['num_elim']) + Number(out_data['num_unrem']) + Number(out_data['num_unexp_deadlines'])) !== (Number(out_data['num_act']) + Number(out_data['num_repiat']))) {
                    alert('Количество нарушений не совпадает с графой \'Из них\'')
                } else {
                    $.ajax({
                        url: '/docs/report_events/save',
                        type: 'POST',
                        data: {
                            keys: JSON.stringify(Object.keys(out_data)),
                            values: JSON.stringify(Object.values(out_data))
                        },
                        success: (res) => {
                            console.log(res)
                            window.location.href = '/docs/report_events'
                        }
                    })
                }
            } else {
                alert('Не все поля заполнены!')
            }
        }
    </script>

@endsection
