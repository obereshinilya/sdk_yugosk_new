<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 8px
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
<table style="border-collapse: collapse;" class="table table-hover">
    <thead>
    <tr>
        <th colspan="35"><h2 class="text-muted" style="text-align: center">{{$title}}</h2></th>
    </tr>
    <tr>
        <th rowspan="2" style="writing-mode: vertical-lr;"> Наименование филиала дочернего общества</th>
        <th colspan="2">Проведено проверок II уровня АПК</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество выявленных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество устраненных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">% устраненных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество типовых и повторяющихся
            нарушений
        </th>
        <th colspan="2">Проведено проверок III уровня АПК
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество выявленных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество типовых и повторяющихся
            нарушений
        </th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество устраненных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">% устраненных нарушений</th>
        <th colspan="2">Проведено проверок IV-V уровня АПК</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество выявленных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество типовых и повторяющихся
            нарушений
        </th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество устраненных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">% устраненных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Проведено проверок ООО «Газпром
            газнадзор»
        </th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество выявленных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество типовых и
            повторяющихся нарушений
        </th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество устраненных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Кол-во нарушений, не устраненных в
            установленные сроки
        </th>
        <th rowspan="2" style="writing-mode: vertical-lr;">% устраненных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Проведено проверок Ростехнадзором</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество выявленных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество типовых и повторяющихся
            нарушений
        </th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Количество устраненных нарушений</th>
        <th rowspan="2" style="writing-mode: vertical-lr;">Кол-во нарушений, не устраненных в
            установленные сроки
        </th>
        <th rowspan="2" style="writing-mode: vertical-lr;">% устраненных нарушений</th>
        <th colspan="4">Индикативные показатели</th>
    </tr>
    <tr>
        <th style="text-align: center">План</th>
        <th>Факт</th>
        <th style="text-align: center">План</th>
        <th>Факт</th>
        <th style="text-align: center" s>План</th>
        <th>Факт</th>
        <th tyle="text-align: center">Выполнение графика АПК</th>
        <th>Типовые/повторяющиеся нарушения АПК</th>
        <th>Типовые/повторяющиеся нарушения корп.
            контроль
        </th>
        <th>Типовые/повторяющиеся нарушения РТН</th>
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
            <td>{{$row->num_gaznadzor}}</td>
            <td>{{$row->gaznadzor_error}}</td>
            <td>{{$row->gaznadzor_error_repiat}}</td>
            <td>{{$row->gaznadzor_check}}</td>
            <td>{{$row->gaznadzor_check_late}}</td>
            <td>{{$row->gaznadzor_percent}}</td>
            <td>{{$row->num_rosteh}}</td>
            <td>{{$row->rosteh_error}}</td>
            <td>{{$row->rosteh_error_repiat}}</td>
            <td>{{$row->rosteh_check}}</td>
            <td>{{$row->rosteh_check_late}}</td>
            <td>{{$row->rosteh_percent}}</td>
            <td>{{$row->ind_graph}}</td>
            <td>{{$row->ind_repiat_apk}}</td>
            <td>{{$row->ind_repiat_gaznadzor}}</td>
            <td>{{$row->ind_rosteh}}</td>
        </tr>

    @endforeach
    </tbody>
</table>
