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
                        <h2 class="text-muted" style="text-align: center; padding: 3px">Редактирование записи в
                            сведениях, характеризующие ОПО
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
                                    <td style="padding: 0px"><input type="text" id="full_name_opo"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->full_name_opo}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.2.</th>
                                    <th style="text-align: left">Типовое наименование (именной код объекта)</th>
                                    <td style="padding: 0px"><select id="type_name" style="height: 100%; width: 98%"
                                                                     class="select-css" value="{{$data->type_name}}"
                                                                     onchange="
                                                                 switch (Number(this.value)) {
                                                                        case 1:
                                                                        case 2:
                                                                        case 3:
                                                                        case 4:
                                                                        case 8:
                                                                            document.getElementById('section_number').value=5;
                                                                            break;
                                                                        case 5:
                                                                        case 6:
                                                                            document.getElementById('section_number').value=8;
                                                                            break;
                                                                        case 7:
                                                                            document.getElementById('section_number').value=15;
                                                                            break;
                                                                        case 9:
                                                                            document.getElementById('section_number').value=7;
                                                                            break;
                                                                        case 10:
                                                                        case 11:
                                                                        case 13:
                                                                            document.getElementById('section_number').value=11;
                                                                            break;
                                                                        case 12:
                                                                            document.getElementById('section_number').value=12;
                                                                            break;
                                                                        default:
                                                                            console.log('Неудачно')
                                                                                       }

">
                                            <option
                                                value="{{$data->type_name}}">{{\App\Models\intelligence_opo_model\opo_parts::where('id_parts', '=', $data->type_name)->first()->object_list}}</option>

                                            @foreach(\App\Models\intelligence_opo_model\opo_parts::where('id_parts', '!=', $data->type_name)->orderby('object_list')->get() as $row)
                                                <option value="{{$row->id_parts}}">{{$row->object_list}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.3.</th>
                                    <th style="text-align: left">Цифровое обозначение раздела (подраздела) отраслевой
                                        принадлежности
                                        (вида деятельности)
                                    </th>
                                    <td style="padding: 0px"><input type="number" id="section_number"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->section_number}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.4.</th>
                                    <th style="text-align: left">Место нахождения (адрес) ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="address_opo"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->address_opo}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.5.</th>
                                    <th style="text-align: left">Код ОКТМО</th>
                                    <td style="padding: 0px"><input type="text" id="oktmo"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->oktmo}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.6.</th>
                                    <th style="text-align: left">Дата ввода объекта в эксплуатацию (при наличии)</th>
                                    <td style="padding: 0px"><input type="date" id="date_commiss"
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
                                    <td style="padding: 0px"><input type="text" id="full_name_legal_entity"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->full_name_legal_entity}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1.9.</th>
                                    <th style="text-align: left">Идентификационный номер налогоплательщика (ИНН)</th>
                                    <td style="padding: 0px"><input type="text" id="inn"
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
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_2_1"
                                                                          value="{{$data->chk_2_1}}"
                                                                          {{$data->chk_2_1 ? 'checked':''}} onchange="
                                if(this.checked) {
                                    switch(Number(document.getElementById('type_name').value)){
                                    case 1:
                                    case 2:
                                        document.getElementById('chk_4_1').setAttribute('checked','true');
                                        break;
                                    case 4:
                                    case 10:
                                    case 11:
                                        document.getElementById('chk_4_4').setAttribute('checked','true');
                                        break;
                                    }
                                    }
                                else {
                                    if( document.getElementById('chk_4_1').checked) {
                                        document.getElementById('chk_4_1').removeAttribute('checked')
                                    }
                                    if( document.getElementById('chk_4_4').checked) {
                                        document.getElementById('chk_4_4').removeAttribute('checked')
                                    }
                                }

">
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
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_2_1_a"
                                                                          value="{{$data->chk_2_1_a}}"
                                                                          {{$data->chk_2_1_a ? 'checked':''}} onchange="
                                     if(this.checked){
                                         document.getElementById('chk_4_5').setAttribute('checked','true')
                                     }
                                     else {
                                          document.getElementById('chk_4_5').removeAttribute('checked')
                                     }
">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: left">б) воды при температуре нагрева более 115 градусов
                                        Цельсия
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_2_1_b"
                                                                          value="{{$data->chk_2_1_b}}" {{$data->chk_2_1_b ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: left">в) иных жидкостей при температуре,
                                        превышающей температуру их кипения при избыточном давлении 0,07 МПа
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_2_1_v"
                                                                          value="{{$data->chk_2_1_v}}" {{$data->chk_2_1_v ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">2.3.</th>
                                    <th style="text-align: left"> Использование стационарно установленных грузоподъемных
                                        механизмов (за исключением лифтов, подъемных платформ для инвалидов),
                                        эскалаторов в метрополитенах, канатных дорог, фуникулеров
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_2_3"
                                                                          value="{{$data->chk_2_3}}"
                                                                          {{$data->chk_2_3 ? 'checked':''}} onchange="
                                     if(this.checked){
                                         document.getElementById('chk_4_6').setAttribute('checked','true')
                                     }
                                     else {
                                          document.getElementById('chk_4_6').removeAttribute('checked')
                                     }
">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">2.4.</th>
                                    <th style="text-align: left"> Получение, транспортирование, использование расплавов
                                        черных и цветных металлов, сплавов на основе этих расплавов с применением
                                        оборудования, рассчитанного на максимальное количество расплава 500 килограммов
                                        и более
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_2_4"
                                                                          value="{{$data->chk_2_4}}"
                                                                          {{$data->chk_2_4 ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">2.5.</th>
                                    <th style="text-align: left">Ведение горных работ (за исключением добычи
                                        обще распространенных полезных ископаемых и разработки россыпных месторождений
                                        полезных ископаемых, осуществляемых открытым способом без применения взрывных
                                        работ), работ по обогащению полезных ископаемых
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_2_5"
                                                                          value="{{$data->chk_2_5}}"
                                                                          {{$data->chk_2_5 ? 'checked':''}} disabled>
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
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_2_6"
                                                                          value="{{$data->chk_2_6}}"
                                                                          {{$data->chk_2_6 ? 'checked':''}} disabled>
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
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_3_1"
                                                                          value="{{$data->chk_3_1}}"
                                                                          {{$data->chk_3_1 ? 'checked':''}} onchange="if(this.checked){document.getElementById('chk_5_1').setAttribute('checked','true')}else{document.getElementById('chk_5_1').removeAttribute('checked')}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">3.2.</th>
                                    <th style="text-align: left">ОПО высокой опасности (II класс)</th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_3_2"
                                                                          value="{{$data->chk_3_2}}"
                                                                          {{$data->chk_3_2 ? 'checked':''}} onchange="if(this.checked){document.getElementById('chk_5_1').setAttribute('checked','true')}else{document.getElementById('chk_5_1').removeAttribute('checked')}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">3.3.</th>
                                    <th style="text-align: left">ОПО средней опасности (III класс)</th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_3_3"
                                                                          value="{{$data->chk_3_3}}"
                                                                          {{$data->chk_3_3 ? 'checked':''}} onchange="if(this.checked){document.getElementById('chk_5_1').setAttribute('checked','true')}else{document.getElementById('chk_5_1').removeAttribute('checked')}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">3.4.</th>
                                    <th style="text-align: left">ОПО низкой опасности (IV класс)</th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_3_4"
                                                                          value="{{$data->chk_3_4}}"
                                                                          {{$data->chk_3_4 ? 'checked':''}} onchange="
                                        if(this.checked) {
                                            document.getElementById('chk_5_1').setAttribute('disabled','true');
                                            document.getElementById('chk_5_2').setAttribute('disabled','true');
                                            document.getElementById('chk_5_3').setAttribute('disabled','true');
                                        }
                                        else {
                                            document.getElementById('chk_5_1').removeAttribute('disabled');
                                            document.getElementById('chk_5_2').removeAttribute('disabled');
                                            document.getElementById('chk_5_3').removeAttribute('disabled');
                                        }


">
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
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_1"
                                                                          value="{{$data->chk_4_1}}" {{$data->chk_4_1 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.2.</th>
                                    <th style="text-align: left">ОПО по хранению химического оружия,
                                        объектов по уничтожению химического оружия и ОПО спецхимии, указанные в пункте
                                        2 приложения 2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_2"
                                                                          value="{{$data->chk_4_2}}"
                                                                          {{$data->chk_4_2 ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.3.</th>
                                    <th style="text-align: left">ОПО бурения и добычи нефти, газа и
                                        газового конденсата, указанные в пункте 3 приложения 2 к Федеральному закону
                                        № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_3"
                                                                          value="{{$data->chk_4_3}}"
                                                                          {{$data->chk_4_3 ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.4.</th>
                                    <th style="text-align: left">ОПО газораспределительных станций,
                                        сетей газораспределения и сетей газопотребления, предусмотренные пунктом
                                        4 приложения 2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_4"
                                                                          value="{{$data->chk_4_4}}"
                                                                          {{$data->chk_4_4 ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.5.</th>
                                    <th style="text-align: left">ОПО, предусмотренные пунктом 5 приложения
                                        2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_5"
                                                                          value="{{$data->chk_4_5}}"
                                                                          {{$data->chk_4_5 ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.6.</th>
                                    <th style="text-align: left">ОПО, предусмотренные пунктом 6
                                        приложения 2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_6"
                                                                          value="{{$data->chk_4_6}}"
                                                                          {{$data->chk_4_6 ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.7.</th>
                                    <th style="text-align: left">ОПО, предусмотренные пунктом 7 приложения
                                        2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_7"
                                                                          value="{{$data->chk_4_7}}"
                                                                          {{$data->chk_4_7 ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.8.</th>
                                    <th style="text-align: left">ОПО, предусмотренные пунктом 8 приложения
                                        2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_8"
                                                                          value="{{$data->chk_4_8}}"
                                                                          {{$data->chk_4_8 ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.9.</th>
                                    <th style="text-align: left">ОПО, предусмотренные пунктом 9 приложения
                                        2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_9"
                                                                          value="{{$data->chk_4_9}}"
                                                                          {{$data->chk_4_9 ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.10.</th>
                                    <th style="text-align: left">Наличие факторов, предусмотренных пунктом
                                        10 приложения 2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_10"
                                                                          value="{{$data->chk_4_10}}"
                                                                          {{$data->chk_4_10 ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.11.</th>
                                    <th style="text-align: left">Наличие факторов, предусмотренных пунктом
                                        11 приложения 2 к Федеральному закону № 116-ФЗ
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_11"
                                                                          value="{{$data->chk_4_11}}"
                                                                          {{$data->chk_4_11 ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: left">на землях особо охраняемых природных территорий</th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_11_a"
                                                                          value="{{$data->chk_4_11_a}}"
                                                                          {{$data->chk_4_11_a ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: left">на континентальном шельфе Российской Федерации</th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_11_b"
                                                                          value="{{$data->chk_4_11_b}}"
                                                                          {{$data->chk_4_11_b ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: left">во внутренних морских водах, территориальном море или
                                        прилежащей зоне Российской Федерации
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_11_v"
                                                                          value="{{$data->chk_4_11_v}}"
                                                                          {{$data->chk_4_11_v ? 'checked':''}} disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">4.12.</th>
                                    <th style="text-align: left">ОПО, аварии на котором могут иметь трансграничное
                                        воздействие
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_4_12"
                                                                          value="{{$data->chk_4_12}}"
                                                                          {{$data->chk_4_12 ? 'checked':''}} disabled>
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
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_5_1"
                                                                          value="{{$data->chk_5_1}}" {{$data->chk_5_1 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">5.2.</th>
                                    <th style="text-align: left">Деятельность, связанная с обращением взрывчатых
                                        материалов промышленного назначения
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_5_2"
                                                                          value="{{$data->chk_5_2}}" {{$data->chk_5_2 ? 'checked':''}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">5.3.</th>
                                    <th style="text-align: left">Деятельность, связанная с производством маркшейдерских
                                        работ
                                    </th>
                                    <td style="text-align: center"><input class="check" type="checkbox" id="chk_5_3"
                                                                          value="{{$data->chk_5_3}}" {{$data->chk_5_3 ? 'checked':''}}>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table>
                                <col style="width: 5%">
                                <col style="width: 20%">
                                <col style="width: 22%">
                                <col style="width: 20%">
                                <col style="width: 21%">
                                <col style="width: 5%">
                                <col style="width: 7%">
                                <thead>
                                <tr>
                                    <th style="text-align: left" colspan="7"><b>6. Сведения о составе ОПО</b>
                                        @can('entries-add')
                                            <div style="padding-right: 10px; display: inline" class="bat_add"><a
                                                    style="float: right; " onclick="add_new_part()">Добавить
                                                    сведения</a></div>
                                        @endcan
                                    </th>
                                </tr>
                                <tr>
                                    <th>№ п/п</th>
                                    <th>Наименование площадки, участка, цеха, здания, сооружения, входящих в состав
                                        ОПО
                                    </th>
                                    <th>Краткая характеристика опасности в соответствии с приложением 1
                                        к Федеральному закону № 116-ФЗ
                                    </th>
                                    <th>Наименование опасного вещества. наименование, тип. марка, модель (при наличии),
                                        регистрационные или учётные номера (для подъёмных сооружений и оборудования,
                                        работающего под давлением, подлежащего учёту в регистрирующем органе (при
                                        наличии)), заводские номера и (или) инвентарные номера (при наличии) технических
                                        устройств
                                    </th>
                                    <th>Проектные (эксплуатационные) характеристики технических устройств (объем,
                                        температура, давление в МПа, грузоподъёмность в тоннах), опасного вещества (вид
                                        в соответствии с таблицами 1 и 2 приложения 2 к Федеральному закону № 116-ФЗ,
                                        характеристика, количество опасного вещества, выраженное в тоннах
                                        регламентированного объемом резервуаров, емкостей и параметрами трубопроводов
                                        (диаметр, протяжённость, проектное давление) или иного оборудования, процентное
                                        содержание сероводорода в добываемой продукции, объем выплавки и объем горных
                                        работ). Год изготовления и ввода в эксплуатацию технических устройств, зданий
                                        (сооружений)
                                    </th>
                                    <th>Числовое обозначение признака опасности</th>
                                    @can('entries-edit')
                                        <th></th>
                                    @endcan
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
                                    <td style="padding: 0px"><input type="text" id="full_name_le"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" disabled
                                                                    value="{{$data->full_name_le}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">8.2.</th>
                                    <th style="text-align: left">Адрес заявителя (адрес в пределах места нахождения
                                        юридического лица либо адрес регистрации по месту жительства (пребывания)
                                        индивидуального предпринимателя)
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="applicants_address"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->applicants_address}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">8.3.</th>
                                    <th style="text-align: left">Должность руководителя</th>
                                    <td style="padding: 0px"><input type="text" id="head_position"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" disabled
                                                                    value="{{$data->head_position}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">8.4.</th>
                                    <th style="text-align: left">Фамилия, имя, отчество (при наличии) руководителя</th>
                                    <td style="padding: 0px"><input type="text" id="surname_head"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" disabled
                                                                    value="{{$data->surname_head}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">8.5.</th>
                                    <th style="text-align: left">Подпись руководителя</th>
                                    <td style="padding: 0px"><input type="text" id="sign"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" disabled
                                                                    value="{{$data->sign}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">8.6.</th>
                                    <th style="text-align: left">Дата подписания руководителем</th>
                                    <td style="padding: 0px"><input type="text" id="date_signing"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" disabled
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
                                    <td style="padding: 0px"><input type="text" id="registration_number"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->registration_number}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.2.</th>
                                    <th style="text-align: left">Дата регистрации</th>
                                    <td style="padding: 0px"><input type="date" id="date_registration"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->date_registration}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.3.</th>
                                    <th style="text-align: left">Дата внесения изменений</th>
                                    <td style="padding: 0px"><input type="date" id="date_change"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"
                                                                    value="{{$data->date_change}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.4.</th>
                                    <th style="text-align: left">Полное наименование территориального органа
                                        Ростехнадзора
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="name_rostekhnadzor"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input" disabled
                                                                    value="{{$data->name_rostekhnadzor}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.5.</th>
                                    <th style="text-align: left">Должность уполномоченного лица территориального
                                        органа Ростехнадзора
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="position_person_rostekh"
                                                                    style="height: 100%; width: 95%" disabled
                                                                    class="text-field__input"
                                                                    value="{{$data->position_person_rostekh}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.6.</th>
                                    <th style="text-align: left">Фамилия, имя, отчество (при наличии) уполномоченного
                                        лица территориального органа Ростехнадзора
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="full_name_person_rostekh"
                                                                    style="height: 100%; width: 95%" disabled
                                                                    class="text-field__input"
                                                                    value="{{$data->full_name_person_rostekh}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.7.</th>
                                    <th style="text-align: left">Подпись уполномоченного лица территориального
                                        органа Ростехнадзора
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="sign_person_rostekh"
                                                                    style="height: 100%; width: 95%" disabled
                                                                    class="text-field__input"
                                                                    value="{{$data->sign_person_rostekh}}"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center">9.8.</th>
                                    <th style="text-align: left">Дата подписания уполномоченным лицом
                                        территориального органа Ростехнадзора
                                    </th>
                                    <td style="padding: 0px"><input type="text" id="date_person_rostekh"
                                                                    style="height: 100%; width: 95%" disabled
                                                                    class="text-field__input"
                                                                    value="{{$data->date_person_rostekh}}"></td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a href="#" onclick="update()">Сохранить</a></div>
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a style="background-color: #CD5C5C" href="/docs/opo">Отменить</a>
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

        function add_tu() {
            let body = document.getElementById('tu_block');
            let arr = ['Наименование технического устройства', 'ст. №', 'рег. №', 'зав. №', 'инв. №']
            let input, label;
            for (let a of arr) {
                label = document.createElement('label');
                label.style.display = 'flex';
                label.style.marginBottom = '2%';
                label.textContent = a
                input = document.createElement('input');
                input.style.marginBottom = '6px'
                input.type = 'text';
                input.classList.add('text-field__input');
                switch (a) {
                    case 'Наименование технического устройства':
                        input.classList.add('name_tu');
                        break;
                    case 'ст. №':
                        input.classList.add('st_mum');
                        break;
                    case 'рег. №':
                        input.classList.add('reg_num');
                        break;
                    case 'зав. №':
                        input.classList.add('zav_mum');
                        break;
                    case 'инв. №':
                        input.classList.add('inv_num');
                        break;
                }
                input.style.width = '85%';
                body.append(label);
                body.append(input);
            }
        }

        function type_tu(el) {
            const arr = el.value.toLowerCase().split(' ');
            if (arr.includes('газопровод') || arr.includes('трубопровод')) {
                document.getElementById('dn_block').style.display = 'flex';
                document.getElementById('pn_block').style.display = 'flex';
                document.getElementById('l_block').style.display = 'flex';
            } else {
                if (arr.includes('пылеуловители') || arr.includes('газосепараторы') || arr.includes('адсорберы') || arr.includes('ёмкость') || arr.includes('емкость') || arr.includes('скруббер') || arr.includes('аккумулятор') || arr.includes('резервуар')) {
                    document.getElementById('pn_block').style.display = 'flex';
                    document.getElementById('v_block').style.display = 'flex';
                } else {
                    if (arr.includes('подогреватель') || arr.includes('аво')) {
                        document.getElementById('pn_block').style.display = 'flex';
                    } else {
                        if (arr.includes('газоперекачивающий')) {
                            document.getElementById('n_block').style.display = 'flex';
                            document.getElementById('q_block').style.display = 'flex';
                            document.getElementById('pn_in_block').style.display = 'flex';
                            document.getElementById('pn_out_block').style.display = 'flex';
                            document.getElementById('haz_names').style.display = 'none';
                        } else {
                            if (arr.includes('кран') || arr.includes('таль') || arr.includes('тельфер.')) {
                                document.getElementById('capacity_block').style.display = 'flex';
                                document.getElementById('haz_names').style.display = 'none';
                            } else {
                                if (arr.includes('котельная')) {
                                    document.getElementById('pn_gas_block').style.display = 'flex';
                                    document.getElementById('pn_water_block').style.display = 'flex';
                                    document.getElementById('therm_block').style.display = 'flex';
                                    document.getElementById('t_max_block').style.display = 'flex';
                                    document.getElementById('flow_block').style.display = 'flex';
                                }
                            }
                        }
                    }
                }
            }
        }

        function check_haz(el) {
            if (el.checked) {
                if (!document.getElementById('tu').value.toLowerCase().split(' ').includes('газоперекачивающий') &&
                    !document.getElementById('tu').value.toLowerCase().split(' ').includes('привод') &&
                    !document.getElementById('tu').value.toLowerCase().split(' ').includes('нагнетатель') &&
                    !document.getElementById('tu').value.toLowerCase().split(' ').includes('кран') &&
                    !document.getElementById('tu').value.toLowerCase().split(' ').includes('таль') &&
                    !document.getElementById('tu').value.toLowerCase().split(' ').includes('тельфер.')) {
                    create_haz_thing(el);
                }
            } else {
                document.querySelector(`[aria-label='${el.value}']`).remove()
            }
        }

        function create_haz_thing(el) {
            document.getElementById('haz_thing').style.display = 'block';
            document.getElementById('haz_things').innerHTML += `<span style="display: flex; justify-content: space-between; align-items: center;" aria-label="${el.value}"><label>${el.value}</label><input type='number' class="text-field__input count_dangerous_subst" style="width: 30%"> т.</span>`;
        }

        function add_new_part() {
            let i = 1;
            var tbody = document.getElementById('tbody_part')
            tbody.innerHTML = ''
            var tr = document.createElement('tr')
            tr.id = 'new_tr'
            tr.innerHTML += `<td>${i}</td>`
            tr.innerHTML += `<td class="name_part" id='name_part' contenteditable="true"></td>`
            tr.innerHTML += `<td class="desc" contenteditable="true"><select class="select-css" id='desc' onchange="
                    switch (this.value) {
                    case 'Транспортируются опасные вещества':
                        case 'Используются опасные вещества' :
                        case 'Хранятся опасные вещества' :
                            document.getElementById('signs_danger').textContent=2.1;
                            break;
                        case 'Транспортируются опасные вещества; Используется оборудование, работающее под избыточным давлением более 0,07 мегапаскаля':
                            document.getElementById('signs_danger').textContent='2.1 2.2';
                            break;
                        case 'Используется оборудование, работающее под избыточным давлением более 0,07 мегапаскаля':
                            document.getElementById('signs_danger').textContent=2.2;
                            break;
                        case 'Используются стационарно установленные грузоподъемные механизмы':
                            document.getElementById('signs_danger').textContent=2.3;
                            break;
                    }
" style="width: 100%">
                               <option value=''></option>
                <option value='Транспортируются опасные вещества'>Транспортируются опасные вещества  </option>
                <option value='Используются опасные вещества'>Используются опасные вещества </option>
                <option value='Хранятся опасные вещества'>Хранятся опасные вещества   </option>
                <option value='Транспортируются опасные вещества; Используется оборудование, работающее под избыточным давлением более 0,07 мегапаскаля'>Транспортируются опасные вещества; Используется оборудование, работающее под избыточным давлением более 0,07 мегапаскаля   </option>
                <option value='Используется оборудование, работающее под избыточным давлением более 0,07 мегапаскаля'>Используется оборудование, работающее под избыточным давлением более 0,07 мегапаскаля   </option>
                <option value='Используются стационарно установленные грузоподъемные механизмы'>Используются стационарно установленные грузоподъемные механизмы  </option>
</select></td>`
            tr.innerHTML += `<td class="name_thing">
    <div class="tu" id="tu_block">
        <label style="display: flex; margin-bottom: 2%"> Наименование технического устройства:</label>
            <input type="text" class="text-field__input name_tu" id='tu' style="width: 85%; margin-bottom: 6px" onblur="type_tu(this)">
        <label style="display: flex; margin-bottom: 2%"> ст. №</label>
            <input type="text" class="text-field__input st_num" style="width: 85%; margin-bottom: 6px">
        <label style="display: flex; margin-bottom: 2%"> рег. №</label>
            <input type="text" class="text-field__input zav_num" style="width: 85%; margin-bottom: 6px">
        <label style="display: flex; margin-bottom: 2%"> зав. №</label>
            <input type="text" class="text-field__input reg_num" style="width: 85%; margin-bottom: 6px">
        <label style="display: flex; margin-bottom: 2%"> инв. №</label>
            <input type="text" class="text-field__input inv_num" style="width: 85%; margin-bottom: 6px">
    </div>
        <button onclick="add_tu()" style="background-color: #49ce56; color: white; margin-bottom: 5px" class="btn";>Добавить устройство</button>


    <div id='haz_names'>
        <label style="font-size: medium; display: flex; margin-bottom: 3%">Наименование опасного вещества:</label>
            <div style="display:flex; flex-direction: column;">
                <span><label>Природный газ</label><input class="check name_dangerous_subst" onchange="check_haz(this)" style="float:right" type="checkbox" value="Природный газ"></span>
                <span><label>Масло</label> <input class="check name_dangerous_subst" style="float:right" onchange="check_haz(this)" type="checkbox" value="Масло"></span>
                <span><label>Пропан</label><input class="check name_dangerous_subst" style="float:right" onchange="check_haz(this)" type="checkbox" value="Пропан"></span>
                <span><label>Кислород</label><input class="check name_dangerous_subst" style="float:right" onchange="check_haz(this)" type="checkbox" value="Кислород"></span>
                <span><label>Одорант</label><input class="check name_dangerous_subst" style="float:right" onchange="check_haz(this)" type="checkbox" value="Одорант"></span>
                <span><label>Диэтиленгликоль</label><input class="check name_dangerous_subst" style="float:right" onchange="check_haz(this)" type="checkbox" value="Диэтиленгликоль"></span>
                <span><label>Конденсат</label><input class="check name_dangerous_subst" style="float:right" onchange="check_haz(this)" type="checkbox" value="Конденсат"></span>
                <span><label>Метанол</label><input class="check name_dangerous_subst" style="float:right" onchange="check_haz(this)" type="checkbox" value="Метанол"></span>
                <span><label>Дизельное топливо</label><input class="check name_dangerous_subst" style="float:right" onchange="check_haz(this)" type="checkbox" value="Дизельное топливо"></span>
                <span><label>Бензин</label><input class="check name_dangerous_subst" style="float:right" onchange="check_haz(this)" type="checkbox" value="Бензин"></span>
                <span><label>Керосин</label><input class="check name_dangerous_subst" style="float:right" onchange="check_haz(this)" type="checkbox" value="Керосин"></span>
            </div>
    </div>
</td>`
            tr.innerHTML += `<td class="desc_tech">
<div id='desc_tech'>
<span style='display:none;justify-content: space-between; align-items: center;' id='dn_block'><label style="margin-right: 5px">DN = </label> <input type='number' id='dn' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%">   мм </span>
<span style='display:none;justify-content: space-between; align-items: center;' id='pn_block'><label style="margin-right: 5px">PN = </label> <input type='number' id='pn' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%">   МПа </span>
<span style='display:none;justify-content: space-between; align-items: center;' id='l_block'><label style="margin-right: 5px">L = </label> <input type='number' id='l' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%">   км </span>
<span style='display:none;justify-content: space-between; align-items: center;' id='v_block'><label style="margin-right: 5px">V = </label> <input type='number' id='v' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%">   м3 </span>
<span style='display:none;justify-content: space-between; align-items: center;' id='n_block'><label style="margin-right: 5px">N = </label> <input type='number' id='n' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%">   МВт </span>
<span style='display:none;justify-content: space-between; align-items: center;' id='q_block'><label style="margin-right: 5px">Q = </label> <input type='number' id='q' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%"> <span>   млн. м<sup>3</sup>/сут</span> </span>
<span style='display:none;justify-content: space-between; align-items: center;' id='pn_in_block'><label style="margin-right: 5px">PN вх = </label> <input type='number' id='pn_in' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%">   МПа </span>
<span style='display:none;justify-content: space-between; align-items: center;' id='pn_out_block'><label style="margin-right: 5px">PN вых = </label> <input type='number' id='pn_out' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%">   МПа </span>
<span style='display:none;justify-content: space-between; align-items: center;' id='capacity_block'><label style="margin-right: 5px">Грузоподъемность </label> <input type='text' id='capacity' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%">   т. </span>
<span style='display:none;justify-content: space-between; align-items: center;' id='pn_gas_block'><label style="margin-right: 5px">PN газа </label> <input type='number' id='pn_gas' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%">   МПа </span>
<span style='display:none;justify-content: space-between; align-items: center;' id='pn_water_block'><label style="margin-right: 5px">PN воды </label> <input type='number' id='pn_water' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%">   Мпа </span>
<span style='display:none;justify-content: space-between; align-items: center;' id='therm_block'><label style="margin-right: 5px">Теплопроизводительн. </label> <input type='number' id='therm' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%"> Гкал/час</span>
<span style='display:none;justify-content: space-between; align-items: center;' id='t_max_block'><label style="margin-right: 5px">Т макс. вых. </label> <input type='number' id='t_max' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%">   ºС </span>
<span style='display:none;justify-content: space-between; align-items: center;' id='flow_block'><label style="margin-right: 5px">Расход топлива  </label> <input type='number' id='fuel_consump' class="text-field__input" min='0' style="padding: 0.3rem;height: 1em; margin: 0 5px 5px 0; width: 25%">  <span> м<sup>3</sup>/час</span> </span>
</div>
<span>
<label style="display: flex; margin-bottom: 2%" >Год изготовления:</label>
<input type='number' class="text-field__input" id='year_manufacture' style="width:85%; margin-bottom: 6px" step='1' min='1970' max='2030'>
</span>
<span>
<label style="display: flex; margin-bottom: 2%">Год ввода в эксплуатацию:</label>
<input type='number' class="text-field__input" id='year_commis' style="width:85%; margin-bottom: 6px" step='1' min='1970' max='2030'>
</span>
<div id='haz_thing' style="display: none">
  <label>Опасное вещество:</label>
    <div id='haz_things' style="display: flex; flex-direction: column"> </div>
</div>

</td>`
            tr.innerHTML += `<td class="class_hazard" id='signs_danger' style="text-align: center"></td>`
            tr.innerHTML += `<td>
                <img style="height: 20px" src="{{ asset('assets/images/icons/check.svg') }}" onclick="save_part()" id="save_parts" class="pdf_i">
                <img style="height: 20px; margin-left: 10px" src="{{ asset('assets/images/icons/close.svg') }}" onclick="get_parts()" class="pdf_i">
            </td>`
            tbody.appendChild(tr)
            i++
        }

        function save_part() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var out_data = []
            out_data['id_opo_from_list'] = '{{$data->id_add_info_opo}}'
            out_data['name_part'] = document.getElementById('name_part').textContent;
            out_data['signs_danger'] = document.getElementById('signs_danger').textContent;
            let params_id = ['desc', 'dn', 'pn', 'l', 'v', 'n', 'q', 'pn_in', 'pn_out', 'capacity', 'pn_gas', 'pn_water', 'therm', 't_max', 'fuel_consump', 'year_manufacture', 'year_commis']
            let params_class = ['name_tu', 'st_num', 'zav_num', 'reg_num', 'inv_num', 'name_dangerous_subst', 'count_dangerous_subst']
            let str = '';
            for (let param of params_id) {
                out_data[param] = document.getElementById(param).value;
            }
            for (let param of params_class) {
                str = ''
                document.querySelectorAll('.' + param).forEach((el) => {
                    if (param != 'name_dangerous_subst') {
                        str += el.value + ',!';
                    } else {
                        if (el.checked) {
                            str += el.value + ',!';
                        }
                    }
                });
                out_data[param] = str;
            }
            // console.log(out_data);
            $.ajax({
                url: '/docs/intelligence_opo/save_part',
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                    console.log('успешно')
                    // console.log(res)
                    get_parts()
                }
            })
        }

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
                            tr.innerHTML += `<td style="text-align: center"> ${row['desc']}</td>`
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
                            tr.innerHTML += `<td>
                            <img style="height: 20px" src="{{ asset('assets/images/icons/trash.svg') }}" onclick="delete_part(${row['id']})" class="pdf_i">
                            </td>`
                            tbody.appendChild(tr)
                            i++
                        }
                    }
                }
            })
        }

        function delete_part(id) {
            // console.log(id)
            $.ajax({
                url: '/docs/intelligence_opo/delete_part/' + id,
                type: 'GET',
                success: (res) => {
                    console.log(res)
                    get_parts()
                }
            })
        }


        function update() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            var params = [
                'full_name_opo', 'type_name', 'section_number', 'address_opo', 'oktmo', 'date_commiss',
                'full_name_legal_entity', 'inn',
                'full_name_le', 'applicants_address', 'head_position', 'surname_head', 'sign', 'date_signing',
                'registration_number', 'date_registration', 'date_change', 'name_rostekhnadzor', 'position_person_rostekh',
                'full_name_person_rostekh', 'sign_person_rostekh', 'date_person_rostekh'];
            let themes = ['chk_2_1_a', 'chk_2_1',
                'chk_2_1_b', 'chk_2_1_v', 'chk_2_3', 'chk_2_4', 'chk_2_5', 'chk_2_6', 'chk_3_1', 'chk_3_2', 'chk_3_3', 'chk_3_4',
                'chk_4_1', 'chk_4_2', 'chk_4_3', 'chk_4_4', 'chk_4_5', 'chk_4_6', 'chk_4_7', 'chk_4_8', 'chk_4_9', 'chk_4_10',
                'chk_4_11', 'chk_4_11_a', 'chk_4_11_b', 'chk_4_11_v', 'chk_4_12', 'chk_5_1', 'chk_5_2', 'chk_5_3']
            var out_data = []
            for (var param of params) {
                if (param != 'date_commiss' && param != 'date_registration' && param != 'date_change') {
                    out_data[param] = document.getElementById(param).value
                } else {
                    if (document.getElementById(param).value) {
                        out_data[param] = document.getElementById(param).value
                    }
                }
            }
            let box
            for (let theme of themes) {
                box = document.getElementById(theme)
                if (box.checked) {
                    out_data[theme] = 1
                } else {
                    out_data[theme] = 0
                }
            }


            $.ajax({
                url: '/docs/intelligence_opo/update/{{$data->id_add_info_opo}}',
                type: 'POST',
                data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                success: (res) => {
                    // console.log(res)
                    window.location.href = '/docs/opo'
                }
            })
        }


    </script>

@endsection

