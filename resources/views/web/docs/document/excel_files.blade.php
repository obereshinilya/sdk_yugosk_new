@extends('web.layouts.app')
@section('title')
    Отчеты
@endsection

@section('content')
    {{--    Включаем всплывашку с новым сообщением о событии--}}
    @can('events-view')
        @include('web.admin.inc.new_JAS')
    @endcan
    @include('web.include.sidebar_doc')
    <style>
        table {
            -webkit-print-color-adjust: exact; /* благодаря этому заработал цвет*/
            white-space: -moz-pre-wrap; /* Mozilla, начиная с 1999 года */
            white-space: -pre-wrap; /* Opera 4-6 */
            white-space: -o-pre-wrap; /* Opera 7 */
            word-wrap: break-word;
            word-break: break-word;
        }
    </style>
    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline-block">Загрузка данных с системы "СтатусГТЮ"</h2>
                    </div>
                    <div class="doc_header" style="padding-bottom: 6px">
                        <table>
                            <tbody>
                            <tr>
                                <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}">
                                </td>
                                <td><input type="text" id="search_text" placeholder="Поиск..."></td>
                                <td>
                                    <form method="post" action="{{ route('upload_excel') }}"
                                          enctype="multipart/form-data">
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                        <input style="width: 40%" onchange="undisabled_button()" type="file"
                                               accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" multiple name="file[]">
                                        <button type="submit" id="button_upload" disabled class="create">Добавить <img
                                                alt="" src="{{asset('assets/images/icons/upload.svg')}}"></button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:72.5vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px; width: 100%" class="form51">
                            <table id="table_for_search" style="display: table; table-layout: fixed; width: 100%">

                                <thead>
                                <tr>
                                    <th style="width: 25%">Наименование файла</th>
                                    <th style="width: 45%">Статус загрузки</th>
                                    <th style="width: 20%">Дата загрузки</th>
                                    <th style="width: 5%"></th>
                                    <th style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody id="body_table" style="">
                                @if($message)
                                    <td colspan="5"><b>{{$message}}</b></td>
                                @endif
                                @if(count($pdf_files))
                                    @foreach($pdf_files as $key=>$image)
                                        <tr>
                                            <td style="text-align: center">{{ $image->name  }}</td>
                                            <td style="text-align: center">{{ $image->comment  }}</td>
                                            <td style="text-align: center">{{ $date[$key] }}</td>
                                            <td style="text-align: center">
                                                <a href="/docs/excel_download/{{ $image->id }}"
                                                   style="text-align: center">
                                                    <img style="height: 20px"
                                                         src="{{ asset('assets/images/icons/download.svg') }}" class="pdf_i">
                                                </a>
                                            </td>
                                            <td style="text-align: center">
                                                <a href="/docs/excel_delete/{{ $image->id }}"
                                                   style="text-align: center; margin-left: 35%">
                                                    <img style="height: 20px" alt=""
                                                         src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Данные отсутствуют</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function undisabled_button() {
            document.getElementById('button_upload').removeAttribute("disabled")
        }


        ///скрипт для поиска
        var input = document.getElementById('search_text')
        input.oninput = function () {
            setTimeout(find_it, 100);
        };

        function find_it() {
            var table_boby_rows = document.getElementById('table_for_search').getElementsByTagName('tbody')[0].getElementsByTagName('tr')  //строки по которым ищем
            var search_text = new RegExp(document.getElementById('search_text').value, 'i');   //искомый текст
            for (var i = 0; i < table_boby_rows.length; i++) {  //проходимся по строкам
                var flag_success = false   //станет true, если есть совпадение в строке
                var tds_row = table_boby_rows[i].getElementsByTagName('td')   //ячейки строки
                for (var j = 0; j < tds_row.length; j++) {   //проходимся по ячейкам
                    if (tds_row[j].textContent.match(search_text)) {
                        flag_success = true
                    }
                }
                if (flag_success) {
                    table_boby_rows[i].style.display = ""
                } else {
                    table_boby_rows[i].style.display = "none"
                }
            }
        }
    </script>

@endsection
