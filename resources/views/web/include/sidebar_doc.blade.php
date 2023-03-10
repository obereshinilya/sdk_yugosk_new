<div class="sidebar">

        @include('web.include.sidebar_top')

        <div class="clearfix"></div>

    <div class="sidebar_bottom rounded ">

        <div class="blocks_list">
            <div class="doc_header"><input type="text" id="search_element" style="margin-left: 5%; width: 70%"
                                           placeholder="Поиск..."></div>
            <div id="table_for_search_sidebar">
                <label class="accordion">
                    <input type='checkbox' name='checkbox-accordion' id="directory" onclick="SaveChecked(this)">
                    <div class="accordion__header">
                        <a href='#'>Справочники</a>
                    </div>
                    <div class="accordion__content">
                        <a href="/docs/directory_do" onclick="SaveChecked_link(this)">Справочник филиалов ДО</a>
                        <a href="/docs/directory_opo" onclick="SaveChecked_link(this)">Справочник ОПО</a>
                        <a href="/docs/directory_obj" onclick="SaveChecked_link(this)">Справочник элементов ОПО</a>
                        <a href="/docs/directory_tb" onclick="SaveChecked_link(this)">Справочник ТБ элементов ОПО</a>
                        <a href="/docs/opo" onclick="SaveChecked_link(this)">Сведения, характеризующие ОПО</a>
                    </div>
                </label>
                <label class="accordion">
                    <input type='checkbox' name='checkbox-accordion' id="nsi" onclick="SaveChecked(this)">
                    <div class="accordion__header">
                        <a href='#'>Нормативно-справочная информация</a>
                    </div>
                    <div class="accordion__content">
                        <a href="/docs/abbrev" onclick="SaveChecked_link(this)">Справочник сокращений </a>
                        <a href="/docs/incidents" onclick="SaveChecked_link(this)">Справочник видов аварий, инцидентов и
                            предпосылок к инциденту </a>
                        <a href="/docs/implications" onclick="SaveChecked_link(this)">Справочник последствий техногенных
                            событий 1, 2 и 3 уровней </a>
                        <a href="/docs/danger_signs" onclick="SaveChecked_link(this)">Справочник признаков опасности
                            опасных производственных
                            объектов</a>
                        <a href="/docs/danger_classes" onclick="SaveChecked_link(this)">Справочник классов опасности
                            опасных производственных
                            объектов</a>
                        <a href="/docs/type_of_hazards" onclick="SaveChecked_link(this)">Справочник видов опасных
                            веществ</a>
                        <a href="/docs/pat_themes" onclick="SaveChecked_link(this)">Перечень тем ПАТ
                        </a>
                        <a href="/docs/norm_document" onclick="SaveChecked_link(this)">Нормативная документация</a>
                        <a href="/docs/status_gtu" onclick="SaveChecked_link(this)">Данные с системы "СтатусГТЮ"</a>
                    </div>
                </label>
                <label class="accordion">
                    <input type='checkbox' name='checkbox-accordion' id="calc_param" onclick="SaveChecked(this)">
                    <div class="accordion__header">
                        <a href='#'>Индикативные показатели</a>
                    </div>
                    <div class="accordion__content">
                        {{--                        Для расчета показателей--}}
                        <a href="/docs/kipd_internal_checks" onclick="SaveChecked_link(this)">План корректирующих
                            действий ПБ по внутренним
                            проверкам </a>
                        <a href="/docs/perfomance_plan_KiPD" onclick="SaveChecked_link(this)">Выполнение плана КиПД,
                            утвержденного по результатам анализа
                            ЕСУПБ </a>
                        <a href="/docs/result_apk" onclick="SaveChecked_link(this)">Результаты АПК, корпоративного
                            контроля и государственного
                            надзора </a>
                        <a href="/docs/sved_avar" onclick="SaveChecked_link(this)">Сведения об аварийности на ОПО
                            дочернего общества </a>
                        <a href="/docs/emergency_drills" onclick="SaveChecked_link(this)">Сведения о противоаварийных
                            тренировках, проведенных на
                            ОПО </a>
                        <a href="/docs/plan_industrial_safety" onclick="SaveChecked_link(this)">Сведения о выполнении
                            плана работ в области промышленной
                            безопасности </a>
                        <a href="#modal_choice_do" id="krdtoip_a" onclick="SaveChecked_link(this); document.getElementById('ssilka').textContent = '/docs/open_kr_dtoip/'">Сведения о выполнении графика КР
                            и ДТОиР ОПО </a>
                        <a href="/docs/goals_trans_yugorsk" onclick="SaveChecked_link(this)">Цели ООО «Газпром трансгаз
                            Югорск» в области
                            производственной безопасности </a>
                    </div>
                </label>
                <label class="accordion">
                    <input type='checkbox' name='checkbox-accordion' id="report" onclick="SaveChecked(this)">
                    <div class="accordion__header">
                        <a href='#'>Отчеты</a>
                    </div>
                    <div class="accordion__content">
                        {{--                    Остальное--}}
                        <a href="/docs/actual_declarations" onclick="SaveChecked_link(this)">Реестр актуальных
                            деклараций промышленной безопасности
                            опасных производственных объектов</a>
                        <a href="/docs/report_events" onclick="SaveChecked_link(this)">Отчет
                            о выполнении Мероприятий по устранению нарушений
                        </a>
                        <a href="/docs/events" onclick="SaveChecked_link(this)">Мероприятия
                            по устранению имеющихся нарушений
                        </a>
                        <a  href="#modal_choice_do" id="plan_of_industrial_a" onclick="SaveChecked_link(this); document.getElementById('ssilka').textContent = '/docs/plan_of_industrial_safety/'">План работ в области
                            промышленной безопасности
                        </a>
                        <a href="/docs/conclusions_industrial_safety_main"
                           onclick="SaveChecked_link(this)">Реестр заключений
                            экспертизы промышленной
                            безопасности
                        </a>
                        <a href="/docs/fulfillment_certification" onclick="SaveChecked_link(this)">Выполнение
                            плана-графика аттестации персонала в
                            области
                            ПБ
                        </a>
                        <a href="/docs/pat_schedule" onclick="SaveChecked_link(this)">График
                            комплексных ПАТ
                        </a>
                    </div>
                </label>
            </div>
        </div>
    </div>
</div>
<p style="display: none" id="ssilka"></p>
<div id="modal_choice_do" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#close" class="close">×</a>
            </div>
            <div class="modal-body">
                <table class="modal_table map_hover">
                    <thead>
                    <th>Выберите объект</th>
                    </thead>
                    <tbody>
                    <tr style="text-align: center">
                        <td style="padding: 0px; text-align: center"><select id="id_do_in_selector" style="height: 100%; width: 50%; margin-left: 25%; margin-top: 10px"
                                                         class="select-css">
                                <option value="all">По дочернему обществу</option>
                            @foreach(\App\Models\Main_models\RefDO::orderby('short_name_do')->get()  as $row)
                                    <option value="{{$row->id_do}}">{{$row->short_name_do}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">
                            <div class="bat_info print__pdf" style="display: inline-block; margin-left: 0; margin-top: 10px"><a
                                    onclick="window.location.href = document.getElementById('ssilka').textContent+document.getElementById('id_do_in_selector').value"
                                    style="display: inline-block; margin: 0">Открыть</a>
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

    document.addEventListener('DOMContentLoaded', () => {
        let acc_rows = document.querySelectorAll('.accordion__content');
        acc_rows.forEach(function (el, index) {
            let links = el.getElementsByTagName('a')
            for (var i = 0; i < links.length; i++) {
                if (links[i].href == window.localStorage['link']) {
                    links[i].classList.add('active__link')
                }
            }
        })

    })

    var search = document.getElementById('search_element')
    search.oninput = function () {
        setTimeout(find_slidebar, 100);
    };

    function find_slidebar() {
        let acc_rows = document.querySelectorAll('.accordion__content') //строки по которым ищем
        let acc_rows_header = document.querySelectorAll('.accordion__header') //строки по которым ищем
        var search_element = new RegExp(document.getElementById('search_element').value, 'i');   //искомый текст
        acc_rows.forEach(function (el, index) {
                let links = el.getElementsByTagName('a')
                let count = 0;
                for (var i = 0; i < links.length; i++) {  //проходимся по строкам
                    var flag_success = false
                    // console.log(el.getElementsByTagName('a'))
                    if (links[i].textContent.match(search_element)) {
                        flag_success = true
                    }
                    if (flag_success) {
                        links[i].style.display = ""
                        count++;
                    } else {
                        links[i].style.display = "none"
                    }
                }
                if (count == 0) {
                    acc_rows_header[index].style.display = "none"
                } else {
                    acc_rows_header[index].style.display = ""

                }
            }
        )
    }


    let checkboxes = document.getElementsByName('checkbox-accordion');

    function pageStart() {
        for (let ch of checkboxes) {
            if (window.localStorage[ch.id]) {
                ch.checked = true;
            }
        }
    }

    function SaveChecked(element) {
        if (window.localStorage[element.id] != null) {
            element.checked = false;
            window.localStorage.removeItem(element.id);
        } else {
            for (let ch of checkboxes) {
                if (window.localStorage[ch.id]) {
                    ch.checked = false;
                    window.localStorage.removeItem(ch.id);
                }
            }
            window.localStorage[element.id] = true;
        }
    }

    function SaveChecked_link(element) {
        if (window.localStorage['link'] != null) {
            window.localStorage.removeItem('link');
        } else {
            let acc_rows = document.querySelectorAll('.accordion__content');
            acc_rows.forEach(function (el) {
                let links = el.getElementsByTagName('a')
                for (var i = 0; i < links.length; i++) {
                    if (links[i].classList.contains('active__link')) {
                        links[i].classList.remove('active__link')
                    }
                }
            })
        }
        window.localStorage['link'] = element.href;
    }

    pageStart();
</script>
<style>
    .form-group {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 0 0 20px;
    }


    .form-group:last-child {
        margin: 0;
    }

    .form-group label {
        display: block;
        margin: 0 0 10px;
        color: rgba(0, 0, 0, 0.6);
        font-size: 12px;
        font-weight: 500;
        line-height: 1;
        text-transform: uppercase;
        letter-spacing: 0.2em;
    }

    .form-group input {
        outline: none;
        display: block;
        background: rgba(0, 0, 0, 0.1);
        width: 100%;
        border: 0;
        border-radius: 4px;
        box-sizing: border-box;
        padding: 12px 20px;
        color: rgba(0, 0, 0, 0.6);
        font-family: inherit;
        font-size: inherit;
        font-weight: 500;
        line-height: inherit;
        transition: 0.3s ease;
    }

    .form-group input:focus {
        color: rgba(0, 0, 0, 0.8);
    }

    .form-group button {
        outline: none;
        background: #4285f4;
        width: 100%;
        border: 0;
        border-radius: 4px;
        padding: 12px 20px;
        color: #ffffff;
        font-family: inherit;
        font-size: inherit;
        font-weight: 500;
        line-height: inherit;
        text-transform: uppercase;
        cursor: pointer;
    }

    .active__link {
        font-weight: bold;
        color: #000 !important;
    }

</style>




