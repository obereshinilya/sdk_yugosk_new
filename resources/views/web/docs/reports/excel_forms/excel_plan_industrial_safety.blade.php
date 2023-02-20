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
        <th colspan="8"><h2 class="text-muted" style="text-align: center">{{$title}}</h2></th>
    </tr>
    <tr>
        <th style="text-align: center;">Наименование филиала ДО</th>
        <th style="text-align: center;">Цели в области ОТ и ПБ</th>
        <th style="text-align: center;">Наименование риска</th>
        <th style="text-align: center;">Мероприятие</th>
        <th style="text-align: center;">Срок исполнения</th>
        <th style="text-align: center;">Ответственный исполнитель (Ф.И.О., должность)</th>
        <th style="text-align: center;">Отметка о выполнении</th>
        <th style="text-align: center;">Индикативный показатель</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data['data'] as $key=>$row)
        <tr>
            <td>{{$row->short_name_do }}</td>
            <td>{{$row->goals_OT_PB}}</td>
            <td>{{$row->name_risk}}</td>
            <td>{{$row->events}}</td>
            <td>{{$data['period_execution'][$key]}}</td>
            <td>{{$row->responsible}}</td>
            @if($row->completion_mark == 'true')
                <td>Выполнено</td>
            @else
                <td>Не выполнено</td>
            @endif
            <td>{{$row->indicative_indicat}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
