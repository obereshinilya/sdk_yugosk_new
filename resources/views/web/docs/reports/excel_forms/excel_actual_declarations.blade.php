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
        <th colspan="7"><h2 class="text-muted" style="text-align: center">{{$title}}</h2></th>
    </tr>
    <tr>
        <th>№ п/п</th>
        <th>Наименование ДПБ</th>
        <th style="text-align: center">Составные части ДПБ</th>
        <th style="text-align: center">Введена в действие уведомлением Ростехнадзора рег. №,
            дата
        </th>
        <th style="text-align: center">Рег. № ДПБ в Ростехнадзоре</th>
        <th style="text-align: center">Наименование ЗЭПБ</th>
        <th style="text-align: center">Рег.№ ЗЭПБ в Ростехнадзоре,
            дата
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->name_DPB}}</td>
            <td>{{$row->parts_DPB}}</td>
            <td>{{$row->massage_rtn}}</td>
            <td>{{$row->reg_num_DPB}}</td>
            <td>{{$row->name_zepb}}</td>
            <td>{{$row->reg_num_date_zepb}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
