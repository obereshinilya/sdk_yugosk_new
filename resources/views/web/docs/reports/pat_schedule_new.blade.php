@extends('web.layouts.app')
@section('title')
    Добавление
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
                        <h2 class="text-muted" style="text-align: center">Добавление записи в график комплексных ПАТ
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
                                    <td style="padding: 0px">
                                        <input style="width: 20%; " type="number"
                                               id="year" class="text-field__input" min="1970" max="2030">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Наименование филиала</th>
                                    <td style="padding: 0px"><select id="id_do" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            @foreach($do as $row)
                                                <option value="{{$row->id_do}}">{{$row->short_name_do}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <th>Рег. № ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="reg_num_opo" style="width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr>
                                    <th>Наименование ОПО</th>
                                    <td style="padding: 0px"><select id="id_opo" style="height: 100%; width: 50%"
                                                                     class="select-css">
                                            @foreach($opo as $row)
                                                <option value="{{$row->id_opo}}">{{$row->full_name_opo}}</option>
                                            @endforeach
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
                                @foreach($data as $row)

                                    <tr>
                                        <th style="text-align: center">{{$row->id}}</th>
                                        <td style="padding: 0px">
                                            {{$row->pat_desc}}
                                        </td>
                                        <td style="padding: 0px;">
                                            <input type="checkbox" value="{{$row->id}}" class="jan"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}" class="feb"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}" class="mar"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}" class="apr"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}" class="may"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}" class="jun"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}" class="jul"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}" class="aug"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}" class="sep"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}" class="oct"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}" class="nov"></input>
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="checkbox" value="{{$row->id}}" class="dec"></input>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a href="#" onclick="save()">Сохранить</a></div>
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

        function save() {
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
            $.ajax({
                url: '/docs/pat_schedule/save',
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                    // console.log(res)
                    if (typeof res === 'object') {
                        alert('Запись для данного ОПО на указанный год уже существует!')
                    } else {
                        window.location.href = '/docs/pat_schedule'

                    }
                },
                error: (e) => {
                    console.log(e)
                }

            })
        }
    </script>
@endsection
