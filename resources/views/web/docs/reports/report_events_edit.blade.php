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
                        <h2 class="text-muted" style="text-align: center">Редактирование записи в Отчет
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
                                    <td style="padding: 0px">
                                        <input style="width: 20%; " type="number"
                                               id="year" class="text-field__input" min="1970" max="2030"
                                               value="{{$data->year}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="text-align: center">Наименование филиала ДО</th>
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
                                    <th style="text-align: center" colspan="2">Количество устранённых нарушений за
                                        отчётный период, ед.
                                    </th>
                                    <td style="padding: 0px"><input type="number" step="1" id="num_elim"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->num_elim}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Количество не устранённых нарушений с
                                        истекшим сроком устранения, ед.
                                    </th>
                                    <td style="padding: 0px"><input type="number" step="1" id="num_unrem"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->num_unrem}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Количество нарушений с не истекшим сроком
                                        устранения, ед.
                                    </th>
                                    <td style="padding: 0px"><input type="number" step="1" id="num_unexp_deadlines"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->num_unexp_deadlines}}"></td>
                                </tr>
                                <tr>
                                    <th rowspan="2"> Из них</th>
                                    <th style="text-align: center">со сроком, установленным по Акту, ед.
                                    </th>
                                    <td style="padding: 0px"><input type="number" step="1" id="num_act"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->num_act}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">с переносом срока устранения, ед.</th>
                                    <td style="padding: 0px"><input type="number" step="1" id="num_repiat"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->num_repiat}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center" colspan="2">Примечание</th>
                                    <td style="padding: 0px"><input type="text" id="note"
                                                                    style="height: 100%; width: 95%; float: left;"
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
        function update() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var params = ['id_do', 'num_elim', 'num_unrem', 'num_unexp_deadlines', 'num_act', 'num_repiat', 'note']
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            if ((Number(out_data['num_elim']) + Number(out_data['num_unrem']) + Number(out_data['num_unexp_deadlines'])) !== (Number(out_data['num_act']) + Number(out_data['num_repiat']))) {
                alert('Количество нарушений не совпадает с графой \'Из них\'')
            } else {
                $.ajax({
                    url: '/docs/report_events/update/{{$data->id}}',
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
        }
    </script>

@endsection
