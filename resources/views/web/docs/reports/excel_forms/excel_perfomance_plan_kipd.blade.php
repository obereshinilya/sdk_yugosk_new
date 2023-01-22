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
        <th colspan="6"><h2 class="text-muted" style="text-align: center">{{$title}}</h2>
        </th>
    </tr>
    <tr>
        <th style="text-align: center">№ п/п</th>
        <th style="text-align: center">Наименование филиала</th>
        <th style="text-align: center">Корректирующие и предупреждающие действия</th>
        <th style="text-align: center">Ответственный исполнитель</th>
        <th style="text-align: center">Срок выполнения</th>
        <th style="text-align: center">Отметка о выполнении</th>
        <th style="text-align: center">Индикативный показатель</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data['data'] as $key=>$row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{\App\Models\Main_models\RefDO::where('id_do',$row->id_do)->value('short_name_do') }}</td>
            <td>{{$row->correct_action}}</td>
            <td>{{$row->respons_executor}}</td>
            <td>{{$data['deadline'][$key]}}</td>
            @if($row->completion_mark == 'true')
                <td>Выполнено</td>
            @else
                <td>Не выполнено</td>
            @endif
            <td>{{$row->indicative_indicat}}</td>
    @endforeach
    </tbody>
</table>
