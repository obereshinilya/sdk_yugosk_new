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
                        <h2 class="text-muted" style="text-align: center">Редактирование ТБ элемента ОПО
                        </h2>
                    </div>

                    <div class="inside_tab_padding form51"
                         style="height: 82vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <col style="width: 30%">
                                <col style="width: 70%">
                                <thead>
                                <tr>
                                    <th style="text-align: center">Параметр</th>
                                    <th style="text-align: center">Значение</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th style="text-align: center">Наименование филиала ДО</th>
                                    <td style="padding: 0px"><input type="text" disabled style="height: 100%; width: 95%"
                                                                       class="text-field__input" value="{{$data_tb->full_name_do}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наименование ОПО</th>
                                    <td style="padding: 0px"><input type="text" disabled style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->full_name_opo}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наименование элемента ОПО</th>
                                    <td style="padding: 0px"><input type="text" disabled style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->full_name_obj}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Состояние ТБ</th>
                                    <td style="padding: 0px"><select id="id_status" style="height: 90%; width: 25%"
                                                                     class="select-css">
                                            @if($data_tb->id_status == 4)
                                                <option selected value="4">Регламентные работы</option>
                                                <option value="">В работе</option>
                                            @else
                                                <option  value="4">Регламентные работы</option>
                                                <option selected value="">В работе</option>
                                            @endif
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Тип ТБ</th>
                                    <td style="padding: 0px"><input type="text" disabled style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->full_name_type}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Наименование ТБ</th>
                                    <td style="padding: 0px"><input id="full_name_tb" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->full_name_tb}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Краткое наименование ТБ</th>
                                    <td style="padding: 0px"><input id="short_name_tb" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->short_name_tb}}">
                                    </td>
                                </tr>

                                <tr>
                                    <th style="text-align: center">Разрешенное рабочее давление (кгс/см2)</th>
                                    <td style="padding: 0px"><input id="p_w" type="number" step="0.01" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->p_w}}">
                                    </td>
                                </tr>

{{--                                <tr>--}}
{{--                                    <th style="text-align: center">Расчетная дата перехода участка в класс безопасности "Низкий"</th>--}}
{{--                                    <td style="padding: 0px"><input id="time_low" type="date"  style="height: 100%; width: 95%"--}}
{{--                                                                    class="text-field__input" value="{{$data_tb->time_low}}">--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
                                <tr>
                                    <th style="text-align: center">Дата окончания действия экспертизы ПБ</th>
                                    <td style="padding: 0px"><input id="date_end" type="date"  style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->date_end}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Общее количество допустимых дефектов</th>
                                    <td style="padding: 0px"><input id="n" step="1" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->n}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Общее количество дефектов в работоспособном состоянии</th>
                                    <td style="padding: 0px"><input id="n_w" step="1" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->n_w}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Общее количество дефектов в предельном состоянии</th>
                                    <td style="padding: 0px"><input id="n_lim" step="1" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->n_lim}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Идентификатор ТБ</th>
                                    <td style="padding: 0px"><input id="guid_tb" type="text" style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->guid_tb}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Давление после крана №7 (тег)</th>
                                    <td style="padding: 0px"><input id="tag_p_in" type="text"  style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->tag_p_in}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Температура после крана №7 (тег)</th>
                                    <td style="padding: 0px"><input id="tag_t_in" type="text"  style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data_tb->tag_t_in}}">
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
                                    <a style="background-color: #CD5C5C" id="cancel" href="/docs/directory_tb">Отменить</a>
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
            if (localStorage.getItem('redirect')){
                document.getElementById('cancel').href = localStorage.getItem('redirect')
            }else {
                document.getElementById('cancel').href = '/docs/directory_tb'
            }
        })
        function update() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var params = ['full_name_tb', 'short_name_tb', 'guid_tb', 'p_w', 'date_end', 'tag_t_in', 'tag_p_in', 'id_status', 'n', 'n_w', 'n_lim']
            var out_data = []
            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            $.ajax({
                url: '/docs/directory_tb/update/{{$data_tb->type_tb}}/{{$data_tb->id_tb}}',
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                    if (localStorage.getItem('redirect')){
                        window.location.href = localStorage.getItem('redirect')
                    }else {
                        window.location.href = '/docs/directory_tb'
                    }
                }
            })
        }

    </script>

@endsection
