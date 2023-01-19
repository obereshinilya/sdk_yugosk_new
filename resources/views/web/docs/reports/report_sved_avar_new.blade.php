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

    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h2 class="text-muted" style="text-align: center">Добавление записи в cведения об аварийности на
                            ОПО дочернего общества</h2>
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
                                    <td style="padding: 0px">
                                        <input style="width: 20%; " type="number"
                                               id="year" class="text-field__input" min="1970" max="2030">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наименование филиала ДО</th>
                                    <td style="padding: 0px"><select id="id_do" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            @foreach($do as $row)
                                                <option value="{{$row->id_do}}">{{$row->short_name_do}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Вид техногенного события (авария/инцидент)</th>
                                    {{--                                    <td style="padding: 0px"><input type="text" id="vid_techno_sob"--}}
                                    {{--                                                                       style="height: 100%; width: 95%"--}}
                                    {{--                                                                       class="text-field__input"></td>--}}
                                    <td style="padding: 0px"><select id="vid_techno_sob"
                                                                     style="height: 100%; width: 50%"
                                                                     class="select-css">
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
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Дата и время техногенного события (МСК)</th>
                                    <td style="padding: 0px"><input type="datetime-local" id="data_time"
                                                                    style="height: 100%; width: 50%"
                                                                    class="text-field__input"
                                                                    max="{{date('Y-m-d\TH:m')}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Вид аварии/инцидента (по классификатору)</th>
                                    {{--                                    <td style="padding: 0px"><input type="text" id="vid_avari"--}}
                                    {{--                                                                    style="height: 100%; width: 95%"--}}
                                    {{--                                                                    class="text-field__input"></td>--}}
                                    <td style="padding: 0px"><select id="vid_avari" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            @foreach($types as $row)
                                                <option value="{{$row->types}}">{{$row->types}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Краткое описание возникновения, развития, ликвидации,
                                        какие пункты действующих правил были нарушены
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="kratk_opisan"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наличие пострадавших</th>
                                    <td style="padding: 0px"><input type="text" id="nalich_postradav"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Экономический ущерб от аварии, тыс. руб.</th>
                                    <td style="padding: 0px"><input type="text" id="econom_usherb"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Продолжительность простоя до пуска объекта в
                                        эксплуатацию, часов (суток)
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="prodolgit_prost"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Лица, ответственные за допущенную аварию и принятые к
                                        ним меры воздействия (наказания)
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="litsa_otvetstven"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Мероприятия, предложенные комиссией по техническому
                                        расследованию причин аварии
                                    </th>
                                    <td style="padding: 0px"><textarea id="meropriytia"
                                                                       style="height: 100%; width: 95%"
                                                                       class="text-field__input"></textarea></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Отметка о выполнении мероприятия</th>
                                    <td style="padding: 0px"><select id="otmetka_vypoln"
                                                                     style="height: 100%; width: 25%"
                                                                     class="select-css">
                                            <option value="false" selected>Не выполнено</option>
                                            <option value="true">Выполнено</option>
                                        </select></td>
                                </tr>
                                {{--                                <tr>--}}
                                {{--                                    <th style="text-align: center">Индикативный показатель</th>--}}
                                {{--                                    <td style="padding: 0px"><input type="number" min="0" step="0.1" id="indikativn_pokazat"--}}
                                {{--                                                                       style="height: 100%; width: 95%"--}}
                                {{--                                                                       class="text-field__input"></td>--}}
                                {{--                                </tr>--}}
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a href="#" onclick="save()">Сохранить</a></div>
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

            var params = ['id_do', 'vid_techno_sob', 'mesto_techno_sob', 'data_time', 'vid_avari', 'kratk_opisan', 'nalich_postradav', 'econom_usherb', 'prodolgit_prost', 'litsa_otvetstven', 'meropriytia', 'otmetka_vypoln', 'year']
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            if (Number(out_data['indikativn_pokazat']) > 1) {
                alert('Показатель не может быть больше 1!')
            } else if (out_data['indikativn_pokazat'] === '') {
                alert('Не указан индикативный показатель!')
            } else {
                $.ajax({
                    url: '/docs/sved_avar/save',
                    type: 'POST',
                    data: {
                        keys: JSON.stringify(Object.keys(out_data)),
                        values: JSON.stringify(Object.values(out_data))
                    },
                    success: (res) => {
                        // console.log(res)
                        window.location.href = '/docs/sved_avar'
                    }
                })
            }

        }

    </script>

@endsection
