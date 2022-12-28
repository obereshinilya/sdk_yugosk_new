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
        <th colspan="27"><h2 class="text-muted" style="text-align: center">{{$title}}</h2></th>
    </tr>
    <tr>
        <th rowspan="3">Наименование филиала дочернего общества</th>
        <th colspan="5">Руководители и члены ЦЭК ДО
        </th>
        <th colspan="8">Работники администрации ДО</th>
        <th colspan="5">Руководители и члены ЭК филиалов</th>
        <th colspan="8">Работники филиалов ДО</th>
    </tr>
    <tr>
        <th colspan="3">Аттестация по промышленной безопасности в Ростехнадзоре (чел.)</th>
        <th colspan="2">Повышение квалификации, чел</th>
        <th colspan="3">Аттестация по промышленной безопасности в Ростехнадзоре (чел.)</th>
        <th colspan="3">Аттестация по промышленной безопасности с использованием ИС
            ЕПТ(чел.)
        </th>
        <th colspan="2">Повышение квалификации по ОТ, чел</th>
        <th colspan="3"> Аттестация по промышленной безопасности (чел.)
        </th>
        <th colspan="2">Повышение квалификации, чел</th>
        <th colspan="3">Аттестация по промышленной безопасности в Ростехнадзоре (чел.)
        </th>
        <th colspan="3"> Аттестация по промышленной безопасности с использованием ИС
            ЕПТ(чел.)
        </th>
        <th colspan="2">Повышение квалификации по ПБ, чел
        </th>
    </tr>
    <tr>
        <th>всего</th>
        <th>план</th>
        <th>факт</th>
        <th>план</th>
        <th>факт</th>
        <th>всего</th>
        <th>план</th>
        <th>факт</th>
        <th>всего</th>
        <th>план</th>
        <th>факт</th>
        <th>план</th>
        <th>факт</th>
        <th>всего</th>
        <th>план</th>
        <th>факт</th>
        <th>план</th>
        <th>факт</th>
        <th>всего</th>
        <th>план</th>
        <th>факт</th>
        <th>всего</th>
        <th>план</th>
        <th>факт</th>
        <th>план</th>
        <th>факт</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{$row->name_do}}</td>
            <td>{{$row->rostech_cec}}</td>
            <td>{{$row->rostech_cec_plan}}</td>
            <td>{{$row->rostech_cec_fact}}</td>
            <td>{{$row->skills_up_cec_plan}}</td>
            <td>{{$row->skills_up_cec_fact}}</td>
            <td>{{$row->rostech_adm_do}}</td>
            <td>{{$row->rostech_adm_do_plan}}</td>
            <td>{{$row->rostech_adm_do_fact}}</td>
            <td>{{$row->is_ept_adm_do}}</td>
            <td>{{$row->is_ept_adm_do_plan}}</td>
            <td>{{$row->is_ept_adm_do_fact}}</td>
            <td>{{$row->ot_adm_do_plan}}</td>
            <td>{{$row->ot_adm_do_fact}}</td>
            <td>{{$row->pb_ec}}</td>
            <td>{{$row->pb_ec_plan}}</td>
            <td>{{$row->pb_ec_fact}}</td>
            <td>{{$row->skills_up_ec_plan}}</td>
            <td>{{$row->skills_up_ec_fact}}</td>
            <td>{{$row->rostech_do}}</td>
            <td>{{$row->rostech_do_plan}}</td>
            <td>{{$row->rostech_do_fact}}</td>
            <td>{{$row->is_ept_do}}</td>
            <td>{{$row->is_ept_do_plan}}</td>
            <td>{{$row->is_ept_do_fact}}</td>
            <td>{{$row->pb_do_plan}}</td>
            <td>{{$row->pb_do_fact}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
