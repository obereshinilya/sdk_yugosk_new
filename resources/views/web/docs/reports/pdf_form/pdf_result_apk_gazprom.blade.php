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
        <th id="num_gaznadzor" rowspan="2" style="writing-mode: vertical-lr;">Проведено проверок ООО «Газпром
            газнадзор»
        </th>

        <th id="gaznadzor_error" rowspan="2" style="writing-mode: vertical-lr;">Количество выявленных нарушений</th>

        <th id="gaznadzor_error_repiat" rowspan="2" style="writing-mode: vertical-lr;">Количество типовых и
            повторяющихся нарушений
        </th>

        <th id="gaznadzor_check" rowspan="2" style="writing-mode: vertical-lr;">Количество устраненных нарушений</th>

        <th id="gaznadzor_check_late" rowspan="2" style="writing-mode: vertical-lr;">Кол-во нарушений, не устраненных в
            установленные сроки
        </th>

        <th id="gaznadzor_percent" rowspan="2" style="writing-mode: vertical-lr;">% устраненных нарушений</th>


        <th>Индикативные показатели</th>
    </tr>
    <tr>


        <th id="ind_repiat_gaznadzor" style="writing-mode: vertical-lr;">Типовые/повторяющиеся нарушения корп.
            контроль
        </th>


    </tr>

    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{\App\Models\Main_models\RefDO::where('id_do',$row->id_do)->value('short_name_do') }}</td>


            <td>{{$row->num_gaznadzor}}</td>
            <td>{{$row->gaznadzor_error}}</td>
            <td>{{$row->gaznadzor_error_repiat}}</td>
            <td>{{$row->gaznadzor_check}}</td>
            <td>{{$row->gaznadzor_check_late}}</td>
            <td>{{$row->gaznadzor_percent}}</td>
            <td>{{$row->ind_repiat_gaznadzor}}</td>

        </tr>

    @endforeach
    </tbody>
</table>









