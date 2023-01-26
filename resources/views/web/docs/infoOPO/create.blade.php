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
                        <h2 class="text-muted" style="text-align: center">Добавление записи в справочник ОПО
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
                                    <th style="text-align: center">Филиал дочернего общества</th>
                                    <td style="padding: 0px"><select id="id_do" style="height: 100%; width: 70%"
                                                                     class="select-css">
                                            @foreach(\App\Models\Main_models\RefDO::orderby('short_name_do')->get() as $row)
                                                <option value="{{$row->id_do}}">{{$row->short_name_do}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Тип ОПО</th>
                                    <td style="padding: 0px"><select id="type_opo" style="height: 100%; width: 70%"
                                                                     class="select-css">
                                            @foreach(\App\Models\Main_models\TypeOpo::all() as $row)
                                                <option value="{{$row->type_opo}}">{{$row->full_name_type}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Краткое наименование ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="short_name_opo"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Полное наименование ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="full_name_opo"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Идентификатор ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="guid_opo"
                                                                   style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Рег. №</th>
                                    <td style="padding: 0px"><input type="text" id="reg_num"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Дата регистрации ОПО</th>
                                    <td style="padding: 0px"><input type="date" id="registration_date"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Регион</th>
                                    <td style="padding: 0px"><input type="text" id="region_opo"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Класс опасности</th>
                                    <td style="padding: 0px"><input type="text" id="hazard_class"
                                                                    style="height: 100%; width: 95%"
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
                                    <a style="background-color: #CD5C5C" href="/docs/directory_opo">Отменить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function save() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var params = ['id_do', 'type_opo', 'short_name_opo', 'full_name_opo', 'guid_opo', 'reg_num', 'registration_date', 'region_opo', 'hazard_class']
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            $.ajax({
                url: '/docs/directory_opo/save',
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                    window.location.href = '/docs/directory_opo'
                }
            })
        }

    </script>

@endsection
