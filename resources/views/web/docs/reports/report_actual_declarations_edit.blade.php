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
                        <h2 class="text-muted" style="text-align: center">Редактирование записи в реестр актуальных
                            деклараций промышленной безопасности
                            опасных производственных объектов
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
                                    <th style="text-align: center" colspan="1">Год</th>
                                    <td style="padding: 0px"><select disabled id="year"
                                                                     style="height: 100%; width: 20%"
                                                                     class="select-css">
                                            <option value="{{$data->year}}">{{$data->year}} год</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наименование ДПБ</th>
                                    <td style="padding: 0px"><textarea id="name_DPB" style="height: 100%; width: 95%"
                                                                       class="text-field__input">{{$data->name_DPB}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Составные части ДПБ</th>
                                    <td style="padding: 0px"><textarea id="parts_DPB" style="height: 100%; width: 95%"
                                                                       class="text-field__input">{{$data->parts_DPB}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Введена в действие уведомлением Ростехнадзора рег. №,
                                        дата
                                    </th>
                                    <td style="padding: 0px"><textarea id="massage_rtn"
                                                                       style="height: 100%; width: 95%"
                                                                       class="text-field__input">{{$data->reg_num_dpb}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Рег. № ДПБ в Ростехнадзоре</th>
                                    <td style="padding: 0px"><textarea id="reg_num_dpb"
                                                                       style="height: 100%; width: 95%"
                                                                       class="text-field__input">{{$data->name_zepb}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наименование ЗЭПБ</th>
                                    <td style="padding: 0px"><textarea id="name_zepb"
                                                                       style="height: 100%; width: 95%"
                                                                       class="text-field__input">{{$data->reg_num_date_zepb}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Рег.№ ЗЭПБ в Ростехнадзоре, дата</th>
                                    <td style="padding: 0px"><textarea id="reg_num_date_zepb"
                                                                       style="height: 100%; width: 95%"
                                                                       class="text-field__input">{{$data->massage_rtn}}</textarea>
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
                                    <a style="background-color: #CD5C5C" href="/docs/actual_declarations">Отменить</a>
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

            var params = ['name_DPB', 'parts_DPB', 'reg_num_dpb', 'name_zepb', 'reg_num_date_zepb', 'massage_rtn']
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            $.ajax({
                url: '/docs/actual_declarations/update/{{$data->id}}',
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                    console.log(res)
                    window.location.href = '/docs/actual_declarations'
                }
            })
        }

    </script>

@endsection
