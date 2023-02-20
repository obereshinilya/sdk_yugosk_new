<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 8px
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
        <th colspan="14">
            <h2 class="text-muted" style="text-align: center;">{{$title}}</h2>
        </th>
    </tr>
    <tr>
        <th rowspan="2">№</th>
        <th rowspan="2">Наименование<br> филиала ДО</th>
        <th rowspan="2">Подразделение</th>
        <th rowspan="2">Дата акта</th>
        <th rowspan="2">Номер акта</th>
        <th rowspan="2">Описание несоответствия</th>
        <th colspan="3">Мероприятия по устранению несоответствия</th>
        <th colspan="5">Корректирующие действия</th>
        <th rowspan="2">Индикативный <br>показатель</th>
    </tr>
    <tr>
        <th>Наименование мероприятия</th>
        <th>Ответственный исполнитель</th>
        <th>Срок выполнения</th>
        <th>Причины появления несоответствия</th>
        <th>Корректирующее действие</th>
        <th>Требуемые условия и ресурсы</th>
        <th>Ответственный исполнитель</th>
        <th>Срок выполнения</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1;?>
    @foreach($data['data'] as $key=>$row)
        <tr>
            <td>{{$i}}</td>
            <td>{{$row->short_name_do}}</td>
            <td>{{$row->podrazdelenie}}</td>
            @if($row->date_act)
                <td>{{$row->date_act}}</td>
            @else
                <td></td>
            @endif
            <td>{{$row->num_act}}</td>
            <td>{{$row->error_comment}}</td>
            <td>{{$row->name_event}}</td>
            <td>{{$row->person}}</td>
            <td>{{$data['date_check'][$key]}}</td>
            <td>{{$row->reason}}</td>
            <td>{{$row->correct_event}}</td>
            <td>{{$row->usloviya}}</td>
            <td>{{$row->person_correct}}</td>
            @if($row->date_check_correct)
                <td>{{$data['date_check_correct'][$key]}}</td>
            @else
                <td></td>
            @endif
            <td>{{$row->indicator}}</td>
        </tr>
        <?php $i++?>
    @endforeach
    </tbody>
</table>
