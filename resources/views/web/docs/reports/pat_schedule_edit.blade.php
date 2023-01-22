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
    <div class="top_table">
        @include('web.include.toptable')
    </div>
    <style>
        input[type="checkbox"] {
            position: relative;
            width: 30px;
            height: 15px;
            -webkit-appearance: none;
            background: #c6c6c6;
            outline: none;
            border-radius: 15px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, .2);
            transition: .5s
        }

        input:checked[type="checkbox"] {
            background: #4bd562;
        }

        input[type="checkbox"]::before {
            content: '';
            position: absolute;
            width: 15px;
            height: 15px;
            border-radius: 20px;
            top: 0;
            left: 0;
            background: #fff;
            transform: scale(1.1);
            box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
        }

        input:checked[type="checkbox"]::before {
            left: 15px
        }

        td {
            text-align: center;
        }
    </style>

    <div class="inside_content">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h2 class="text-muted" style="text-align: center">Редактирование записи в график комплексных ПАТ
                        </h2>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:66vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <thead>
                                <tr>
                                    <th style="text-align: center">Наименование</th>
                                    <th style="text-align: center">Содержание</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>Год</th>
                                    <td style="padding: 0px"><select disabled class="select-css" id="year"
                                                                     style="height: 100%; width: 20%">
                                            <option value="{{$data->year}}">{{$data->year}} год</option>
                                            @for($i=2021; $i<=2030; $i++)
                                                @if($i==$data->year)
                                                    @continue
                                                @else
                                                    <option value="{{$i}}">{{$i}} год</option>
                                                @endif
                                            @endfor
                                        </select></td>
                                </tr>
                                <tr>
                                    <th>Наименование филиала</th>
                                    <td style="padding: 0px"><select disabled id="id_do"
                                                                     style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option
                                                value="{{$data->id_do}}">{{\App\Models\Main_models\RefDO::where('id_do',$data->id_do)->value('short_name_do')}}</option>

                                        </select></td>
                                </tr>
                                <tr>
                                    <th>Рег. № ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="reg_num_opo" style="width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->reg_num_opo}}"></td>
                                </tr>
                                <tr>
                                    <th>Наименование ОПО</th>
                                    <td style="padding: 0px"><select disabled id="id_opo"
                                                                     style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            <option
                                                value="{{$data->id_opo}}">{{\App\Models\Main_models\RefOpo::where('id_opo',$data->id_opo)->value('full_name_opo')}}</option>

                                        </select></td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="with_selector">
                                <thead>
                                <tr>
                                    <th style="text-align: center; width: 1%">№ темы</th>
                                    <th style="text-align: center">Наименование темы ПАТ</th>
                                    <th>Январь</th>
                                    <th>Февраль</th>
                                    <th>Март</th>
                                    <th>Апрель</th>
                                    <th>Май</th>
                                    <th>Июнь</th>
                                    <th>Июль</th>
                                    <th>Август</th>
                                    <th>Сентябрь</th>
                                    <th>Октябрь</th>
                                    <th>Ноябрь</th>
                                    <th>Декабрь</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($themes as $row)

                                    <tr>
                                        <th style="text-align: center">{{$row->id}}</th>
                                        <td style="padding: 0px">
                                            {{$row->pat_desc}}
                                        </td>
                                        <td style="padding: 0px;">
                                            <input type="checkbox" value="{{$row->id}}"
                                                   {{in_array($row->id, $jan)? 'checked': ''}} class="jan"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}"
                                                   {{in_array($row->id, $feb)? 'checked': ''}} class="feb"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}"
                                                   {{in_array($row->id, $mar)? 'checked': ''}} class="mar"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}"
                                                   {{in_array($row->id, $apr)? 'checked': ''}} class="apr"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}"
                                                   {{in_array($row->id, $may)? 'checked': ''}} class="may"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}"
                                                   {{in_array($row->id, $jun)? 'checked': ''}} class="jun"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}"
                                                   {{in_array($row->id, $jul)? 'checked': ''}} class="jul"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}"
                                                   {{in_array($row->id, $aug)? 'checked': ''}} class="aug"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}"
                                                   {{in_array($row->id, $sep)? 'checked': ''}} class="sep"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}"
                                                   {{in_array($row->id, $oct)? 'checked': ''}} class="oct"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}"
                                                   {{in_array($row->id, $nov)? 'checked': ''}} class="nov"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}"
                                                   {{in_array($row->id, $dec)? 'checked': ''}}  class="dec"></input>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a href="#" onclick="update()">Сохранить</a></div>
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a style="background-color: #CD5C5C" href="/docs/pat_schedule">Отменить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var all_td = document.getElementsByClassName('with_selector')[0].querySelectorAll('td');
        for (let i = 0; i < all_td.length; i++) {
            // all_td[i].id = i;
            all_td[i].addEventListener('mouseover', () => {
                all_td[i].parentNode.style.background = '#F5F5F0'
                for (var td of all_td) {
                    if (td.cellIndex === all_td[i].cellIndex) {
                        td.style.background = '#F5F5F0'
                    }
                }
                all_td[i].style.background = '#E5E5E5'
            });
            all_td[i].addEventListener('mouseout', () => {
                all_td[i].parentNode.style.background = ''
                for (var td of all_td) {
                    if (td.cellIndex === all_td[i].cellIndex) {
                        td.style.background = ''
                    }
                }
                all_td[i].style.background = ''
            });
        }
        document.addEventListener('DOMContentLoaded', function test() {
            var date = new Date();
            document.getElementById('year').value = date.getFullYear()
        })

        function update() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var params = ['id_do', 'reg_num_opo', 'id_opo', 'year']
            let themes = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec',]
            let str;
            var out_data = []


            for (var param of params) {
                out_data[param] = document.getElementById(param).value
            }
            for (let theme of themes) {
                str = ''
                let boxes = document.querySelectorAll('.' + theme);
                for (let box of boxes) {
                    if (box.checked) {
                        str = str + box.value + ', '
                    }
                    out_data[theme] = str.slice(0, -2)
                }
            }
            console.log(out_data)
            $.ajax({
                url: '/docs/pat_schedule/update/{{$data->id}}',
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                    console.log(out_data)
                    window.location.href = '/docs/pat_schedule'
                },
                error: (e) => {
                    console.log(e)
                }

            })
        }
    </script>
@endsection
