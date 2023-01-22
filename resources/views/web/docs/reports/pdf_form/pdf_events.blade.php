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
<h2 class="text-muted" style="text-align: center">{{$title}}</h2>
<table style="border-collapse: collapse;" class="table table-hover">
    <thead>
    <tr>
        <th style="text-align: center; width: 1%" rowspan="2">п/п</th>
        <th style="text-align: center" rowspan="2">Филиал "Газпром трансгаз Югорск"
        </th>
        <th style="text-align: center" rowspan="2">Организация, которой выдан акт
        </th>
        <th style="text-align: center" rowspan="2">Выявленные нарушения норм и правил
            (из акта обследования)
        </th>
        <th style="text-align: center" rowspan="2">№ акта
        </th>
        <th style="text-align: center" rowspan="2">Дата выдачи акта</th>
        <th style="text-align: center" rowspan="2">Мероприятия дочернего общества</th>
        <th style="text-align: center" rowspan="2">Ответственный за устранение</th>
        <th style="text-align: center" colspan="2">Установленный срок выполнения</th>
        <th style="text-align: center" rowspan="2">Фактический срок выполнения</th>
        <th style="text-align: center" rowspan="2">Проведённая за отчётный период работа
            по выполнению мероприятий
        </th>
        <th style="text-align: center" rowspan="2">Дата записи</th>
        <th style="text-align: center" rowspan="2">Примечание</th>

    </tr>
    <tr>
        <th style="text-align: center">без учета переноса срока</th>
        <th style="text-align: center">с учётом переноса срока</th>
    </tr>
    </thead>

    <tbody>

    @foreach($data['data'] as $key=>$row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->name_do}}</td>
            <td>{{$row->org}}</td>
            <td>{{$row->viols}}</td>
            <td>{{$row->act_num}}</td>
            <td>{{$data['date_issue'][$key]}}</td>
            <td>{{$row->events}}</td>
            <td>{{$row->person}}</td>
            <td>{{$data['date_base'][$key]}}</td>
            <td>{{$data['date_repiat'][$key]}}</td>
            <td>{{$data['date_fact'][$key]}}</td>
            <td>{{$row->completion_mark}}</td>
            <td>{{$data['date_update'][$key]}}</td>
            <td>{{$row->note}}</td>

        </tr>
    @endforeach

    </tbody>

</table>
