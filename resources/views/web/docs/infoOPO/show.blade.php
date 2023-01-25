@extends('web.layouts.app')
@section('title')
    Просмотр
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
                        <h2 class="text-muted" style="text-align: center">Просмотр записи в справочнике ОПО
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
                                    <td style="padding: 0px"><select disabled id="id_do"
                                                                     style="height: 100%; width: 70%"
                                                                     class="select-css">
                                            <option
                                                value="{{$data->id_do}}">{{\App\Models\Main_models\RefDO::where('id_do','=',$data->id_do)->value('short_name_do')}}</option>
                                            @foreach(\App\Models\Main_models\RefDO::all() as $row)
                                                @if($row->id_do==$data->id_do)
                                                    @continue
                                                @else
                                                    <option value="{{$row->id_do}}">{{$row->short_name_do}}</option>
                                                @endif
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Тип ОПО</th>
                                    <td style="padding: 0px"><select disabled id="type_opo"
                                                                     style="height: 100%; width: 70%"
                                                                     class="select-css">
                                            <option
                                                value="{{$data->type_opo}}">{{\App\Models\Main_models\TypeOpo::where('type_opo','=',$data->type_opo)->value('full_name_type')}}</option>

                                            @foreach(\App\Models\Main_models\TypeOpo::all() as $row)
                                                @if($row->type_opo==$data->type_opo)
                                                    @continue
                                                @else
                                                    <option value="{{$row->type_opo}}">{{$row->full_name_type}}</option>
                                                @endif
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Краткое наименование ОПО</th>
                                    <td style="padding: 0px"><input disabled type="text" id="short_name_opo"
                                                                    style="height: 100%; width: 95%"
                                                                    value="{{$data->short_name_opo}}"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Полное наименование ОПО</th>
                                    <td style="padding: 0px"><input disabled type="text" id="full_name_opo"
                                                                    style="height: 100%; width: 95%"
                                                                    value="{{$data->full_name_opo}}"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Идентификатор ОПО</th>
                                    <td style="padding: 0px"><input disabled type="text" id="guid_opo"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->guid_opo}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Рег. №</th>
                                    <td style="padding: 0px"><input disabled type="text" id="reg_num"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->reg_num}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Дата регистрации ОПО</th>
                                    <td style="padding: 0px"><input disabled type="date" id="registration_date"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->registration_date}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Регион</th>
                                    <td style="padding: 0px"><input disabled type="text" id="region_opo"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->region_opo}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Класс опасности</th>
                                    <td style="padding: 0px"><input disabled type="text" id="hazard_class"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->hazard_class}}"></td>

                                </tr>
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a style="background-color: #CD5C5C" href="/docs/directory_opo">Назад</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
