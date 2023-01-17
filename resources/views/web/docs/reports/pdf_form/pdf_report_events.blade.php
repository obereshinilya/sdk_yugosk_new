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
        <th style="text-align: center" rowspan="2">№ п/п</th>
        <th style="text-align: center" rowspan="2">Наименование филиала дочернего
            общества
        </th>
        <th style="text-align: center" rowspan="2">Количество устранённых нарушений за
            отчётный период, ед.
        </th>
        <th style="text-align: center" rowspan="2">Количество не устранённых нарушений с
            истекшим сроком устранения, ед.
        </th>
        <th style="text-align: center" rowspan="2">Количество нарушений с не истекшим
            сроком устранения, ед.
        </th>
        <th style="text-align: center" colspan="2">Из них</th>
        <th style="text-align: center" rowspan="2">Примечание</th>
        <th style="text-align: center; width: 8%" rowspan="2">Дата записи</th>
    </tr>
    <tr>
        <th style="text-align: center">со сроком, установленным по Акту, ед.</th>
        <th style="text-align: center">с переносом срока устранения, ед.</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data['data'] as $key=>$row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->name_do}}</td>
            <td>{{$row->num_elim}}</td>
            <td>{{$row->num_unrem}}</td>
            <td>{{$row->num_unexp_deadlines}}</td>
            <td>{{$row->num_act}}</td>
            <td>{{$row->num_repiat}}</td>
            <td>{{$row->note}}</td>
            <td>{{$data['date_update'][$key]}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
