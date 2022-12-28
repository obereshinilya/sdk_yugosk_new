<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px
    }

    .table th,
    .table td {
        padding: 2px;
        vertical-align: center;
        border-top: 1px solid #dee2e6;
        border: 1px solid black; /* Параметры рамки */
        text-align: center;
    }

    .table-hover tbody tr:hover {
        color: #212529;
        background-color: rgba(0, 0, 0, 0.075);
    }
</style>
<table style="border-collapse: collapse;" class="table table-hover">
    <thead>
    <tr>
        <th colspan="9"><h2 class="text-muted" style="text-align: center">{{$title}}</h2></th>
    </tr>
    <tr>
        <th style="text-align: center">№</th>
        <th style="text-align: center">Наименование<br>мероприятия</th>
        <th style="text-align: center">Наименование пункта мероприятий</th>
        <th style="text-align: center">Срок выполнения</th>
        <th style="text-align: center">Ед.<br>изм.</th>
        <th style="text-align: center">План год</th>
        <th style="text-align: center">План тек.</th>
        <th style="text-align: center">Факт</th>
        <th style="text-align: center">Показатель</th>
    </tr>
    </thead>
    <tbody id="tbody_table">
    <tr>
        <td style="text-align: center">1</td>
        <td style="text-align: center" rowspan="16">Диагностика и обследования</td>
        <td style="text-align: center">Внутритрубная дефектоскопия линейной части</td>
        <td style="text-align: center">{{$data[1]['date']}}</td>
        <td style="text-align: center">км</td>
        <td style="text-align: center">{{$data[1]['plan_year']}}</td>
        <td style="text-align: center">{{$data[1]['plan_month']}}</td>
        <td style="text-align: center">{{$data[1]['fact']}}</td>
        <td style="text-align: center">{{$data[1]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">2</td>
        <td style="text-align: center">Электрометрическое обследование линейной части</td>
        <td style="text-align: center">{{$data[2]['date']}}</td>
        <td style="text-align: center">км</td>
        <td style="text-align: center">{{$data[2]['plan_year']}}</td>
        <td style="text-align: center">{{$data[2]['plan_month']}}</td>
        <td style="text-align: center">{{$data[2]['fact']}}</td>
        <td style="text-align: center">{{$data[2]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">3</td>
        <td style="text-align: center">Обследование переходов через железные и автодороги</td>
        <td style="text-align: center">{{$data[3]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[3]['plan_year']}}</td>
        <td style="text-align: center">{{$data[3]['plan_month']}}</td>
        <td style="text-align: center">{{$data[3]['fact']}}</td>
        <td style="text-align: center">{{$data[3]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">4</td>
        <td style="text-align: center">Обследование переходов через водные преграды</td>
        <td style="text-align: center">{{$data[4]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[4]['plan_year']}}</td>
        <td style="text-align: center">{{$data[4]['plan_month']}}</td>
        <td style="text-align: center">{{$data[4]['fact']}}</td>
        <td style="text-align: center">{{$data[4]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">5</td>
        <td style="text-align: center">Обследование воздушных переходов</td>
        <td style="text-align: center">{{$data[5]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[5]['plan_year']}}</td>
        <td style="text-align: center">{{$data[5]['plan_month']}}</td>
        <td style="text-align: center">{{$data[5]['fact']}}</td>
        <td style="text-align: center">{{$data[5]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">6</td>
        <td style="text-align: center">Диагностика КЦ (КС, ДКС)</td>
        <td style="text-align: center">{{$data[6]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[6]['plan_year']}}</td>
        <td style="text-align: center">{{$data[6]['plan_month']}}</td>
        <td style="text-align: center">{{$data[6]['fact']}}</td>
        <td style="text-align: center">{{$data[6]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">7</td>
        <td style="text-align: center">Диагностика ГРС</td>
        <td style="text-align: center">{{$data[7]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[7]['plan_year']}}</td>
        <td style="text-align: center">{{$data[7]['plan_month']}}</td>
        <td style="text-align: center">{{$data[7]['fact']}}</td>
        <td style="text-align: center">{{$data[7]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">8</td>
        <td style="text-align: center">другие виды обследований:</td>
        <td style="text-align: center"></td>
        <td style="text-align: center"></td>
        <td style="text-align: center"></td>
        <td style="text-align: center"></td>
        <td style="text-align: center"></td>
        <td style="text-align: center"></td>
    </tr>
    <tr>
        <td style="text-align: center">9</td>
        <td style="text-align: center">Диагностика КЦ (ЭПБ, ТО СРД)</td>
        <td style="text-align: center">{{$data[9]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[9]['plan_year']}}</td>
        <td style="text-align: center">{{$data[9]['plan_month']}}</td>
        <td style="text-align: center">{{$data[9]['fact']}}</td>
        <td style="text-align: center">{{$data[9]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">10</td>
        <td style="text-align: center">Диагностика АГНКС</td>
        <td style="text-align: center">{{$data[10]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[10]['plan_year']}}</td>
        <td style="text-align: center">{{$data[10]['plan_month']}}</td>
        <td style="text-align: center">{{$data[10]['fact']}}</td>
        <td style="text-align: center">{{$data[10]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">11</td>
        <td style="text-align: center">Мониторинг русловых процессов</td>
        <td style="text-align: center">{{$data[11]['date']}}</td>
        <td style="text-align: center">объект</td>
        <td style="text-align: center">{{$data[11]['plan_year']}}</td>
        <td style="text-align: center">{{$data[11]['plan_month']}}</td>
        <td style="text-align: center">{{$data[11]['fact']}}</td>
        <td style="text-align: center">{{$data[11]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">12</td>
        <td style="text-align: center">Обследование ГХ</td>
        <td style="text-align: center">{{$data[12]['date']}}</td>
        <td style="text-align: center">объект</td>
        <td style="text-align: center">{{$data[12]['plan_year']}}</td>
        <td style="text-align: center">{{$data[12]['plan_month']}}</td>
        <td style="text-align: center">{{$data[12]['fact']}}</td>
        <td style="text-align: center">{{$data[12]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">13</td>
        <td style="text-align: center">Обследование ПРГ</td>
        <td style="text-align: center">{{$data[13]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[13]['plan_year']}}</td>
        <td style="text-align: center">{{$data[13]['plan_month']}}</td>
        <td style="text-align: center">{{$data[13]['fact']}}</td>
        <td style="text-align: center">{{$data[13]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">14</td>
        <td style="text-align: center">Геодезическое позиционирование</td>
        <td style="text-align: center">{{$data[14]['date']}}</td>
        <td style="text-align: center">объект</td>
        <td style="text-align: center">{{$data[14]['plan_year']}}</td>
        <td style="text-align: center">{{$data[14]['plan_month']}}</td>
        <td style="text-align: center">{{$data[14]['fact']}}</td>
        <td style="text-align: center">{{$data[14]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">15</td>
        <td style="text-align: center">Обследование магистральных газопроводов и отводов</td>
        <td style="text-align: center">{{$data[15]['date']}}</td>
        <td style="text-align: center">км</td>
        <td style="text-align: center">{{$data[15]['plan_year']}}</td>
        <td style="text-align: center">{{$data[15]['plan_month']}}</td>
        <td style="text-align: center">{{$data[15]['fact']}}</td>
        <td style="text-align: center">{{$data[15]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">16</td>
        <td style="text-align: center">Диагностика энергооборудования</td>
        <td style="text-align: center">{{$data[16]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[16]['plan_year']}}</td>
        <td style="text-align: center">{{$data[16]['plan_month']}}</td>
        <td style="text-align: center">{{$data[16]['fact']}}</td>
        <td style="text-align: center">{{$data[16]['indicator']}}</td>
    </tr>
    {{--                                Второй раздел --}}
    <tr>
        <td style="text-align: center">17</td>
        <td style="text-align: center; " rowspan="11">Капитальный ремонт</td>
        <td style="text-align: center">Ремонт ЛЧ всего, в т.ч.:</td>
        <td style="text-align: center"></td>
        <td style="text-align: center"></td>
        <td style="text-align: center"></td>
        <td style="text-align: center"></td>
        <td style="text-align: center"></td>
        <td style="text-align: center"></td>
    </tr>
    <tr>
        <td style="text-align: center">18</td>
        <td style="text-align: center">Замена и переукладка трубы линейной части</td>
        <td style="text-align: center">{{$data[18]['date']}}</td>
        <td style="text-align: center">объект</td>
        <td style="text-align: center">{{$data[18]['plan_year']}}</td>
        <td style="text-align: center">{{$data[18]['plan_month']}}</td>
        <td style="text-align: center">{{$data[18]['fact']}}</td>
        <td style="text-align: center">{{$data[18]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">19</td>
        <td style="text-align: center">Ремонт переходов через железные и автодороги</td>
        <td style="text-align: center">{{$data[19]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[19]['plan_year']}}</td>
        <td style="text-align: center">{{$data[19]['plan_month']}}</td>
        <td style="text-align: center">{{$data[19]['fact']}}</td>
        <td style="text-align: center">{{$data[19]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">20</td>
        <td style="text-align: center">Ремонт переходов через водные преграды</td>
        <td style="text-align: center">{{$data[20]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[20]['plan_year']}}</td>
        <td style="text-align: center">{{$data[20]['plan_month']}}</td>
        <td style="text-align: center">{{$data[20]['fact']}}</td>
        <td style="text-align: center">{{$data[20]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">21</td>
        <td style="text-align: center">Ремонт воздушных переходов</td>
        <td style="text-align: center">{{$data[21]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[21]['plan_year']}}</td>
        <td style="text-align: center">{{$data[21]['plan_month']}}</td>
        <td style="text-align: center">{{$data[21]['fact']}}</td>
        <td style="text-align: center">{{$data[21]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">22</td>
        <td style="text-align: center">Врезка и замена запорно-регулирующей арматуры</td>
        <td style="text-align: center">{{$data[22]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[22]['plan_year']}}</td>
        <td style="text-align: center">{{$data[22]['plan_month']}}</td>
        <td style="text-align: center">{{$data[22]['fact']}}</td>
        <td style="text-align: center">{{$data[22]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">23</td>
        <td style="text-align: center">Ремонт запорно-регулирующей арматуры</td>
        <td style="text-align: center">{{$data[23]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[23]['plan_year']}}</td>
        <td style="text-align: center">{{$data[23]['plan_month']}}</td>
        <td style="text-align: center">{{$data[23]['fact']}}</td>
        <td style="text-align: center">{{$data[23]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">24</td>
        <td style="text-align: center">Врезка и замена камер приема-запуска очистных устройств</td>
        <td style="text-align: center">{{$data[24]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[24]['plan_year']}}</td>
        <td style="text-align: center">{{$data[24]['plan_month']}}</td>
        <td style="text-align: center">{{$data[24]['fact']}}</td>
        <td style="text-align: center">{{$data[24]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">25</td>
        <td style="text-align: center">Ремонт камер приема-запуска очистных устройств</td>
        <td style="text-align: center">{{$data[25]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[25]['plan_year']}}</td>
        <td style="text-align: center">{{$data[25]['plan_month']}}</td>
        <td style="text-align: center">{{$data[25]['fact']}}</td>
        <td style="text-align: center">{{$data[25]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">26</td>
        <td style="text-align: center">Ремонтно-техническое обслуживание ГРС</td>
        <td style="text-align: center">{{$data[26]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[26]['plan_year']}}</td>
        <td style="text-align: center">{{$data[26]['plan_month']}}</td>
        <td style="text-align: center">{{$data[26]['fact']}}</td>
        <td style="text-align: center">{{$data[26]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">27</td>
        <td style="text-align: center">Капитальный ремонт ГРС</td>
        <td style="text-align: center">{{$data[27]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[27]['plan_year']}}</td>
        <td style="text-align: center">{{$data[27]['plan_month']}}</td>
        <td style="text-align: center">{{$data[27]['fact']}}</td>
        <td style="text-align: center">{{$data[27]['indicator']}}</td>
    </tr>
    {{--                                    Третий раздел--}}
    <tr>
        <td style="text-align: center">28</td>
        <td style="text-align: center" rowspan="5">Капитальный ремонт, капитальное строительство и реконструкция</td>
        <td style="text-align: center">Реконструкция ГРС</td>
        <td style="text-align: center">{{$data[28]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[28]['plan_year']}}</td>
        <td style="text-align: center">{{$data[28]['plan_month']}}</td>
        <td style="text-align: center">{{$data[28]['fact']}}</td>
        <td style="text-align: center">{{$data[28]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">29</td>
        <td style="text-align: center">Капитальный ремонт КЦ (КС, ДКС)</td>
        <td style="text-align: center">{{$data[29]['date']}}</td>
        <td style="text-align: center">объект</td>
        <td style="text-align: center">{{$data[29]['plan_year']}}</td>
        <td style="text-align: center">{{$data[29]['plan_month']}}</td>
        <td style="text-align: center">{{$data[29]['fact']}}</td>
        <td style="text-align: center">{{$data[29]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">30</td>
        <td style="text-align: center">Реконструкция КЦ (КС, ДКС)</td>
        <td style="text-align: center">{{$data[30]['date']}}</td>
        <td style="text-align: center">объект</td>
        <td style="text-align: center">{{$data[30]['plan_year']}}</td>
        <td style="text-align: center">{{$data[30]['plan_month']}}</td>
        <td style="text-align: center">{{$data[30]['fact']}}</td>
        <td style="text-align: center">{{$data[30]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">31</td>
        <td style="text-align: center">Капитальный ремонт АГНКС</td>
        <td style="text-align: center">{{$data[31]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[31]['plan_year']}}</td>
        <td style="text-align: center">{{$data[31]['plan_month']}}</td>
        <td style="text-align: center">{{$data[31]['fact']}}</td>
        <td style="text-align: center">{{$data[31]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">32</td>
        <td style="text-align: center">Реконструкция АГНКС</td>
        <td style="text-align: center">{{$data[32]['date']}}</td>
        <td style="text-align: center">шт</td>
        <td style="text-align: center">{{$data[32]['plan_year']}}</td>
        <td style="text-align: center">{{$data[32]['plan_month']}}</td>
        <td style="text-align: center">{{$data[32]['fact']}}</td>
        <td style="text-align: center">{{$data[32]['indicator']}}</td>
    </tr>
    {{--                                    Четвертый раздел--}}
    <tr>
        <td style="text-align: center">33</td>
        <td style="text-align: center" rowspan="9">Телемеханизация и автоматизация</td>
        <td style="text-align: center">Телемеханизация линейной части</td>
        <td style="text-align: center">{{$data[33]['date']}}</td>
        <td style="text-align: center">объект</td>
        <td style="text-align: center">{{$data[33]['plan_year']}}</td>
        <td style="text-align: center">{{$data[33]['plan_month']}}</td>
        <td style="text-align: center">{{$data[33]['fact']}}</td>
        <td style="text-align: center">{{$data[33]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">34</td>
        <td style="text-align: center">Модернизация системы телемеханики линейной части</td>
        <td style="text-align: center">{{$data[34]['date']}}</td>
        <td style="text-align: center">объект</td>
        <td style="text-align: center">{{$data[34]['plan_year']}}</td>
        <td style="text-align: center">{{$data[34]['plan_month']}}</td>
        <td style="text-align: center">{{$data[34]['fact']}}</td>
        <td style="text-align: center">{{$data[34]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">35</td>
        <td style="text-align: center">Ремонт системы телемеханики линейной части</td>
        <td style="text-align: center">{{$data[35]['date']}}</td>
        <td style="text-align: center">объект</td>
        <td style="text-align: center">{{$data[35]['plan_year']}}</td>
        <td style="text-align: center">{{$data[35]['plan_month']}}</td>
        <td style="text-align: center">{{$data[35]['fact']}}</td>
        <td style="text-align: center">{{$data[35]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">36</td>
        <td style="text-align: center">Капитальный ремонт автоматики ГРС</td>
        <td style="text-align: center">{{$data[36]['date']}}</td>
        <td style="text-align: center">объект</td>
        <td style="text-align: center">{{$data[36]['plan_year']}}</td>
        <td style="text-align: center">{{$data[36]['plan_month']}}</td>
        <td style="text-align: center">{{$data[36]['fact']}}</td>
        <td style="text-align: center">{{$data[36]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">37</td>
        <td style="text-align: center">Модернизация автоматики ГРС</td>
        <td style="text-align: center">{{$data[37]['date']}}</td>
        <td style="text-align: center">объект</td>
        <td style="text-align: center">{{$data[37]['plan_year']}}</td>
        <td style="text-align: center">{{$data[37]['plan_month']}}</td>
        <td style="text-align: center">{{$data[37]['fact']}}</td>
        <td style="text-align: center">{{$data[37]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">38</td>
        <td style="text-align: center">ТОиР средств автоматизация КС</td>
        <td style="text-align: center">{{$data[38]['date']}}</td>
        <td style="text-align: center">объект</td>
        <td style="text-align: center">{{$data[38]['plan_year']}}</td>
        <td style="text-align: center">{{$data[38]['plan_month']}}</td>
        <td style="text-align: center">{{$data[38]['fact']}}</td>
        <td style="text-align: center">{{$data[38]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">39</td>
        <td style="text-align: center">Модернизация автоматики КС (реконструкция)</td>
        <td style="text-align: center">{{$data[39]['date']}}</td>
        <td style="text-align: center"></td>
        <td style="text-align: center">{{$data[39]['plan_year']}}</td>
        <td style="text-align: center">{{$data[39]['plan_month']}}</td>
        <td style="text-align: center">{{$data[39]['fact']}}</td>
        <td style="text-align: center">{{$data[39]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">40</td>
        <td style="text-align: center">Капитальный ремонт автоматики КС</td>
        <td style="text-align: center">{{$data[40]['date']}}</td>
        <td style="text-align: center"></td>
        <td style="text-align: center">{{$data[40]['plan_year']}}</td>
        <td style="text-align: center">{{$data[40]['plan_month']}}</td>
        <td style="text-align: center">{{$data[40]['fact']}}</td>
        <td style="text-align: center">{{$data[40]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">41</td>
        <td style="text-align: center">Капитальный ремонт автоматики ГПА</td>
        <td style="text-align: center">{{$data[41]['date']}}</td>
        <td style="text-align: center"></td>
        <td style="text-align: center">{{$data[41]['plan_year']}}</td>
        <td style="text-align: center">{{$data[41]['plan_month']}}</td>
        <td style="text-align: center">{{$data[41]['fact']}}</td>
        <td style="text-align: center">{{$data[41]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">42</td>
        <td style="text-align: center" class="">Изоляция</td>
        <td style="text-align: center">Переизоляция ЛЧ МГ</td>
        <td style="text-align: center">{{$data[42]['date']}}</td>
        <td style="text-align: center"></td>
        <td style="text-align: center">{{$data[42]['plan_year']}}</td>
        <td style="text-align: center">{{$data[42]['plan_month']}}</td>
        <td style="text-align: center">{{$data[42]['fact']}}</td>
        <td style="text-align: center">{{$data[42]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">43</td>
        <td style="text-align: center" class="">Средства ЭХЗ</td>
        <td style="text-align: center">Капитальный ремонт</td>
        <td style="text-align: center">{{$data[43]['date']}}</td>
        <td style="text-align: center"></td>
        <td style="text-align: center">{{$data[43]['plan_year']}}</td>
        <td style="text-align: center">{{$data[43]['plan_month']}}</td>
        <td style="text-align: center">{{$data[43]['fact']}}</td>
        <td style="text-align: center">{{$data[43]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">44</td>
        <td style="text-align: center" class="">Объекты Общества</td>
        <td style="text-align: center">Реконструкция</td>
        <td style="text-align: center">{{$data[44]['date']}}</td>
        <td style="text-align: center"></td>
        <td style="text-align: center">{{$data[44]['plan_year']}}</td>
        <td style="text-align: center">{{$data[44]['plan_month']}}</td>
        <td style="text-align: center">{{$data[44]['fact']}}</td>
        <td style="text-align: center">{{$data[44]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">45</td>
        <td style="text-align: center" class="">Фонд скважин</td>
        <td style="text-align: center">Ремонт фонтанной и запорной арматуры, колонных головок</td>
        <td style="text-align: center">{{$data[45]['date']}}</td>
        <td style="text-align: center"></td>
        <td style="text-align: center">{{$data[45]['plan_year']}}</td>
        <td style="text-align: center">{{$data[45]['plan_month']}}</td>
        <td style="text-align: center">{{$data[45]['fact']}}</td>
        <td style="text-align: center">{{$data[45]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center">46</td>
        <td style="text-align: center" class="">Другие виды мероприятий</td>
        <td style="text-align: center"></td>
        <td style="text-align: center">{{$data[46]['date']}}</td>
        <td style="text-align: center"></td>
        <td style="text-align: center">{{$data[46]['plan_year']}}</td>
        <td style="text-align: center">{{$data[46]['plan_month']}}</td>
        <td style="text-align: center">{{$data[46]['fact']}}</td>
        <td style="text-align: center">{{$data[46]['indicator']}}</td>
    </tr>
    <tr>
        <td style="text-align: center" class=""></td>
        <td style="text-align: center" class=""></td>
        <td style="text-align: center" class=""></td>
        <td style="text-align: center" class=""><b>Итого:</b></td>
        <td style="text-align: center" class=""></td>
        <td style="text-align: center" class="">{{$data['all_plan_year']}}</td>
        <td style="text-align: center" class="">{{$data['all_plan_month']}}</td>
        <td style="text-align: center" class="">{{$data['all_fact']}}</td>
        <td style="text-align: center" id="indicator_all"></td>
    </tr>
    </tbody>
</table>








