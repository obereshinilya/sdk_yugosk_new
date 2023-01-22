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
        <th style="text-align: center">Дата</th>
        <th style="text-align: center">Статус</th>
        <th style="text-align: center">ОПО</th>
        <th style="text-align: center">Элемент ОПО</th>
        <th style="text-align: center">Описание события</th>
        <th style="text-align: center">Комментарий</th>
        <th style="text-align: center">Состояние</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data['data'] as $key=>$row)
        <tr>
            <td style="text-align: center">
                {{$data['date'][$key]}}

            </td>
            <td style="text-align: center">{{$row->status}}</td>
            <td style="text-align: center">{{$row->opo}}</td>
            <td style="text-align: center">{{$row->elem_opo}}</td>
            <td style="text-align: center">{{$row->sobitie}}</td>
            <td style="text-align: center">{{$row->comment}}</td>
            <td style="text-align: center">

                @if ($row->check == false)
                    {{'Не просмотрено'}}
                @else
                    {{'Просмотрено'}}
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
