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
        <th colspan="7"><h2 class="text-muted" style="text-align: center">{{$title}}</h2>
        </th>
    </tr>
    <tr>
        <th style="text-align: center">№ п/п</th>
        <th style="text-align: center">Цели в области производственной безопасности</th>
        <th style="text-align: center">Ожидаемый результат при достижении цели</th>
        <th style="text-align: center">Срок достижения цели</th>
        <th style="text-align: center">Подразделение, ответственное за достижение
            результата
        </th>
        <th style="text-align: center">Отметка о выполнении</th>
        <th style="text-align: center">Индикативный показатель</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data['data'] as $key=>$row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->safety_goals}}</td>
            <td>{{$row->result_goal}}</td>
            <td>{{$data['data_goal'][$key]}}</td>
            <td>{{$row->department}}</td>
            @if($row->completion_mark == '1')
                <td>Выполнено</td>
            @else
                <td>Не выполнено</td>
            @endif
            <td>{{$row->indicative_indicator}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
