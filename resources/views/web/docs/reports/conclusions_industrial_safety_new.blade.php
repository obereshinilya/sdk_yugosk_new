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
                        <h2 class="text-muted" style="text-align: center">Добавление записи в реестр заключений
                            экспертизы промышленной безопасности</h2>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:77.5vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <col style="width: 25%">
                                <col style="width: 25%">
                                <col style="width: 50%">
                                <thead>
                                <tr>
                                    <th colspan="2" style="text-align: center">Наименование</th>
                                    <th style="text-align: center">Содержание</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th colspan="2">Год</th>
                                    <td style="padding: 0px"><select class="select-css" id="year"
                                                                     style="height: 100%; width: 20%">
                                            @for($i=2000; $i<=2025; $i++)
                                                <option value="{{$i}}">{{$i}} год</option>
                                            @endfor
                                        </select></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Наименование центра финансовой ответственности</th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="center_name"></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Наименование филиала</th>
                                    <td style="padding: 0px"><select id="name_do" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            @foreach($do as $row)
                                                <option value="{{$row->short_name_do}}">{{$row->short_name_do}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Вид ТУ, зданий и сооружений</th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="type_tu"></td>
                                </tr>
                                <tr>
                                    <th rowspan="9">Место проведения ЭПБ</th>
                                    <th style="text-align: center">Наименование объекта</th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="object_name">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">Наименов-е цеха/ местонахождения</th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="workshop_name">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">№ цеха</th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="n_workshop">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">Наименов-е ТУ, здания, сооружения</th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="name_tu">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">Изготовитель/ проектная организация</th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="manufacturer">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" style="text-align: center">Станц-й номер, рег.№, участок
                                        (км-км)
                                    </th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="station_number">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">Зав. №</th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="factory_num">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">Протяженность газопровода, км,
                                        кол-во, шт.
                                    </th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="pipeline_length">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">Инв.
                                        №ТУ, здания, сооружения
                                    </th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="inv_tu_num">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Дата ввода в эксплуатацию</th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="date_comiss">
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2">Дата проведения ЭПБ</th>
                                    <td style="padding: 0px"><input type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    id="date_epb">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" rowspan="2">Срок эксплуатации/ наработка на момент ЭПБ</th>
                                    <th id="">Наработка ТУ, часов</th>
                                    <td style="padding: 0px"><input id="runtime_tu" type="text" min="0"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">Кол-во лет ТУ, зданию, сооружению</th>
                                    <td style="padding: 0px"><input id="age_tu" type="text" min="0"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" rowspan="2">Срок продления безопасной эксплуатации</th>
                                    <th id="">Наработка ТУ, часов</th>
                                    <td style="padding: 0px"><input id="runtime_ext_tu" type="text" min="0"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">Кол-во лет ТУ, зданию, сооружению</th>
                                    <td style="padding: 0px"><input id="age_ext_tu" type="text" min="0"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="2">Дата/наработка следующей ЭПБ</th>
                                    <th id="">Наработка до следующего ЭПБ</th>
                                    <td style="padding: 0px"><input id="runtime_epb" type="text" min="0"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="">Дата следующего ЭПБ</th>
                                    <td style="padding: 0px"><input id="date_next_epb" type="text"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Уведомление о внесении в реестр (№ письма,
                                        дата)
                                    </th>
                                    <td style="padding: 0px"><input id="notification" type="text"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Регистрационный номер заключения ЭПБ</th>
                                    <td style="padding: 0px"><input id="reg_num" type="text"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Наличие условий действий заключений</th>
                                    <td style="padding: 0px"><input id="conditions" type="text"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>

                                </tr>
                                <tr>
                                    <th id="" colspan="2">Факт выполнения условий</th>
                                    <td style="padding: 0px"><input id="completion_mark" type="text"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>

                                </tr>
                                <tr>
                                    <th id="" colspan="2">Условия действия заключений</th>
                                    <td style="padding: 0px"><input id="conditions_concl" type="text"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Срок выполнения условий</th>
                                    <td style="padding: 0px"><input id="due_date" type="text"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Приоритетность</th>
                                    <td style="padding: 0px"><input id="priority" type="text"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Номер заключения ЭПБ подрядной
                                        организации
                                    </th>
                                    <td style="padding: 0px"><input id="concl_num" type="text"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th id="" colspan="2">Наименование экспертной организации</th>
                                    <td style="padding: 0px"><input id="exp_org_name" type="text" min="0"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a href="#" onclick="save()">Сохранить</a></div>
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a style="background-color: #CD5C5C" href="/docs/conclusions_industrial_safety">Отменить</a>
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

            var params = ['center_name', 'name_do', 'type_tu', 'object_name', 'workshop_name', 'n_workshop', 'name_tu', 'manufacturer', 'station_number', 'factory_num', 'pipeline_length', 'inv_tu_num', 'date_comiss', 'date_epb', 'runtime_tu', 'age_tu', 'runtime_ext_tu', 'age_ext_tu', 'runtime_epb', 'date_next_epb', 'notification', 'reg_num', 'conditions', 'completion_mark', 'conditions_concl', 'due_date', 'priority', 'concl_num', 'exp_org_name', 'year']
            var out_data = []
            for (var param of params) {
                var value = document.getElementById(param).value

                out_data[param] = value

            }

                $.ajax({
                    url: '/docs/conclusions_industrial_safety/save',
                    type: 'POST',
                    data: {
                        keys: JSON.stringify(Object.keys(out_data)),
                        values: JSON.stringify(Object.values(out_data))
                    },
                    success: (res) => {

                        console.log(res)
                        // window.location.href = '/docs/conclusions_industrial_safety'


                    }
                })

        }
    </script>

@endsection
