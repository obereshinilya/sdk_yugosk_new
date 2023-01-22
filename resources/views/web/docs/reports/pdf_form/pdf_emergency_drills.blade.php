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
        <th rowspan="2" style="text-align: center; padding: 10px 7px">№ п/п</th>
        <th rowspan="2" style="text-align: center">Наименование филиала/ДО</th>
        <th colspan="3" style="text-align: center">Количество ПАТ</th>
        <th rowspan="2" style="text-align: center">Наименование (тема) противоаварийной
            тренировки
        </th>
        <th rowspan="2" style="text-align: center">Наименование, рег. № ОПО</th>
        <th rowspan="2" style="text-align: center">Дата ПАТ</th>
        <th rowspan="2" style="text-align: center">№ и дата протокола проведения ПАТ</th>
        <th rowspan="2" style="text-align: center">Основание проведения ПАТ (плановая,
            внеплановая - указать причину)
        </th>
        <th rowspan="2" style="text-align: center">Оценка</th>
        <th rowspan="2" style="text-align: center">Индикативный показатель</th>
    </tr>
    <tr>
        <th style="text-align: center">План</th>
        <th style="text-align: center">План тек.</th>
        <th style="text-align: center">Факт</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data['data'] as $key=>$row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{\App\Models\Main_models\RefDO::where('id_do',$row->id_do)->value('short_name_do') }}</td>
            <td>{{$row->plan_PAT}}</td>
            <td>{{$row->plan_month_PAT}}</td>
            <td>{{$row->fact_PAT}}</td>
            <td>{{$row->workout_theme}}</td>
            <td>{{$row->name_reg_№_OPO}}</td>
            <td>{{$data['date_PAT'][$key]}}</td>
            <td>{{$row->№_date_protocol_PAT}}</td>
            <td>{{$row->basis_PAT}}</td>
            <td>{{$row->grade}}</td>
            <td>{{$row->indicative_indicator}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
