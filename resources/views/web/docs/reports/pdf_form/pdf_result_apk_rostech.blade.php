<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px
    }

    .table th,
    .table td {
        padding: 3px;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
        border: 1px solid black; /* Параметры рамки */
        text-align: center;
        word-wrap: break-word;
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
        <th id="name_DO" rowspan="2" style="writing-mode: vertical-lr;"> Наименование филиала дочернего общества</th>
        <th id="num_rosteh" rowspan="2" style="writing-mode: vertical-lr;">Проведено проверок Ростехнадзором</th>

        <th id="rosteh_error" rowspan="2" style="writing-mode: vertical-lr;">Количество выявленных нарушений</th>

        <th id="rosteh_error_repiat" rowspan="2" style="writing-mode: vertical-lr;">Количество типовых и повторяющихся
            нарушений
        </th>

        <th id="rosteh_check" rowspan="2" style="writing-mode: vertical-lr;">Количество устраненных нарушений</th>

        <th id="rosteh_check_late" rowspan="2" style="writing-mode: vertical-lr;">Кол-во нарушений, не устраненных в
            установленные сроки
        </th>

        <th id="rosteh_percent" rowspan="2" style="writing-mode: vertical-lr;">% устраненных нарушений</th>


        <th>Индикативные показатели</th>
    </tr>
    <tr>

        <th id="ind_rosteh" style="writing-mode: vertical-lr;">Типовые/повторяющиеся нарушения РТН</th>
    </tr>

    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{$row->name_DO}}</td>


            <td>{{$row->num_rosteh}}</td>
            <td>{{$row->rosteh_error}}</td>
            <td>{{$row->rosteh_error_repiat}}</td>
            <td>{{$row->rosteh_check}}</td>
            <td>{{$row->rosteh_check_late}}</td>
            <td>{{$row->rosteh_percent}}</td>
            <td>{{$row->ind_rosteh}}</td>
        </tr>

    @endforeach
    </tbody>
</table>
















