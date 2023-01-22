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
        / word-break: break-all;
        }

        .form51 table tr td {
            padding: 0px;
            margin: 0px;
        }

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
    </style>
    <div class="inside_content" style="margin-top: 0px">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header" style="text-align: center">
                        <h2 class="text-muted" style="text-align: center; display: inline-block; margin-right: 10px">
                            Сведения о выполнении
                            графика КР и ДТОиР ОПО за
                        </h2>
                        <input style="width: 5%; display: inline-block; margin-right: 10px" type="number"
                               id="select__year" class="text-field__input" min="1970" max="2030"
                               onblur="get_data()"></input>
                        <h2 class="text-muted" style="text-align: center; display: inline;">год</h2>
                        @can('doc-create')
                            <div class="bat_info" style="display: inline-block"><a
                                    href="#"
                                    onclick="window.location.href = '/pdf_kr_dtoip/' + document.getElementById('select__year').value"
                                    style="display: inline-block">Печать в pdf</a>
                            </div>
                            <div class="bat_info" style="display: inline-block"><a
                                    href="#"
                                    onclick="window.location.href = '/excel_kr_dtoip/' + document.getElementById('select__year').value"
                                    style="display: inline-block">Экспорт в excel</a>
                            </div>
                        @endcan
                    </div>
                    <div class="inside_tab_padding form51"
                         style="height:77.5vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table id="table_for_search" style="display: table; table-layout: fixed; width: 100%">
                                <colgroup>
                                    <col style="width: 3%">
                                    <col style="width: 10%">
                                    <col style="width: 15%">
                                    <col style="width: 15%">
                                    <col style="width: 5%">
                                    <col style="width: 15%">
                                    <col style="width: 15%">
                                    <col style="width: 15%">
                                    <col style="width: 10%">
                                    <col style="width: 10%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th style="text-align: center">№</th>
                                    <th style="text-align: center; padding: 10px 10px">Наименование<br>мероприятия</th>
                                    <th style="text-align: center">Наименование пункта мероприятий</th>
                                    <th style="text-align: center">Срок выполнения</th>
                                    <th style="text-align: center">Ед.<br>изм.</th>
                                    <th style="text-align: center">План год</th>
                                    <th style="text-align: center">План тек.</th>
                                    <th style="text-align: center">Факт</th>
                                    <th style="text-align: center">Показатель</th>
                                    <th style="text-align: center">Учет показателя</th>
                                </tr>
                                </thead>
                                <tbody id="tbody_table">
                                <tr>
                                    <td style="text-align: center" class="num_pp">1</td>
                                    <td style="text-align: center" rowspan="16">Диагностика и обследования</td>
                                    <td style="text-align: center" class="name_event">Внутритрубная дефектоскопия
                                        линейной части
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">км</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">2</td>
                                    <td style="text-align: center" class="name_event">Электрометрическое обследование
                                        линейной части
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">км</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">3</td>
                                    <td style="text-align: center" class="name_event">Обследование переходов через
                                        железные и автодороги
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">4</td>
                                    <td style="text-align: center" class="name_event">Обследование переходов через
                                        водные преграды
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">5</td>
                                    <td style="text-align: center" class="name_event">Обследование воздушных переходов
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">6</td>
                                    <td style="text-align: center" class="name_event">Диагностика КЦ (КС, ДКС)</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">7</td>
                                    <td style="text-align: center" class="name_event">Диагностика ГРС</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">8</td>
                                    <td style="text-align: center" class="name_event">другие виды обследований:</td>
                                    <td style="text-align: center" class="date data_table"></td>
                                    <td style="text-align: center" class="e_unit"></td>
                                    <td style="text-align: center" class="plan_year"></td>
                                    <td style="text-align: center" class="plan_month data_table"></td>
                                    <td style="text-align: center" class="fact data_table"></td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"></td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">9</td>
                                    <td style="text-align: center" class="name_event">Диагностика КЦ (ЭПБ, ТО СРД)</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">10</td>
                                    <td style="text-align: center" class="name_event">Диагностика АГНКС</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">11</td>
                                    <td style="text-align: center" class="name_event">Мониторинг русловых процессов</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">объект</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">12</td>
                                    <td style="text-align: center" class="name_event">Обследование ГХ</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">объект</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">13</td>
                                    <td style="text-align: center" class="name_event">Обследование ПРГ</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">14</td>
                                    <td style="text-align: center" class="name_event">Геодезическое позиционирование
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">объект</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">15</td>
                                    <td style="text-align: center" class="name_event">Обследование магистральных
                                        газопроводов и отводов
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">км</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">16</td>
                                    <td style="text-align: center" class="name_event">Диагностика энергооборудования
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                {{--                                Второй раздел --}}
                                <tr>
                                    <td style="text-align: center" class="num_pp">17</td>
                                    <td style="text-align: center" rowspan="11">Капитальный ремонт</td>
                                    <td style="text-align: center" class="name_event">Ремонт ЛЧ всего, в т.ч.:</td>
                                    <td style="text-align: center" class="date data_table"></td>
                                    <td style="text-align: center" class="e_unit"></td>
                                    <td style="text-align: center" class="plan_year"></td>
                                    <td style="text-align: center" class="plan_month data_table"></td>
                                    <td style="text-align: center" class="fact data_table"></td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">18</td>
                                    <td style="text-align: center" class="name_event">Замена и переукладка трубы
                                        линейной части
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">объект</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">19</td>
                                    <td style="text-align: center" class="name_event">Ремонт переходов через железные и
                                        автодороги
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">20</td>
                                    <td style="text-align: center" class="name_event">Ремонт переходов через водные
                                        преграды
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">21</td>
                                    <td style="text-align: center" class="name_event">Ремонт воздушных переходов</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">22</td>
                                    <td style="text-align: center" class="name_event">Врезка и замена
                                        запорно-регулирующей арматуры
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">23</td>
                                    <td style="text-align: center" class="name_event">Ремонт запорно-регулирующей
                                        арматуры
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">24</td>
                                    <td style="text-align: center" class="name_event">Врезка и замена камер
                                        приема-запуска очистных устройств
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">25</td>
                                    <td style="text-align: center" class="name_event">Ремонт камер приема-запуска
                                        очистных устройств
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">26</td>
                                    <td style="text-align: center" class="name_event">Ремонтно-техническое обслуживание
                                        ГРС
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">27</td>
                                    <td style="text-align: center" class="name_event">Капитальный ремонт ГРС</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                {{--                                    Третий раздел--}}
                                <tr>
                                    <td style="text-align: center" class="num_pp">28</td>
                                    <td style="text-align: center" rowspan="5">Капитальный ремонт, капитальное
                                        строительство и реконструкция
                                    </td>
                                    <td style="text-align: center" class="name_event">Реконструкция ГРС</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">29</td>
                                    <td style="text-align: center" class="name_event">Капитальный ремонт КЦ (КС, ДКС)
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">объект</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">30</td>
                                    <td style="text-align: center" class="name_event">Реконструкция КЦ (КС, ДКС)</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">объект</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">31</td>
                                    <td style="text-align: center" class="name_event">Капитальный ремонт АГНКС</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">32</td>
                                    <td style="text-align: center" class="name_event">Реконструкция АГНКС</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">шт</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                {{--                                    Четвертый раздел--}}
                                <tr>
                                    <td style="text-align: center" class="num_pp">33</td>
                                    <td style="text-align: center" rowspan="9">Телемеханизация и автоматизация</td>
                                    <td style="text-align: center" class="name_event">Телемеханизация линейной части
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">объект</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">34</td>
                                    <td style="text-align: center" class="name_event">Модернизация системы телемеханики
                                        линейной части
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">объект</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">35</td>
                                    <td style="text-align: center" class="name_event">Ремонт системы телемеханики
                                        линейной части
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">объект</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">36</td>
                                    <td style="text-align: center" class="name_event">Капитальный ремонт автоматики
                                        ГРС
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">объект</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">37</td>
                                    <td style="text-align: center" class="name_event">Модернизация автоматики ГРС</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">объект</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">38</td>
                                    <td style="text-align: center" class="name_event">ТОиР средств автоматизация КС</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit">объект</td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">39</td>
                                    <td style="text-align: center" class="name_event">Модернизация автоматики КС
                                        (реконструкция)
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit"></td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">40</td>
                                    <td style="text-align: center" class="name_event">Капитальный ремонт автоматики КС
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit"></td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">41</td>
                                    <td style="text-align: center" class="name_event">Капитальный ремонт автоматики
                                        ГПА
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit"></td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">42</td>
                                    <td style="text-align: center" class="">Изоляция</td>
                                    <td style="text-align: center" class="name_event">Переизоляция ЛЧ МГ</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit"></td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">43</td>
                                    <td style="text-align: center" class="">Средства ЭХЗ</td>
                                    <td style="text-align: center" class="name_event">Капитальный ремонт</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit"></td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">44</td>
                                    <td style="text-align: center" class="">Объекты Общества</td>
                                    <td style="text-align: center" class="name_event">Реконструкция</td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit"></td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">45</td>
                                    <td style="text-align: center" class="">Фонд скважин</td>
                                    <td style="text-align: center" class="name_event">Ремонт фонтанной и запорной
                                        арматуры, колонных головок
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit"></td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class="num_pp">46</td>
                                    <td style="text-align: center" class="">Другие виды мероприятий</td>
                                    <td style="text-align: center" class="name_event"><input type="text"
                                                                                             onchange="save(this.parentNode.parentNode)"
                                                                                             style="height: 100%; width: 83%"
                                                                                             class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="date data_table"><input type="date"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="e_unit"></td>
                                    <td style="text-align: center" class="plan_year"><input type="number" min="0"
                                                                                            step="1"
                                                                                            onchange="save(this.parentNode.parentNode)"
                                                                                            style="height: 100%; width: 83%"
                                                                                            class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="plan_month data_table"><input type="number"
                                                                                                        min="0" step="1"
                                                                                                        onchange="save(this.parentNode.parentNode)"
                                                                                                        style="height: 100%; width: 83%"
                                                                                                        class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="fact data_table"><input type="number" min="0"
                                                                                                  step="1"
                                                                                                  onchange="save(this.parentNode.parentNode)"
                                                                                                  style="height: 100%; width: 83%"
                                                                                                  class="text-field__input">
                                    </td>
                                    <td style="text-align: center" class="indicator"></td>
                                    <td style="text-align: center"><input class="check" type="checkbox"
                                                                          onclick="unchecked(this.parentNode.parentNode.getElementsByClassName('num_pp')[0].textContent)">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: center" class=""></td>
                                    <td style="text-align: center" class=""></td>
                                    <td style="text-align: center" class=""></td>
                                    <td style="text-align: center" class=""><b>Итого:</b></td>
                                    <td style="text-align: center" class=""></td>
                                    <td style="text-align: center" class="" id="plan_year_all"></td>
                                    <td style="text-align: center" class="" id="plan_month_all"></td>
                                    <td style="text-align: center" class="" id="fact_all"></td>
                                    <td style="text-align: center" id="indicator_all"></td>
                                    <td style="text-align: center"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            //скрипт для селекта с выбором года
            var select = document.getElementById('select__year')
            var year = new Date().getFullYear();
            select.value = year
            get_data()
        })

        function get_data() {
            $.ajax({
                url: '/docs/get_kr_dtoip/' + document.getElementById('select__year').value,
                type: 'GET',
                success: (res) => {
                    var all_plan = 0
                    var all_plan_month = 0
                    var all_fact = 0
                    for (var num_pp_td of document.getElementsByClassName('num_pp')) {
                        var number_in_table = num_pp_td.textContent
                        var tr = num_pp_td.parentNode
                        try {
                            if (number_in_table === '46') {
                                tr.getElementsByClassName('date')[0].getElementsByTagName('input')[0].setAttribute('disabled', 'true');
                                tr.getElementsByClassName('plan_year')[0].getElementsByTagName('input')[0].setAttribute('disabled', 'true');
                                tr.getElementsByClassName('plan_month')[0].getElementsByTagName('input')[0].setAttribute('disabled', 'true');
                                tr.getElementsByClassName('fact')[0].getElementsByTagName('input')[0].setAttribute('disabled', 'true');
                                tr.getElementsByClassName('name_event')[0].getElementsByTagName('input')[0].setAttribute('disabled', 'true');
                                tr.getElementsByClassName('date')[0].getElementsByTagName('input')[0].value = '';
                                tr.getElementsByClassName('plan_year')[0].getElementsByTagName('input')[0].value = '';
                                tr.getElementsByClassName('plan_month')[0].getElementsByTagName('input')[0].value = '';
                                tr.getElementsByClassName('fact')[0].getElementsByTagName('input')[0].value = '';
                                tr.getElementsByClassName('name_event')[0].getElementsByTagName('input')[0].value = '';
                                tr.getElementsByClassName('indicator')[0].textContent = '';
                                tr.getElementsByClassName('indicator')[0].style.background = '';
                                tr.getElementsByClassName('check')[0].removeAttribute('checked');
                            } else {
                                tr.getElementsByClassName('date')[0].getElementsByTagName('input')[0].setAttribute('disabled', 'true');
                                tr.getElementsByClassName('plan_year')[0].getElementsByTagName('input')[0].setAttribute('disabled', 'true');
                                tr.getElementsByClassName('plan_month')[0].getElementsByTagName('input')[0].setAttribute('disabled', 'true');
                                tr.getElementsByClassName('fact')[0].getElementsByTagName('input')[0].setAttribute('disabled', 'true');
                                tr.getElementsByClassName('date')[0].getElementsByTagName('input')[0].value = '';
                                tr.getElementsByClassName('plan_year')[0].getElementsByTagName('input')[0].value = '';
                                tr.getElementsByClassName('plan_month')[0].getElementsByTagName('input')[0].value = '';
                                tr.getElementsByClassName('fact')[0].getElementsByTagName('input')[0].value = '';
                                tr.getElementsByClassName('indicator')[0].textContent = '';
                                tr.getElementsByClassName('indicator')[0].style.background = '';
                                try {
                                    tr.getElementsByClassName('check')[0].removeAttribute('checked');
                                } catch (e) {

                                }
                            }
                        } catch (e) {
                        }
                        @can('report-edit')
                            try {
                            if (number_in_table === '46') {
                                tr.getElementsByClassName('date')[0].getElementsByTagName('input')[0].removeAttribute('disabled');
                                tr.getElementsByClassName('plan_year')[0].getElementsByTagName('input')[0].removeAttribute('disabled');
                                tr.getElementsByClassName('plan_month')[0].getElementsByTagName('input')[0].removeAttribute('disabled');
                                tr.getElementsByClassName('fact')[0].getElementsByTagName('input')[0].removeAttribute('disabled');
                                tr.getElementsByClassName('name_event')[0].getElementsByTagName('input')[0].removeAttribute('disabled');
                            } else {
                                tr.getElementsByClassName('date')[0].getElementsByTagName('input')[0].removeAttribute('disabled');
                                tr.getElementsByClassName('plan_year')[0].getElementsByTagName('input')[0].removeAttribute('disabled');
                                tr.getElementsByClassName('plan_month')[0].getElementsByTagName('input')[0].removeAttribute('disabled');
                                tr.getElementsByClassName('fact')[0].getElementsByTagName('input')[0].removeAttribute('disabled');
                            }
                        } catch (e) {
                        }
                        @endcan
                        if (res[number_in_table]) {
                            if (number_in_table === '46') {
                                tr.getElementsByClassName('date')[0].getElementsByTagName('input')[0].value = res[number_in_table]['date']
                                tr.getElementsByClassName('plan_year')[0].getElementsByTagName('input')[0].value = res[number_in_table]['plan_year']
                                tr.getElementsByClassName('plan_month')[0].getElementsByTagName('input')[0].value = res[number_in_table]['plan_month']
                                tr.getElementsByClassName('fact')[0].getElementsByTagName('input')[0].value = res[number_in_table]['fact']
                                tr.getElementsByClassName('name_event')[0].getElementsByTagName('input')[0].value = res[number_in_table]['name_event']
                                if (res[number_in_table]['check']) {
                                    tr.getElementsByClassName('check')[0].setAttribute('checked', true)
                                }
                                var td_ind = tr.getElementsByClassName('indicator')[0]
                                td_ind.textContent = res[number_in_table]['indicator']
                                if (Number(res[number_in_table]['indicator']) > 0) {
                                    td_ind.style.backgroundColor = ''
                                    td_ind.style.color = '#858585'
                                } else {
                                    td_ind.style.backgroundColor = '#FA8072'
                                    td_ind.style.color = 'white'
                                }
                                all_plan_month += Number(res[number_in_table]['plan_month'])
                                all_plan += Number(res[number_in_table]['plan_year'])
                                all_fact += Number(res[number_in_table]['fact'])
                            } else {
                                var tr = num_pp_td.parentNode
                                tr.getElementsByClassName('date')[0].getElementsByTagName('input')[0].value = res[number_in_table]['date']
                                tr.getElementsByClassName('plan_year')[0].getElementsByTagName('input')[0].value = res[number_in_table]['plan_year']
                                tr.getElementsByClassName('plan_month')[0].getElementsByTagName('input')[0].value = res[number_in_table]['plan_month']
                                tr.getElementsByClassName('fact')[0].getElementsByTagName('input')[0].value = res[number_in_table]['fact']
                                if (res[number_in_table]['check']) {
                                    tr.getElementsByClassName('check')[0].setAttribute('checked', true)
                                }
                                var td_ind = tr.getElementsByClassName('indicator')[0]
                                td_ind.textContent = res[number_in_table]['indicator']
                                if (Number(res[number_in_table]['indicator']) > 0) {
                                    td_ind.style.backgroundColor = ''
                                    td_ind.style.color = '#858585'
                                } else {
                                    td_ind.style.backgroundColor = '#FA8072'
                                    td_ind.style.color = 'white'
                                }
                                all_plan_month += Number(res[number_in_table]['plan_month'])
                                all_plan += Number(res[number_in_table]['plan_year'])
                                all_fact += Number(res[number_in_table]['fact'])
                            }
                        }
                    }
                    document.getElementById('plan_month_all').textContent = all_plan_month
                    document.getElementById('plan_year_all').textContent = all_plan
                    document.getElementById('fact_all').textContent = all_fact

                },
            })
        }

        function save(tr) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var params = ['num_pp', 'name_event', 'date', 'plan_year', 'plan_month', 'fact']
            var out_data = []
            for (var param of params) {
                try {
                    out_data[param] = tr.getElementsByClassName(param)[0].getElementsByTagName('input')[0].value
                } catch (e) {
                    out_data[param] = tr.getElementsByClassName(param)[0].textContent
                }
            }
            if (Number(out_data['plan_month']) > Number(out_data['fact'])) {
                out_data['indicator'] = 0
                tr.getElementsByClassName('indicator')[0].style.backgroundColor = '#FA8072'
                tr.getElementsByClassName('indicator')[0].style.color = 'white'
            } else {
                out_data['indicator'] = 1
                tr.getElementsByClassName('indicator')[0].style.backgroundColor = ''
                tr.getElementsByClassName('indicator')[0].style.color = '#858585'
            }
            var num_plan_month = 0
            for (var plan_month of document.getElementsByClassName('plan_month')) {
                try {
                    num_plan_month += Number(plan_month.getElementsByTagName('input')[0].value)
                } catch (e) {

                }
            }
            var num_plan_year = 0
            for (var plan_year of document.getElementsByClassName('plan_year')) {
                try {
                    num_plan_year += Number(plan_year.getElementsByTagName('input')[0].value)
                } catch (e) {

                }
            }
            var num_fact = 0
            for (var fact of document.getElementsByClassName('fact')) {
                try {
                    num_fact += Number(fact.getElementsByTagName('input')[0].value)
                } catch (e) {

                }
            }
            document.getElementById('plan_month_all').textContent = num_plan_month
            document.getElementById('plan_year_all').textContent = num_plan_year
            document.getElementById('fact_all').textContent = num_fact
            tr.getElementsByClassName('indicator')[0].textContent = out_data['indicator']
            $.ajax({
                url: '/docs/save_kr_dtoip/' + document.getElementById('select__year').value,
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                }
            })
        }

        //скрипт, чтоб не учитывать
        function unchecked(num_pp) {
            $.ajax({
                url: '/uncheck_kr_dtoip/' + num_pp + '/' + document.getElementById('select__year').value,
                type: 'GET',
                success: (res) => {
                }
            })
        }
    </script>

@endsection
