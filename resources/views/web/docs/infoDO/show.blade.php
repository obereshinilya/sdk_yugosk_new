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
                        <h2 class="text-muted" style="text-align: center">Просмотр записи в справочнике филиалов ДО
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
                                    <th style="text-align: center">Краткое наименование филиала ДО</th>
                                    <td style="padding: 0px"><input disabled type="text" id="short_name_do"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->short_name_do}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Полное наименование филиала ДО</th>
                                    <td style="padding: 0px"><input disabled type="text" id="full_name_do"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->full_name_do}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Идентификатор филиала ДО</th>
                                    <td style="padding: 0px"><input disabled type="text" id="guid_do"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->guid_do}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Регион</th>
                                    <td style="padding: 0px"><input disabled type="text" id="region"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data->region}}">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table>

                                <thead>
                                <tr>
                                    <th style="text-align: center">Должность</th>
                                    <th style="text-align: center">ФИО</th>
                                    <th style="text-align: center">Номер телефона</th>
                                    <th style="text-align: center">Электронная почта</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th style="text-align: center">Руководитель филиала</th>
                                    <td style="padding: 0px; text-align: center"><input disabled type="text"
                                                                                        id="name_manager"
                                                                                        style="height: 100%; width: 85%; margin: 0 auto; "
                                                                                        class="text-field__input"
                                                                                        value="{{$data->name_manager}}">
                                    </td>
                                    <td style="padding: 0px"><input disabled type="tel" id="phone_manager"
                                                                    style="height: 100%;width: 85%; margin: 0 auto; "
                                                                    class="text-field__input"
                                                                    value="{{$data->phone_manager}}"></td>
                                    <td style="padding: 0px"><input disabled type="email" id="mail_manager"
                                                                    style="height: 100%; width: 85%; margin: 0 auto;"
                                                                    class="text-field__input"
                                                                    value="{{$data->mail_manager}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Главный инженер</th>
                                    <td style="padding: 0px; text-align: center"><input disabled type="text"
                                                                                        id="name_chief_engineer"
                                                                                        style="height: 100%; width: 85%; margin: 0 auto; "
                                                                                        class="text-field__input"
                                                                                        value="{{$data->name_chief_engineer}}">
                                    </td>
                                    <td style="padding: 0px"><input disabled type="tel" id="phone_chief_engineer"
                                                                    style="height: 100%;width: 85%; margin: 0 auto; "
                                                                    class="text-field__input"
                                                                    value="{{$data->phone_chief_engineer}}"></td>
                                    <td style="padding: 0px"><input disabled type="email" id="mail_chief_engineer"
                                                                    style="height: 100%; width: 85%; margin: 0 auto;"
                                                                    class="text-field__input"
                                                                    value="{{$data->mail_chief_engineer}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Заместитель главного инженера по ОТПиПБ</th>
                                    <td style="padding: 0px; text-align: center"><input disabled type="text"
                                                                                        id="name_otpb_engineer"
                                                                                        style="height: 100%; width: 85%; margin: 0 auto; "
                                                                                        class="text-field__input"
                                                                                        value="{{$data->name_otpb_engineer}}">
                                    </td>
                                    <td style="padding: 0px"><input disabled type="tel" id="phone_otpb_engineer"
                                                                    style="height: 100%;width: 85%; margin: 0 auto; "
                                                                    class="text-field__input"
                                                                    value="{{$data->phone_otpb_engineer}}"></td>
                                    <td style="padding: 0px"><input disabled type="email" id="mail_otpb_engineer"
                                                                    style="height: 100%; width: 85%; margin: 0 auto;"
                                                                    class="text-field__input"
                                                                    value="{{$data->mail_otpb_engineer}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Инженер по ПБ</th>
                                    <td style="padding: 0px; text-align: center"><input disabled type="text"
                                                                                        id="name_pb_engineer"
                                                                                        style="height: 100%; width: 85%; margin: 0 auto; "
                                                                                        class="text-field__input"
                                                                                        value="{{$data->name_pb_engineer}}">
                                    </td>
                                    <td style="padding: 0px"><input disabled type="tel" id="phone_pb_engineer"
                                                                    style="height: 100%;width: 85%; margin: 0 auto; "
                                                                    class="text-field__input"
                                                                    value="{{$data->phone_pb_engineer}}"></td>
                                    <td style="padding: 0px"><input disabled type="email" id="mail_pb_engineer"
                                                                    style="height: 100%; width: 85%; margin: 0 auto;"
                                                                    class="text-field__input"
                                                                    value="{{$data->mail_pb_engineer}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Инженер по ОТ</th>
                                    <td style="padding: 0px; text-align: center"><input disabled type="text"
                                                                                        id="name_ot_engineer"
                                                                                        style="height: 100%; width: 85%; margin: 0 auto; "
                                                                                        class="text-field__input"
                                                                                        value="{{$data->name_ot_engineer}}">
                                    </td>
                                    <td style="padding: 0px"><input disabled type="tel" id="phone_ot_engineer"
                                                                    style="height: 100%;width: 85%; margin: 0 auto; "
                                                                    class="text-field__input"
                                                                    value="{{$data->phone_ot_engineer}}"></td>
                                    <td style="padding: 0px"><input disabled type="email" id="mail_ot_engineer"
                                                                    style="height: 100%; width: 85%; margin: 0 auto;"
                                                                    class="text-field__input"
                                                                    value="{{$data->mail_ot_engineer}}"></td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="text-align: center">

                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a style="background-color: #CD5C5C" href="/docs/directory_do">Назад</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
