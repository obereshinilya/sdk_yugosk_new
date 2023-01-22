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
    }

    .table-hover tbody tr:hover {
        color: #212529;
        background-color: rgba(0, 0, 0, 0.075);
    }
</style>
<table style="border-collapse: collapse;" class="table table-hover">
    <thead>
    <tr>
        <th colspan="14">
            <h2 class="text-muted" style="text-align: center">{{$title}}</h2>
        </th>
    </tr>
    <tr>
        <th style="text-align: center; padding: 10px 2px">№ п/п</th>
        <th style="text-align: center; padding: 10px 2px">Филиал ДО</th>
        <th style="text-align: center; padding: 10px 2px">Вид техногенного события (ТС)</th>
        <th style="text-align: center; padding: 10px 2px">Место ТС, рег. номер, дата рег.</th>
        <th style="text-align: center; padding: 10px 2px">Дата и время ТС (МСК)</th>
        <th style="text-align: center; padding: 10px 2px">Вид аварии</th>
        <th style="text-align: center; padding: 10px 2px">Описание ТС</th>
        <th style="text-align: center; padding: 10px 2px">Наличие пострадавших</th>
        <th style="text-align: center; padding: 10px 2px">Экономический ущерб, тыс. руб.</th>
        <th style="text-align: center; padding: 10px 2px">Длительность простоя</th>
        <th style="text-align: center; padding: 10px 2px">Ответственные лица и меры воздействия</th>
        <th style="text-align: center; padding: 10px 2px">Мероприятия, предложенные комиссией</th>
        <th style="text-align: center; padding: 10px 2px">Отметка о выполнении мероприятия</th>
        <th style="text-align: center; padding: 10px 2px">Индикативный показатель</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{\App\Models\Main_models\RefDO::where('id_do',$row->id_do)->value('short_name_do') }}</td>
            <td>{{$row->vid_techno_sob}}</td>
            <td>{{$row->mesto_techno_sob}}</td>
            <td>{{$row->data_time}}</td>
            <td>{{$row->vid_avari}}</td>
            <td>{{$row->kratk_opisan}}</td>
            <td>{{$row->nalich_postradav}}</td>
            <td>{{$row->econom_usherb}}</td>
            <td>{{$row->prodolgit_prost}}</td>
            <td>{{$row->litsa_otvetstven}}</td>
            <td>{{$row->meropriytia}}</td>
            @if($row->otmetka_vypoln)
                <td>Выполнено</td>
            @else
                <td>Не выполнено</td>
            @endif
            <td>{{$row->indikativn_pokazat}}</td>
        </tr>

    @endforeach
    </tbody>
</table>
















