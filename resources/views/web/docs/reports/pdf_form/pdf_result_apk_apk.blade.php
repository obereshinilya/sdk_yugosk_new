<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 7px
    }

    @page {
        margin: 45px 15px;
    }

    .table th,
    .table td {
        padding: 2px;
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
        <th colspan="2">Проведено проверок II уровня АПК</th>
        <th id="level2_error" rowspan="2" style="writing-mode: vertical-lr;">Количество выявленных нарушений</th>
        <th id="level2_check" rowspan="2" style="writing-mode: vertical-lr;">Количество устраненных нарушений</th>

        <th id="level2_percent" rowspan="2" style="writing-mode: vertical-lr;">% устраненных нарушений</th>
        <th id="level2_error_repiat" rowspan="2" style="writing-mode: vertical-lr;">Количество типовых и повторяющихся
            нарушений
        </th>
        <th colspan="2">Проведено проверок III уровня АПК
        <th id="level3_error" rowspan="2" style="writing-mode: vertical-lr;">Количество выявленных нарушений</th>

        <th id="level3_error_repiat" rowspan="2" style="writing-mode: vertical-lr;">Количество типовых и повторяющихся
            нарушений
        </th>

        <th id="level3_check" rowspan="2" style="writing-mode: vertical-lr;">Количество устраненных нарушений</th>

        <th id="level3_percent" rowspan="2" style="writing-mode: vertical-lr;">% устраненных нарушений</th>
        <th colspan="2">Проведено проверок IV-V уровня АПК</th>

        <th id="level4_error" rowspan="2" style="writing-mode: vertical-lr;">Количество выявленных нарушений</th>

        <th id="level4_error_repiat" rowspan="2" style="writing-mode: vertical-lr;">Количество типовых и повторяющихся
            нарушений
        </th>

        <th id="level4_check" rowspan="2" style="writing-mode: vertical-lr;">Количество устраненных нарушений</th>

        <th id="level4_percent" rowspan="2" style="writing-mode: vertical-lr;">% устраненных нарушений</th>


        <th colspan="2">Индикативные показатели</th>
    </tr>
    <tr>

        <th id="level2_plan" style="text-align: center">План</th>
        <th id="level2_fact">Факт</th>

        <th id="level3_plan" style="text-align: center">План</th>

        <th id="level3_fact">Факт</th>

        <th id="level4_plan" style="text-align: center" s>План</th>

        <th id="level4_fact">Факт</th>


        <th id="ind_graph" style="text-align: center" style="writing-mode: vertical-lr;">Выполнение графика АПК</th>

        <th id="ind_repiat_apk" style="writing-mode: vertical-lr;">Типовые / повторяющиеся нарушения АПК</th>


    </tr>

    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{\App\Models\Main_models\RefDO::where('id_do',$row->id_do)->value('short_name_do') }}</td>
            <td>{{$row->level2_plan}}</td>
            <td>{{$row->level2_fact}}</td>
            <td>{{$row->level2_error}}</td>
            <td>{{$row->level2_error_repiat}}</td>
            <td>{{$row->level2_check}}</td>
            <td>{{$row->level2_percent}}</td>
            <td>{{$row->level3_plan}}</td>
            <td>{{$row->level3_fact}}</td>
            <td>{{$row->level3_error}}</td>
            <td>{{$row->level3_error_repiat}}</td>
            <td>{{$row->level3_check}}</td>
            <td>{{$row->level3_percent}}</td>
            <td>{{$row->level4_plan}}</td>
            <td>{{$row->level4_fact}}</td>
            <td>{{$row->level4_error}}</td>
            <td>{{$row->level4_error_repiat}}</td>
            <td>{{$row->level4_check}}</td>
            <td>{{$row->level4_percent}}</td>
            <td>{{$row->ind_graph}}</td>
            <td>{{$row->ind_repiat_apk}}</td>

        </tr>

    @endforeach
    </tbody>
</table>
