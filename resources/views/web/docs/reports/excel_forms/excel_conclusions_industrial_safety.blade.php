<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px
    }

    .table th,
    .table td {
        padding: 5px;
        vertical-align: top;
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
        <th colspan="30"><h2 class="text-muted" style="text-align: center">{{$title}}</h2></th>
    </tr>
    <tr>
        <th rowspan="2">№ п/п</th>
        <th rowspan="2">Наименование<br> центра финансовой
            отвественности
        </th>
        <th rowspan="2">Наименование филиала</th>
        <th rowspan="2">Вид ТУ, зданий и сооружений</th>
        <th colspan="9">Место проведения ЭПБ</th>
        <th rowspan="2">Дата ввода в эксплуатацию</th>
        <th rowspan="2">Дата проведения ЭПБ</th>
        <th colspan="2">Срок эксплуатации/ наработка на момент ЭПБ</th>
        <th colspan="2">Срок продления безопасной эксплуатации</th>
        <th colspan="2">Дата/наработка следующей ЭПБ</th>
        <th rowspan="2">Уведомление о внесении в реестр (№ письма,
            дата)
        </th>
        <th rowspan="2">Регистрационный номер заключения ЭПБ</th>
        <th rowspan="2">Наличие условий действий заключений</th>
        <th rowspan="2">Факт выполнения условий</th>
        <th rowspan="2">Условия действия заключений</th>
        <th rowspan="2">Срок выполнения условий</th>
        <th rowspan="2">Приоритетность</th>
        <th rowspan="2">Номер заключения ЭПБ подрядной
            организации
        </th>
        <th rowspan="2">Наименование экспертной организации</th>
    </tr>
    <tr>
        <th>Наименование объекта</th>
        <th>Наименов-е цеха/ местонахождения</th>
        <th>№ цеха</th>
        <th>Наименов-е ТУ, здания, сооружения</th>
        <th>Изготовитель/ проектная организация</th>
        <th> Станц-й номер, рег.№, участок
            (км-км)
        </th>
        <th>Зав. №</th>
        <th>Протяженность газопровода, км,
            кол-во, шт.
        </th>
        <th> Инв.
            №ТУ, здания, сооружения
        </th>
        <th>Наработка ТУ, часов
        </th>
        <th> Кол-во лет ТУ, зданию, сооружению
        </th>
        <th>Наработка ТУ, часов
        </th>
        <th> Кол-во лет ТУ, зданию, сооружению
        </th>
        <th>Наработка до следующего ЭПБ
        </th>
        <th> Дата следующего ЭПБ
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->center_name}}</td>
            <td>{{$row->name_do}}</td>
            <td>{{$row->type_tu}}</td>
            <td>{{$row->object_name}}</td>
            <td>{{$row->workshop_name}}</td>
            <td>{{$row->n_workshop}}</td>
            <td>{{$row->name_tu}}</td>
            <td>{{$row->manufacturer}}</td>
            <td>{{$row->station_number}}</td>
            <td>{{$row->factory_num}}</td>
            <td>{{$row->pipeline_length}}</td>
            <td>{{$row->inv_tu_num}}</td>
            <td>{{$row->date_comiss}}</td>
            <td>{{$row->date_epb}}</td>
            <td>{{$row->runtime_tu}}</td>
            <td>{{$row->age_tu}}</td>
            <td>{{$row->runtime_ext_tu}}</td>
            <td>{{$row->age_ext_tu}}</td>
            <td>{{$row->runtime_epb}}</td>
            <td>{{$row->date_next_epb}}</td>
            <td>{{$row->notification}}</td>
            <td>{{$row->reg_num}}</td>
            @if ($row->conditions)
                <td style="text-align: center">Да</td>
            @else
                <td style="text-align: center">Нет</td>
            @endif
            @if ($row->completion_mark)
                <td style="text-align: center">Выполнено</td>
            @else
                <td style="text-align: center">Не выполнено</td>
            @endif
            <td>{{$row->conditions_concl}}</td>
            <td>{{$row->due_date}}</td>
            <td>{{$row->priority}}</td>
            <td>{{$row->concl_num}}</td>
            <td>{{$row->exp_org_name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
