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
        <th colspan="9"><h2 class="text-muted" style="text-align: center">{{$title}}</h2></th>
    </tr>
    <tr>
        <th style="text-align: center; ">Структурное подразделение</th>
        <th style="text-align: center">Цели в области ОТ и ПБ
        </th>
        <th style="text-align: center">Наименование риска
        </th>
        <th style="text-align: center">Мероприятие
        </th>
        <th style="text-align: center">Стоимость (тыс. руб.) без НДС
        </th>
        <th style="text-align: center">Источник финансирования</th>
        <th style="text-align: center">Срок исполнения</th>
        <th style="text-align: center">Ответственный исполнитель (ФИО, должность)</th>
        <th style="text-align: center">Отметка о выполнении</th>
    </tr>
    </thead>
    <tbody>
    {{$sum=0}}
    @foreach($data['data'] as $key=>$row)
        <tr>
            <td>{{$row->struct_unit}}</td>
            <td>{{$row->goals}}</td>
            <td>{{$row->risk}}</td>
            <td>{{$row->event}}</td>
            <td>{{$row->cost}}</td>
            <td>{{$row->src}}</td>
            <td>{{$data['completion_date'][$key]}}</td>
            <td>{{$row->person}}</td>
            @if($row->completion_mark)
                <td>Выполнено</td>
            @else
                <td>Не выполнено</td>
            @endif
        </tr>
        {{$sum+=$row->cost}}
    @endforeach
    @if($sum)
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>ИТОГО</td>
            <td>{{$sum}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endif
    </tbody>
</table>
