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
                        <h2 class="text-muted" style="text-align: center">Редактирование записи в справочнике элементов
                            ОПО
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
                                    <td style="padding: 0px"><select id="id_вщ" disabled style="height: 100%; width: 70%"
                                                                     class="select-css">
                                            <option
                                                value="">{{\App\Models\Main_models\RefDO::where('id_do','=',\App\Models\Main_models\RefOpo::where('id_opo', '=', $data->id_opo)->first()->id_do)->first()->short_name_do}}</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">ОПО</th>
                                    <td style="padding: 0px"><select id="id_opo" disabled style="height: 100%; width: 70%"
                                                                     class="select-css">
                                            <option
                                                value="{{$data->id_opo}}">{{\App\Models\Main_models\RefOpo::where('id_opo','=',$data->id_opo)->value('full_name_opo')}}</option>
                                            @foreach(\App\Models\Main_models\RefOpo::all() as $row)
                                                @if($row->id_opo==$data->id_opo)
                                                    @continue
                                                @else
                                                    <option value="{{$row->id_opo}}">{{$row->full_name_opo}}</option>
                                                @endif
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Тип элемента ОПО</th>
                                    <td style="padding: 0px"><select disabled id="type_obj" style="height: 100%; width: 70%"
                                                                     class="select-css">
                                            <option
                                                value="{{$data->type_obj}}">{{\App\Models\Main_models\TypeObj::where('type_obj','=',$data->type_obj)->value('full_name_type')}}</option>

                                            @foreach(\App\Models\Main_models\TypeObj::all() as $row)
                                                @if($row->type_obj==$data->type_obj)
                                                    @continue
                                                @else
                                                    <option value="{{$row->type_obj}}">{{$row->full_name_type}}</option>
                                                @endif
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Краткое наименование элемента ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="short_name_obj"
                                                                    style="height: 100%; width: 95%"
                                                                    value="{{$data->short_name_obj}}"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Полное наименование элемента ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="full_name_obj"
                                                                    style="height: 100%; width: 95%"
                                                                    value="{{$data->full_name_obj}}"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Идентификатор элемента ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="guid_obj"
                                                                       style="height: 100%; width: 95%"
                                                                       class="text-field__input" value="{{$data->guid_obj}}">
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
                                    <a style="background-color: #CD5C5C" href="/docs/directory_obj">Отменить</a>
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

            var params = ['id_opo', 'type_obj', 'short_name_obj', 'full_name_obj', 'guid_obj',]
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            $.ajax({
                url: '/docs/directory_obj/update/{{$data->id_obj}}',
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                    window.location.href = '/docs/directory_obj'
                }
            })
        }

    </script>

@endsection
