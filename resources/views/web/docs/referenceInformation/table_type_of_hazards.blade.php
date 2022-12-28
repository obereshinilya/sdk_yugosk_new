@extends('web.layouts.app')
@section('title')
    Cправочник видов опасных веществ
@endsection

@section('content')
    @can('events-view')
        {{--    Включаем всплывашку с новым сообщением о событии--}}
        @include('web.admin.inc.new_JAS')
    @endcan
    @include('web.include.sidebar_doc')
    @can('events-view')
        <div class="top_table">
            @include('web.include.toptable')
        </div>
    @endcan
    <style>
        td p {
            margin: 0;
            display: inline;
        }

        td {
            text-align: center;
        }
    </style>
    <div class="inside_content">
        <div class="card-header" style="margin-top: 30px"><h2 class="text-muted" style="text-align: center">Cправочник
                видов опасных веществ</h2></div>
        <div class="doc_header" style="padding-bottom: 6px">
            <table>
                <tbody>
                <tr>
                    <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}"></td>
                    <td><input type="text" id="search_text" placeholder="Поиск..."></td>
                    <td style="width: 50%"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="inside_tab_padding"
             style="overflow-y: auto; height: 54.5vh; padding-left: 0px; padding-right: 0px; margin-top: 0px">
            <div style="background: #FFFFFF; border-radius: 6px" class="row_block form51">
                <table style="display: table; table-layout: fixed" id="table_for_search">
                    <thead>
                    <tr>
                        <th style="width: 22.5%" rowspan="2">Виды опасных веществ
                        </th>
                        <th style="width: 24.5%" colspan="4">Количество опасных веществ, т
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 22.5%; position: sticky; top: 40px">I класс опасности</th>
                        <th style="width: 24.5%;  position: sticky; top: 40px">II класс опасности</th>
                        <th style="width: 22.5%;  position: sticky; top: 40px">III класс опасности</th>
                        <th style="width: 24.5%;  position: sticky; top: 40px">IV класс опасности</th>
                    </tr>
                    </thead>
                    <tbody id="body_table">
                    <tr>
                        <td><p>Воспламеняющиеся и горючие газы</p></td>
                        <td><p>2000 и более</p></td>
                        <td><p>200 и более, но менее 2000</p></td>
                        <td><p>20 и более, но менее 200</p></td>
                        <td><p>1 и более, но менее 20</p></td>
                    </tr>
                    <tr>
                        <td><p>Горючие жидкости, находящиеся на товарно-сырьевых складах и базах
                            </p></td>
                        <td><p>500 000 и более
                            </p></td>
                        <td><p>50 000 и более, но менее 500 000
                            </p></td>
                        <td><p>1000 и более, но менее 50 000
                            </p></td>
                        <td><p>-</p></td>
                    </tr>
                    <tr>
                        <td><p>Горючие жидкости, используемые в технологическом процессе или транспортируемые по
                                магистральному трубопроводу
                            </p></td>
                        <td><p>2000 и более
                            </p></td>
                        <td><p>200 и более, но менее 2000
                            </p></td>
                        <td><p>20 и более, но менее 200
                            </p></td>
                        <td><p>1 и более, но менее 20</p></td>
                    </tr>
                    <tr>
                        <td><p>Токсичные вещества
                            </p></td>
                        <td><p>2000 и более
                            </p></td>
                        <td><p>200 и более, но менее 2000
                            </p></td>
                        <td><p>20 и более, но менее 200
                            </p></td>
                        <td><p>1 и более, но менее 20</p></td>
                    </tr>
                    <tr>
                        <td><p> Высокотоксичные вещества
                            </p></td>
                        <td><p> 200 и более
                            </p></td>
                        <td><p>20 и более, но менее 200
                            </p></td>
                        <td><p>2 и более, но менее 20
                            </p></td>
                        <td><p>0,1 и более, но менее 2</p></td>
                    </tr>
                    <tr>
                        <td><p> Окисляющие вещества
                            </p></td>
                        <td><p> 2000 и более
                            </p></td>
                        <td><p>200 и более, но менее 2000
                            </p></td>
                        <td><p>20 и более, но менее 200
                            </p></td>
                        <td><p>1 и более, но менее 20</p></td>
                    </tr>
                    <tr>
                        <td><p> Взрывчатые вещества
                            </p></td>
                        <td><p> 500 и более
                            </p></td>
                        <td><p>50 и более, но менее 500
                            </p></td>
                        <td><p>менее 50
                            </p></td>
                        <td><p> -</p></td>
                    </tr>
                    <tr>
                        <td><p> Вещества, представляющие опасность для окружающей среды
                            </p></td>
                        <td><p> 2000 и более
                            </p></td>
                        <td><p>200 и более, но менее 2000
                            </p></td>
                        <td><p> 20 и более, но менее
                                200
                            </p></td>
                        <td><p> 1 и более, но менее 20</p></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        ///скрипт для поиска
        var input = document.getElementById('search_text')
        input.oninput = function () {
            setTimeout(find_it, 100);
        };

        function find_it() {
            var table_boby_rows = document.getElementById('table_for_search').getElementsByTagName('tbody')[0].getElementsByTagName('tr')  //строки по которым ищем
            if (document.getElementById('search_text').value) {
                var search_text = new RegExp(document.getElementById('search_text').value, 'i');   //искомый текст
                for (var i = 0; i < table_boby_rows.length; i++) {  //проходимся по строкам
                    var flag_success = false   //станет true, если есть совпадение в строке
                    var tds_row = table_boby_rows[i].getElementsByTagName('td')   //ячейки строки
                    for (var j = 0; j < tds_row.length; j++) {   //проходимся по ячейкам
                        if (tds_row[j].textContent.match(search_text)) {
                            console.log(search_text)

                            flag_success = true
                            // tds_row[j].childNodes[1].style.background = 'yellow';
                            tds_row[j].firstChild.style.background = 'yellow';
                        } else {
                            tds_row[j].firstChild.style.background = 'none';

                        }
                    }

                }
            } else {
                for (var i = 0; i < table_boby_rows.length; i++) {  //проходимся по строкам
                    tds_row = table_boby_rows[i].getElementsByTagName('td')   //ячейки строки
                    for (var j = 0; j < tds_row.length; j++) {   //проходимся по ячейка
                        // tds_row[j].childNodes[1].style.background = 'none';
                        tds_row[j].firstChild.style.background = 'none';

                    }
                }
            }
        }
    </script>


@endsection
