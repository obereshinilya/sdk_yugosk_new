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
                        <h2 class="text-muted" style="text-align: center">Редактирование записи в сведениях об
                            аварийности на ОПО дочернего общества
                        </h2>
                    </div>

                    <div class="inside_tab_padding form51"
                         style="height:77.5vh; padding: 0px; margin: 0px; overflow-y: auto">
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
                                    <td style="padding: 0px"><select disabled class="select-css" id="year"
                                                                     style="height: 100%; width: 20%">
                                            <option value="{{$data->year}}">{{$data->year}} год</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наименование филиала ДО</th>
                                    <td style="padding: 0px"><select disabled id="naim_filiala"
                                                                     style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option
                                                value="{{$data->naim_filiala}}">{{ \App\Models\Main_models\RefDO::where('id_do','=',$data->naim_filiala)->value('short_name_do')}}</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Вид техногенного события (авария/инцидент)</th>
                                    {{--                                    <td style="padding: 0px"><input type="text" id="vid_techno_sob" value="{{$data->vid_techno_sob}}"--}}
                                    {{--                                                                    style="height: 100%; width: 95%"--}}
                                    {{--                                                                    class="text-field__input"></td>--}}
                                    <td style="padding: 0px"><select id="vid_techno_sob"
                                                                     style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option value="{{$data->vid_techno_sob}}">{{$data->vid_techno_sob}}</option>
                                            @foreach($type as $row)
                                                <option value="{{$row->type}}">{{$row->type}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Место техногенного события, название объекта,
                                        регистрационный номер и дата его регистрации
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="mesto_techno_sob"
                                                                    value="{{$data->mesto_techno_sob}}"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Дата и время техногенного события (МСК)</th>
                                    <td style="padding: 0px"><input type="text" id="data_time"
                                                                    value="{{$data->data_time}}"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Вид аварии/инцидента (по классификатору)</th>
                                    {{--                                    <td style="padding: 0px"><input type="text" id="vid_avari" value="{{$data->vid_avari}}"--}}
                                    {{--                                                                    style="height: 100%; width: 95%"--}}
                                    {{--                                                                    class="text-field__input"></td>--}}
                                    <td style="padding: 0px"><select id="vid_avari" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option value="{{$data->vid_avari}}">{{$data->vid_avari}}</option>
                                            @foreach($types as $row)
                                                <option value="{{$row->types}}">{{$row->types}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Краткое описание возникновения, развития, ликвидации,
                                        какие пункты действующих правил и требований были нарушены
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="kratk_opisan"
                                                                    value="{{$data->kratk_opisan}}"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наличие пострадавших</th>
                                    <td style="padding: 0px"><input type="text" id="nalich_postradav"
                                                                    value="{{$data->nalich_postradav}}"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Экономический ущерб от аварии, тыс. руб.</th>
                                    <td style="padding: 0px"><input type="text" id="econom_usherb"
                                                                    value="{{$data->econom_usherb}}"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Продолжительность простоя до пуска объекта в
                                        эксплуатацию, часов (суток)
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="prodolgit_prost"
                                                                    value="{{$data->prodolgit_prost}}"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Лица, ответственные за допущенную аварию и принятые к
                                        ним меры воздействия (наказания)
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="litsa_otvetstven"
                                                                    value="{{$data->litsa_otvetstven}}"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Мероприятия, предложенные комиссией по техническому
                                        расследованию причин аварии
                                    </th>
                                    {{--                                    <td style="padding: 0px"><input type="text" id="meropriytia" value="{{$data->meropriytia}}"--}}
                                    {{--                                                                    style="height: 100%; width: 95%"--}}
                                    {{--                                                                    class="text-field__input"></td>--}}
                                    <td style="padding: 0px"><textarea id="meropriytia"
                                                                       style="height: 100%; width: 95%"
                                                                       class="text-field__input">{{$data->meropriytia}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Отметка о выполнении мероприятия</th>
                                    <td style="padding: 0px"><select id="otmetka_vypoln"
                                                                     style="height: 100%; width: 25%"
                                                                     class="select-css">
                                            @if($data->otmetka_vypoln)
                                                <option value="false">Не выполнено</option>
                                                <option value="true" selected>Выполнено</option>
                                            @else
                                                <option value="false" selected>Не выполнено</option>
                                                <option value="true">Выполнено</option>
                                            @endif
                                        </select></td>
                                </tr>
                                {{--                                <tr>--}}
                                {{--                                    <th style="text-align: center">Индикативный показатель</th>--}}
                                {{--                                    <td style="padding: 0px"><input type="number" min="0" step="0.1" id="indikativn_pokazat" value="{{$data->indikativn_pokazat}}"--}}
                                {{--                                                                    style="height: 100%; width: 95%"--}}
                                {{--                                                                    class="text-field__input"></td>--}}
                                {{--                                </tr>--}}
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a href="#" onclick="update()">Сохранить</a></div>
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a style="background-color: #CD5C5C" href="/docs/sved_avar">Отменить</a></div>
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

            var params = ['naim_filiala', 'vid_techno_sob', 'mesto_techno_sob', 'data_time', 'vid_avari', 'kratk_opisan', 'nalich_postradav', 'econom_usherb', 'prodolgit_prost', 'litsa_otvetstven', 'meropriytia', 'otmetka_vypoln']
            var out_data = []
            for (var param of params) {
                // console.log(param)
                out_data[param] = document.getElementById(param).value
            }
            if (Number(out_data['indikativn_pokazat']) > 1) {
                alert('Показатель не может быть больше 1!')
            } else {
                $.ajax({
                    url: '/docs/sved_avar/update/{{$data->id}}',
                    type: 'POST',
                    data: {
                        keys: JSON.stringify(Object.keys(out_data)),
                        values: JSON.stringify(Object.values(out_data))
                    },
                    success: (res) => {
                        window.location.href = '/docs/sved_avar'
                    }
                })
            }

        }

    </script>

@endsection

