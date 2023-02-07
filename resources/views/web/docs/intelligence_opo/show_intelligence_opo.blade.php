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
    </style>

    <div class="inside_content">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h2 class="text-muted" style="text-align: center; padding: 3px">Просмотр записи в сведениях,
                            характеризующих ОПО
                        </h2>
                    </div>

                    <div class="inside_tab_padding form51"
                         style="height:78vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <col style="width: 5%">
                                <col style="width: 30%">
                                <col style="width: 60%">
                                <thead>
                                <tr>
                                    <th style="text-align: left" colspan="3"><b>1. Опасный производственный объект</b>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: center">№ п/п</th>
                                    <th style="text-align: center">Наименование</th>
                                    <th style="text-align: center">Содержание</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th style="text-align: center">1.1.</th>
                                    <th style="text-align: left">Полное наименование ОПО</th>
                                    <td style="padding: 0px"><input disabled type="text" id="full_name_opo"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->full_name_opo}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.2.</th>
                                    <th style="text-align: left">Типовое наименование (именной код объекта)</th>
                                    <td style="padding: 0px"><select disabled id="type_name"
                                                                     style="height: 100%; width: 98%"
                                                                     class="select-css">
                                            <option
                                                value="{{$data->type_name}}">{{\App\Models\intelligence_opo_model\opo_parts::where('id_parts', '=', $data->type_name)->first()->object_list}}</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.3.</th>
                                    <th style="text-align: left">Цифровое обозначение раздела (подраздела) отраслевой
                                        принадлежности
                                        (вида деятельности)
                                    </th>
                                    <td style="padding: 0px"><input disabled type="int" id="section_number"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->section_number}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.4.</th>
                                    <th style="text-align: left">Место нахождения (адрес) ОПО</th>
                                    <td style="padding: 0px"><input disabled type="text" id="address_opo"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->address_opo}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.5.</th>
                                    <th style="text-align: left">Код ОКТМО</th>
                                    <td style="padding: 0px"><input disabled type="text" id="oktmo"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->oktmo}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.6.</th>
                                    <th style="text-align: left">Дата ввода объекта в эксплуатацию (при наличии)</th>
                                    <td style="padding: 0px"><input disabled type="date" id="date_commiss"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->date_commiss}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.7.</th>
                                    <th style="text-align: left" colspan="2">Собственник ОПО <em>(*указывается
                                            в случае, если заявитель не является собственником ОПО)</em></th>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.7.1</th>
                                    <th style="text-align: left">Полное наименование юридического лица,
                                        организационно-правовая форма или фамилия, имя, отчество (при наличии)
                                        индивидуального предпринимателя
                                    </th>
                                    <td style="padding: 0px"><input type="text"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" disabled
                                                                    value="Публичное Акционерное Общество «Газпром»">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.7.2</th>
                                    <th style="text-align: left">Идентификационный номер налогоплательщика (ИНН)</th>
                                    <td style="padding: 0px"><input type="text"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" disabled
                                                                    value="7736050003"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.8.</th>
                                    <th style="text-align: left">Полное наименование юридического лица</th>
                                    <td style="padding: 0px"><input disabled type="text" id="full_name_legal_entity"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->full_name_legal_entity}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.9.</th>
                                    <th style="text-align: left">Идентификационный номер налогоплательщика (ИНН)</th>
                                    <td style="padding: 0px"><input disabled type="text" id="inn"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->inn}}"></td>
                                </tr>
                                </tbody>
                            </table>
                            <table>
                                <col style="width: 5%">
                                <col style="width: 91.5%">
                                <col style="width: 3.5%">
                                <thead>
                                <tr>
                                    <th style="text-align: left" colspan="3"><b>2. Признаки опасности ОПО и их числовые
                                            обозначения</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th style="text-align: center">2.1.</th>
                                    <th style="text-align: left"> Получение, использование, переработка,
                                        образование, хранение, транспортирование, уничтожение опасных веществ,
                                        предусмотренных пунктом 1 приложения 1 к Федеральному закону № 116-ФЗ
                                        Федеральному закону от 21 июля 1997 г. № 116-ФЗ "О промышленной безопасности
                                        опасных производственных объектов" (далее - Федеральный закон № 116-ФЗ)
                                        в количествах, указанных в приложении 2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_2_1"
                                                                          value="{{$data->chk_2_1}}" {{$data->chk_2_1 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">2.2.</th>
                                    <th style="text-align: left" colspan="2">Использование оборудования, работающего под
                                        избыточным давлением более 0,07 МПа
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: left">а) пара, газа (в газообразном, сжиженном состоянии)
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_2_1_a"
                                                                          value="{{$data->chk_2_1_a}}" {{$data->chk_2_1_a ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: left">б) воды при температуре нагрева более 115 градусов
                                        Цельсия
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_2_1_b"
                                                                          value="{{$data->chk_2_1_b}}" {{$data->chk_2_1_b ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: left">в) иных жидкостей при температуре,
                                        превышающей температуру их кипения при избыточном давлении 0,07 МПа
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_2_1_v"
                                                                          value="{{$data->chk_2_1_v}}" {{$data->chk_2_1_v ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">2.3.</th>
                                    <th style="text-align: left"> Использование стационарно установленных грузоподъемных
                                        механизмов (за исключением лифтов, подъемных платформ для инвалидов),
                                        эскалаторов в метрополитенах, канатных дорог, фуникулеров
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_2_3"
                                                                          value="{{$data->chk_2_3}}" {{$data->chk_2_3 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">2.4.</th>
                                    <th style="text-align: left"> Получение, транспортирование, использование расплавов
                                        черных и цветных металлов, сплавов на основе этих расплавов с применением
                                        оборудования, рассчитанного на максимальное количество расплава 500 килограммов
                                        и более
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_2_4"
                                                                          value="{{$data->chk_2_4}}" {{$data->chk_2_4 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">2.5.</th>
                                    <th style="text-align: left">Ведение горных работ (за исключением добычи
                                        обще распространенных полезных ископаемых и разработки россыпных месторождений
                                        полезных ископаемых, осуществляемых открытым способом без применения взрывных
                                        работ), работ по обогащению полезных ископаемых
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_2_5"
                                                                          value="{{$data->chk_2_5}}" {{$data->chk_2_5 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">2.6.</th>
                                    <th style="text-align: left">Осуществление хранения или переработки растительного
                                        сырья, в процессе которых образуются взрывоопасные пылевоздушные смеси,
                                        способные самовозгораться, возгораться от источника зажигания и самостоятельно
                                        гореть после его удаления, а также осуществление хранения зерна, продуктов его
                                        переработки и комбикормового сырья, склонных к самосогреванию и самовозгоранию
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_2_6"
                                                                          value="{{$data->chk_2_6}}" {{$data->chk_2_6 ? 'checked':''}}>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table>
                                <col style="width: 5%">
                                <col style="width: 91.5%">
                                <col style="width: 3.5%">
                                <thead>
                                <tr>
                                    <th style="text-align: left" colspan="3"><b>3. Класс опасности ОПО и его числовое
                                            обозначение</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th style="text-align: center">3.1.</th>
                                    <th style="text-align: left">ОПО чрезвычайно высокой опасности (I класс)</th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_3_1"
                                                                          value="{{$data->chk_3_1}}" {{$data->chk_3_1 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">3.2.</th>
                                    <th style="text-align: left">ОПО высокой опасности (II класс)</th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_3_2"
                                                                          value="{{$data->chk_3_2}}" {{$data->chk_3_2 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">3.3.</th>
                                    <th style="text-align: left">ОПО средней опасности (III класс)</th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_3_3"
                                                                          value="{{$data->chk_3_3}}" {{$data->chk_3_3 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">3.4.</th>
                                    <th style="text-align: left">ОПО низкой опасности (IV класс)</th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_3_4"
                                                                          value="{{$data->chk_3_4}}" {{$data->chk_3_4 ? 'checked':''}}>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <table>
                                <col style="width: 5%">
                                <col style="width: 91.5%">
                                <col style="width: 3.5%">
                                <thead>
                                <tr>
                                    <th style="text-align: left" colspan="3"><b>4. Классификация ОПО:</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th style="text-align: center">4.1.</th>
                                    <th style="text-align: left"> ОПО, указанные в пункте 1 приложения 2 к Федеральному
                                        закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_1"
                                                                          value="{{$data->chk_4_1}}" {{$data->chk_4_1 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.2.</th>
                                    <th style="text-align: left">ОПО по хранению химического оружия,
                                        объектов по уничтожению химического оружия и ОПО спецхимии, указанные в пункте
                                        2 приложения 2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_2"
                                                                          value="{{$data->chk_4_2}}" {{$data->chk_4_2 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.3.</th>
                                    <th style="text-align: left">ОПО бурения и добычи нефти, газа и
                                        газового конденсата, указанные в пункте 3 приложения 2 к Федеральному закону
                                        № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_3"
                                                                          value="{{$data->chk_4_3}}" {{$data->chk_4_3 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.4.</th>
                                    <th style="text-align: left">ОПО газораспределительных станций,
                                        сетей газораспределения и сетей газопотребления, предусмотренные пунктом
                                        4 приложения 2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_4"
                                                                          value="{{$data->chk_4_4}}" {{$data->chk_4_4 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.5.</th>
                                    <th style="text-align: left">ОПО, предусмотренные пунктом 5 приложения
                                        2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_5"
                                                                          value="{{$data->chk_4_5}}" {{$data->chk_4_5 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.6.</th>
                                    <th style="text-align: left">ОПО, предусмотренные пунктом 6
                                        приложения 2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_6"
                                                                          value="{{$data->chk_4_6}}" {{$data->chk_4_6 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.7.</th>
                                    <th style="text-align: left">ОПО, предусмотренные пунктом 7 приложения
                                        2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_7"
                                                                          value="{{$data->chk_4_7}}" {{$data->chk_4_7 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.8.</th>
                                    <th style="text-align: left">ОПО, предусмотренные пунктом 8 приложения
                                        2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_8"
                                                                          value="{{$data->chk_4_8}}" {{$data->chk_4_8 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.9.</th>
                                    <th style="text-align: left">ОПО, предусмотренные пунктом 9 приложения
                                        2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_9"
                                                                          value="{{$data->chk_4_9}}" {{$data->chk_4_9 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.10.</th>
                                    <th style="text-align: left">Наличие факторов, предусмотренных пунктом
                                        10 приложения 2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_10"
                                                                          value="{{$data->chk_4_10}}" {{$data->chk_4_10 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.11.</th>
                                    <th style="text-align: left">Наличие факторов, предусмотренных пунктом
                                        11 приложения 2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_11"
                                                                          value="{{$data->chk_4_11}}" {{$data->chk_4_11 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: left">на землях особо охраняемых природных территорий</th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_11_a"
                                                                          value="{{$data->chk_4_11_a}}" {{$data->chk_4_11_a ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: left">на континентальном шельфе Российской Федерации</th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_11_b"
                                                                          value="{{$data->chk_4_11_b}}" {{$data->chk_4_11_b ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: left">во внутренних морских водах, территориальном море или
                                        прилежащей зоне Российской Федерации
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_11_v"
                                                                          value="{{$data->chk_4_11_v}}" {{$data->chk_4_11_v ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.12.</th>
                                    <th style="text-align: left">ОПО, аварии на котором могут иметь трансграничное
                                        воздействие
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_4_12"
                                                                          value="{{$data->chk_4_12}}" {{$data->chk_4_12 ? 'checked':''}}>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table>
                                <col style="width: 5%">
                                <col style="width: 91.5%">
                                <col style="width: 3.5%">
                                <thead>
                                <tr>
                                    <th style="text-align: left" colspan="3"><b>5. Виды деятельности, на осуществление
                                            которых требуется получение лицензии для эксплуатации ОПО</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th style="text-align: center">5.1.</th>
                                    <th style="text-align: left">Эксплуатация взрывопожароопасных и химически опасных
                                        производственных объектов I, II и III классов опасности
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_5_1"
                                                                          value="{{$data->chk_5_1}}" {{$data->chk_5_1 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">5.2.</th>
                                    <th style="text-align: left">Деятельность, связанная с обращением взрывчатых
                                        материалов промышленного назначения
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_5_2"
                                                                          value="{{$data->chk_5_2}}" {{$data->chk_5_2 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">5.3.</th>
                                    <th style="text-align: left">Деятельность, связанная с производством маркшейдерских
                                        работ
                                    </th>
                                    <td style="text-align: center"><input disabled class="check" type="checkbox"
                                                                          id="chk_5_3"
                                                                          value="{{$data->chk_5_3}}" {{$data->chk_5_3 ? 'checked':''}}>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table>
                                <col style="width: 5%">
                                <col style="width: 20%">
                                <col style="width: 18%">
                                <col style="width: 16%">
                                <col style="width: 17%">
                                <col style="width: 16%">
                                <thead>
                                <tr>
                                    <th style="text-align: left" colspan="7"><b>6. Сведения о составе ОПО</b>

                                    </th>
                                </tr>
                                <tr>
                                    <th>№ п/п</th>
                                    <th>Наименование площадки, участка, цеха, здания, сооружения, входящих в состав
                                        ОПО
                                    </th>
                                    <th>Краткая характеристика опасности</th>
                                    <th>Наименование опасного вещества</th>
                                    <th>Проектные (эксплуатационные) характеристики технических устройств</th>
                                    <th>Числовое обозначение признака опасности</th>

                                </tr>
                                </thead>
                                <tbody id="tbody_part">

                                </tbody>
                            </table>
                            <table>
                                <thead>
                                <tr>
                                    <th style="text-align: left" colspan="3"><b>
                                            Суммарное количество опасного вещества по видам в тоннах на ОПО
                                            в соответствии с таблицами 1 и 2 приложения 2 к Федеральному закону №
                                            116-ФЗ:
                                            <br> - Опасное вещество: газ – 794,731 т.
                                            <br> - горючее вещество: жидкость – 792,715 т.</b>
                                    </th>
                                </tr>
                                </thead>
                            </table>
                            <table>
                                <col style="width: 5%">
                                <col style="width: 95%">
                                <thead>
                                <tr>
                                    <th style="text-align: left" colspan="3"><b>7. Количество опасных веществ на ОПО
                                            в тоннах, находящихся на расстоянии менее 500 метров на других ОПО заявителя
                                            или иной организации по видам в соответствии с таблицами 1 и 2 приложения 2
                                            к Федеральному закону № 116-ФЗ (при наличии):</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th style="text-align: left" colspan="3">«Автомобильная газонаполнительная
                                        компрессорная
                                        станция Краснотурьинского линейного производственного управления магистральных
                                        газопроводов», класс опасности IV, регистрационный № А58-80046-0211,
                                        воспламеняющиеся вещества: газ - 0,558 т.
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                            <table>
                                <col style="width: 5%">
                                <col style="width: 40%">
                                <col style="width: 54%">
                                <thead>
                                <tr>
                                    <th style="text-align: left" colspan="3"><b>8. Заявитель</b></th>
                                </tr>
                                <tr>
                                    <th style="text-align: center">№ п/п</th>
                                    <th style="text-align: center">Наименование</th>
                                    <th style="text-align: center">Содержание</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th style="text-align: center">8.1.</th>
                                    <th style="text-align: left">Полное наименование юридического лица,
                                        организационно-правовая форма или фамилия, имя, отчество (при наличии)
                                        индивидуального предпринимателя
                                    </th>
                                    <td style="padding: 0px"><input disabled type="text" id="full_name_le"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->full_name_le}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">8.2.</th>
                                    <th style="text-align: left">Адрес заявителя (адрес в пределах места нахождения
                                        юридического лица либо адрес регистрации по месту жительства (пребывания)
                                        индивидуального предпринимателя)
                                    </th>
                                    <td style="padding: 0px"><input disabled type="text" id="applicants_address"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->applicants_address}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">8.3.</th>
                                    <th style="text-align: left">Должность руководителя</th>
                                    <td style="padding: 0px"><input disabled type="text" id="head_position"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->head_position}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">8.4.</th>
                                    <th style="text-align: left">Фамилия, имя, отчество (при наличии) руководителя</th>
                                    <td style="padding: 0px"><input disabled type="text" id="surname_head"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->surname_head}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">8.5.</th>
                                    <th style="text-align: left">Подпись руководителя</th>
                                    <td style="padding: 0px"><input disabled type="text" id="sign"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" value="{{$data->sign}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">8.6.</th>
                                    <th style="text-align: left">Дата подписания руководителем</th>
                                    <td style="padding: 0px"><input disabled type="text" id="date_signing"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->date_signing}}"></td>
                                </tr>
                                </tbody>
                            </table>
                            <table>
                                <col style="width: 5%">
                                <col style="width: 40%">
                                <col style="width: 54%">
                                <thead>
                                <tr>
                                    <th style="text-align: left" colspan="3"><b>9. Реквизиты ОПО и территориального
                                            органа Ростехнадзора</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th style="text-align: center">9.1.</th>
                                    <th style="text-align: left">Регистрационный номер</th>
                                    <td style="padding: 0px"><input disabled type="text" id="registration_number"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->registration_number}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.2.</th>
                                    <th style="text-align: left">Дата регистрации</th>
                                    <td style="padding: 0px"><input disabled type="date" id="date_registration"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->date_registration}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.3.</th>
                                    <th style="text-align: left">Дата внесения изменений</th>
                                    <td style="padding: 0px"><input disabled type="date" id="date_change"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->date_change}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.4.</th>
                                    <th style="text-align: left">Полное наименование территориального органа
                                        Ростехнадзора
                                    </th>
                                    <td style="padding: 0px"><input disabled type="text" id="name_rostekhnadzor"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->name_rostekhnadzor}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.5.</th>
                                    <th style="text-align: left">Должность уполномоченного лица территориального
                                        органа Ростехнадзора
                                    </th>
                                    <td style="padding: 0px"><input disabled type="text" id="position_person_rostekh"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->position_person_rostekh}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.6.</th>
                                    <th style="text-align: left">Фамилия, имя, отчество (при наличии) уполномоченного
                                        лица территориального органа Ростехнадзора
                                    </th>
                                    <td style="padding: 0px"><input disabled type="text" id="full_name_person_rostekh"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->full_name_person_rostekh}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.7.</th>
                                    <th style="text-align: left">Подпись уполномоченного лица территориального
                                        органа Ростехнадзора
                                    </th>
                                    <td style="padding: 0px"><input disabled type="text" id="sign_person_rostekh"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->sign_person_rostekh}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.8.</th>
                                    <th style="text-align: left">Дата подписания уполномоченным лицом
                                        территориального органа Ростехнадзора
                                    </th>
                                    <td style="padding: 0px"><input disabled type="text" id="date_person_rostekh"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->date_person_rostekh}}"></td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="text-align: center">

                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a style="background-color: #CD5C5C" href="/docs/opo">Назад</a>
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
            get_parts()
        })

        function get_parts() {
            $.ajax({
                url: '/docs/intelligence_opo/get_part/{{$data->id_add_info_opo}}',
                type: 'GET',
                success: (res) => {
                    var tbody = document.getElementById('tbody_part')
                    tbody.innerHTML = ''
                    if (res.length) {
                        var i = 1
                        for (var row of res) {
                            var tr = document.createElement('tr')
                            tr.innerHTML += `<td style="text-align: center">${i}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['name_part']}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['desc']}</td>`
                            let str = '';
                            if (row['name_tu'].split(',!').length > 2) {
                                for (var j = 0; j < row['name_tu'].split(',!').length - 1; j++) {
                                    str += `${row['name_tu'].split(',!')[j]} <br>`
                                    if (row['st_num'].split(',!')[j]) {
                                        str += `ст. № ${row['st_num'].split(',!')[j]} <br>`
                                    }
                                    if (row['zav_num'].split(',!')[j]) {
                                        str += ` Зав № ${row['zav_num'].split(',!')[j]} <br>`
                                    }
                                    if (row['reg_num'].split(',!')[j]) {
                                        str += `  Рег № ${row['reg_num'].split(',!')[j]} <br>`
                                    }
                                    if (row['inv_num'].split(',!')[j]) {
                                        str += `Инв № ${row['inv_num'].split(',!')[j]} <br>`
                                    }
                                }
                            } else {
                                str += `${row['name_tu'].split(',!')[0]} <br>`
                                if (row['st_num'].split(',!')[0]) {
                                    str += `ст. № ${row['st_num'].split(',!')[0]} <br>`
                                }
                                if (row['zav_num'].split(',!')[0]) {
                                    str += ` Зав № ${row['zav_num'].split(',!')[0]} <br>`
                                }
                                if (row['reg_num'].split(',!')[0]) {
                                    str += `  Рег № ${row['reg_num'].split(',!')[0]} <br>`
                                }
                                if (row['inv_num'].split(',!')[0]) {
                                    str += `Инв № ${row['inv_num'].split(',!')[0]} <br>`
                                }
                            }
                            if (row['name_dangerous_subst']) {
                                if (row['name_dangerous_subst'].split(',!').length > 2) {
                                    for (j = 0; j < row['name_dangerous_subst'].split(',!').length - 1; j++) {
                                        str += `${row['name_dangerous_subst'].split(',!')[j]} <br>`
                                    }
                                } else {
                                    str += `${row['name_dangerous_subst'].split(',!')[0]} <br>`
                                }
                            }
                            tr.innerHTML += `<td style="text-align: center">${str}</td>`
                            str = '';
                            if (row['dn']) {
                                str += `DN = ${row['dn']} мм. <br>`
                            }
                            if (row['pn']) {
                                str += `PN = ${row['pn']} МПа. <br>`
                            }
                            if (row['l']) {
                                str += `L = ${row['l']} км. <br>`
                            }
                            if (row['v']) {
                                str += `V = ${row['v']} м3 <br>`
                            }
                            if (row['n']) {
                                str += `N = ${row['n']} МВт. <br>`
                            }
                            if (row['q']) {
                                str += `Q = ${row['q']} <span>млн. м<sup>3</sup>/сут.</span> <br>`
                            }
                            if (row['pn_in']) {
                                str += `PN вх. = ${row['pn_in']} МПа. <br>`
                            }
                            if (row['pn_out']) {
                                str += `PN вых. = ${row['pn_out']} МПа. <br>`
                            }
                            if (row['capacity']) {
                                str += `Грузоподъемность - ${row['capacity']} т. <br>`
                            }
                            if (row['pn_gas']) {
                                str += `PN газа = ${row['pn_gas']} МПа. <br>`
                            }
                            if (row['pn_water']) {
                                str += `PN воды = ${row['pn_water']} МПа. <br>`
                            }
                            if (row['therm']) {
                                str += `Теплопроизводительн. - ${row['therm']} Гкал/час. <br>`
                            }
                            if (row['t_max']) {
                                str += `T макс. вых = ${row['t_max']} ºС. <br>`
                            }
                            if (row['flow_consump']) {
                                str += `Расход топлива - ${row['flow_consump']} <span> м<sup>3</sup>/час</span>. <br>`
                            }
                            str += `Год изготовления - ${row['year_manufacture']} г. <br>`;
                            str += `Год ввода в эксплуатацию - ${row['year_commis']} г. <br>`;
                            if (row['name_dangerous_subst']) {
                                str += 'Опасное вещество: <br>';
                                if (row['name_dangerous_subst'].split(',!').length > 2) {
                                    for (j = 0; j < row['name_dangerous_subst'].split(',!').length - 1; j++) {
                                        str += `${row['name_dangerous_subst'].split(',!')[j]} - ${row['count_dangerous_subst'].split(',!')[j]} т.  <br>`

                                    }
                                } else {
                                    str += `${row['name_dangerous_subst'].split(',!')[0]} - ${row['count_dangerous_subst'].split(',!')[0]} т. <br>`
                                }
                            }
                            tr.innerHTML += `<td style="text-align: center">${str}</td>`
                            tr.innerHTML += `<td style="text-align: center">${row['signs_danger']}</td>`
                            tbody.appendChild(tr)
                            i++
                        }
                    }
                }
            })
        }
    </script>

@endsection

