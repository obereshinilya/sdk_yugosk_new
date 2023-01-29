@extends('web.layouts.app')

@section('title')
    Сведения об аварийности на ОПО ДО
@endsection

@section('content')
    {{--    Включаем всплывашку с новым сообщением о событии--}}
    @can('events-view')
        @include('web.admin.inc.new_JAS')
    @endcan
    @include('web.include.sidebar_doc')
    <style>
        th, td {
            word-break: break-word;
        }

        .form51 table tr th {
            padding: 2px 3px
        }

        .form51 table tr td {
            padding: 2px 3px
        }

        @can('report-edit')
    #table_for_search tr td:last-of-type {
            /*display: flex;*/
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 15px 0;
        }

        @endcan
    table {
            -webkit-print-color-adjust: exact; /* благодаря этому заработал цвет*/
            white-space: -moz-pre-wrap; /* Mozilla, начиная с 1999 года */
            white-space: -pre-wrap; /* Opera 4-6 */
            white-space: -o-pre-wrap; /* Opera 7 */
            word-wrap: break-word;
        / word-break: break-all;
        }
    </style>
    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline-block; margin-right: 10px">
                            Сведения об аварийности
                            на ОПО ДО с
                        </h2>
                        <input style="width: 5%; display: inline-block; margin-right: 10px" type="number"
                               id="select__year" class="text-field__input" min="1970" max="2030"
                               onblur="get_data()"></input>
                        <h2 class="text-muted" style="text-align: center; display: inline;"> по </h2>
                        <input style="width: 5%; display: inline-block; margin-right: 10px" type="number"
                               id="select__year_end" class="text-field__input" min="1970" max="2030"
                               onblur="get_data()"></input>
                        <h2 class="text-muted" style="text-align: center; display: inline;">год</h2>
                    </div>
                    <div class="doc_header" style="padding-bottom: 6px">
                        <table>
                            <tbody>
                            <tr>
                                <td style="width: 3%"><img alt="" src="{{asset('assets/images/icons/search.svg')}}">
                                </td>
                                <td><input type="text" id="search_text" placeholder="Поиск..."></td>
                                <td>
                                    @can('doc-create')
                                        <div class="bat_info" style="display: inline-block"><a
                                                href="#openModal1"
                                                style="display: inline-block">Экспорт в excel</a>
                                        </div>
                                        <div class="bat_info" style="display: inline-block; margin-left: 0px"><a
                                                href="#openModal"
                                                style="display: inline-block">Печать в pdf</a>
                                        </div>
                                    @endcan
                                    @can('entries-add')
                                        <div class="bat_add" style="display: inline-block; margin-left: 0;"><a
                                                href="/docs/sved_avar/create">Добавить запись</a></div>
                                    @endcan
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:73.5vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px; width: 200%" class="form51">
                            <table id="table_for_search" style="display: table; table-layout: fixed; width: 100%">
                                @can('report-edit')
                                    <colgroup>
                                        <col style="width: 3%">
                                        <col style="width: 7%">
                                        <col style="width: 5%">
                                        <col style="width: 7%">
                                        <col style="width: 6%">
                                        <col style="width: 8%">
                                        <col style="width: 9%">
                                        <col style="width: 5%">
                                        <col style="width: 6%">
                                        <col style="width: 6%">
                                        <col style="width: 6%">
                                        <col style="width: 13%">
                                        <col style="width: 6%">
                                        <col style="width: 6%">
                                        <col style="width: 3%">
                                    </colgroup>
                                @endcan
                                <thead>
                                <tr>
                                    <th style="text-align: center; padding: 10px 2px">№ п/п</th>
                                    <th style="text-align: center; padding: 10px 2px">Филиал ДО</th>
                                    <th style="text-align: center; padding: 10px 2px">Вид техногенного события (ТС)</th>
                                    <th style="text-align: center; padding: 10px 2px">Место ТС, рег. номер, дата рег.
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px">Дата и время ТС (МСК)</th>
                                    <th style="text-align: center; padding: 10px 2px">Вид аварии</th>
                                    <th style="text-align: center; padding: 10px 2px">Описание ТС</th>
                                    <th style="text-align: center; padding: 10px 2px">Наличие пострадавших</th>
                                    <th style="text-align: center; padding: 10px 2px">Экономический ущерб, тыс. руб.
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px">Длительность простоя</th>
                                    <th style="text-align: center; padding: 10px 2px">Ответственные лица и меры
                                        воздействия
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px">Мероприятия, предложенные
                                        комиссией
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px">Отметка о выполнении мероприятия
                                    </th>
                                    <th style="text-align: center; padding: 10px 2px">Индикативный показатель</th>
                                    @can('report-edit')
                                        <th></th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody id="body_table">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="openModal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#close" class="close">×</a>
                    </div>
                    <div class="modal-body">
                        <table class="modal_table map_hover">
                            <thead>
                            <th colspan="2">Выберите период</th>

                            </thead>

                            <tbody>
                            <tr>
                                <td style="text-align: center">
                                    <input type="date" class="text-field__input" style="width: 94%" id="start_date_pdf"
                                           onchange="getprint()" max="{{date('Y-m-d')}}">

                                </td>
                                <td style="text-align: center">
                                    <input type="date" class="text-field__input" style="width: 94%" id="finish_date_pdf"
                                           onchange="getprint()" max="{{date('Y-m-d')}}">


                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center">
                                    <div class="bat_info print__pdf" style="display: inline-block; margin-left: 0"><a
                                            href="#openModal"
                                            style="display: inline-block; margin: 0">Печать</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="openModal1" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#close" class="close">×</a>
                    </div>
                    <div class="modal-body">
                        <table class="modal_table map_hover">
                            <thead>
                            <th colspan="2">Выберите период</th>

                            </thead>

                            <tbody>
                            <tr>
                                <td style="text-align: center">
                                    <input type="date" class="text-field__input" style="width: 94%"
                                           id="start_date_excel" onchange="getexcel()" max="{{date('Y-m-d')}}">

                                </td>
                                <td style="text-align: center">
                                    <input type="date" class="text-field__input" style="width: 94%"
                                           id="finish_date_excel" onchange="getexcel()" max="{{date('Y-m-d')}}">


                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center">
                                    <div class="bat_info print__excel" style="display: inline-block; margin-left: 0"><a
                                            href="#openModal"
                                            style="display: inline-block; margin: 0">Выгрузка в excel</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var date = new Date();
                document.getElementById('select__year').value = date.getFullYear()
                document.getElementById('select__year_end').value = date.getFullYear()
                get_data()
            })

            function getprint() {
                let pdf = document.querySelector('.print__pdf');
                pdf.firstChild.href = /pdf_sved_avar/ + document.getElementById('start_date_pdf').value + '/' + document.getElementById('finish_date_pdf').value;

            }

            function getexcel() {
                let pdf = document.querySelector('.print__excel');
                pdf.firstChild.href = /excel_sved_avar/ + document.getElementById('start_date_excel').value + '/' + document.getElementById('finish_date_excel').value;

            }

            function get_data() {
                var table_body = document.getElementById('body_table')
                table_body.innerText = ''
                if (Number(document.getElementById('select__year').value) > Number(document.getElementById('select__year_end').value)){
                    alert('Неверно указаны даты!')
                }else {
                    $.ajax({
                        url: '/docs/get_sved_avar/' + document.getElementById('select__year').value + '/' + document.getElementById('select__year_end').value ,
                        type: 'GET',
                        success: (res) => {
                            var num = 1
                            for (var row of res) {
                                var tr = document.createElement('tr')
                                tr.innerHTML += `<td style="text-align: center">${num}</td>`
                                tr.innerHTML += `<td style="text-align: center">${row['name_do']}</td>`
                                tr.innerHTML += `<td style="text-align: center">${row['vid_techno_sob']}</td>`
                                tr.innerHTML += `<td style="text-align: center">${row['mesto_techno_sob']}</td>`

                                var newDate = new Date(row['data_time']);


                                let dd = newDate.getDate();
                                if (dd < 10) dd = '0' + dd;

                                let mm = newDate.getMonth() + 1;
                                if (mm < 10) mm = '0' + mm;

                                let yyyy = newDate.getFullYear();

                                tr.innerHTML += `<td style="text-align: center">${dd}.${mm}.${yyyy} ${newDate.toISOString().split('T')[1].split('.')[0]}</td>`
                                tr.innerHTML += `<td style="text-align: center">${row['vid_avari']}</td>`
                                tr.innerHTML += `<td style="text-align: center">${row['kratk_opisan']}</td>`
                                tr.innerHTML += `<td style="text-align: center">${row['nalich_postradav']}</td>`
                                tr.innerHTML += `<td style="text-align: center">${row['econom_usherb']}</td>`
                                tr.innerHTML += `<td style="text-align: center">${row['prodolgit_prost']}</td>`
                                tr.innerHTML += `<td style="text-align: center">${row['litsa_otvetstven']}</td>`
                                tr.innerHTML += `<td style="text-align: center">${row['meropriytia']}</td>`
                                if (row['otmetka_vypoln']) {
                                    tr.innerHTML += `<td style="text-align: center">Выполнено</td>`

                                } else {
                                    tr.innerHTML += `<td style="text-align: center">Не выполнено</td>`
                                }
                                tr.innerHTML += `<td style="text-align: center">${row['indikativn_pokazat']}</td>`
                                tr.innerHTML += ` @can('report-edit') <td style="text-align: center"><a href="#" onclick="edit_record(${row['id']})">
                                                                            <img style="margin-left: 8px" alt=""
                                                                                 src="{{asset('assets/images/icons/edit.svg')}}" class="check_i">
                                                                        </a>
                                                                        <a href="#" onclick="remove_record(${row['id']})">
                                                                            <img style="margin-left: 5px" alt=""
                                                                                 src="{{asset('assets/images/icons/trash.svg')}}" class="trash_i">
                                                                        </a></td> @endcan`
                                table_body.appendChild(tr)
                                num += 1
                            }
                        },
                        error: function (error) {
                            var table_body = document.getElementById('body_table')
                            table_body.innerText = ''
                        },

                    })
                }
            }

            //скрипт для удаления
            function remove_record(id) {
                $.ajax({
                    url: '/docs/sved_avar/remove/' + id,
                    type: 'GET',
                    success: (res) => {
                        window.location.href = '/docs/sved_avar'
                    }
                })
            }

            //скрипт для изменения
            function edit_record(id) {
                window.location.href = '/docs/sved_avar/edit/' + id
            }


            //скрипт для поиска
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
