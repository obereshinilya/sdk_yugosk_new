<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px
    }

    .table th,
    .table td {
        text-align: center;
        padding: 5px;
        vertical-align: center;
        border-top: 1px solid #dee2e6;
        border: 1px solid black; /* Параметры рамки */
        ;
    }
</style>
<h2 class="text-muted" style="margin: 0px; text-align: center; padding-bottom: 10px">{{$title}}</h2>
<table style="border-collapse: collapse; width: 100%; display: table; table-layout: auto" class="table table-hover">
    <thead>
    <tr>
        <th style="">№ п/п</th>
        <th style="">Наименование ДПБ</th>
        <th style="">Составные части ДПБ</th>
        <th style="">Введена в действие уведомлением Ростехнадзора рег. №,
            дата
        </th>
        <th style="">Рег. № ДПБ в Ростехнадзоре</th>
        <th style="">Наименование ЗЭПБ</th>
        <th style="">Рег.№ ЗЭПБ в Ростехнадзоре,
            дата
        </th>
    </tr>
    </thead>
    <tbody>
<?php $i=1?>
    @foreach($data as $row)
        <tr>
            <td>{{$i}}</td>
            <td>{{$row->name_DPB}}</td>
            <td>{{$row->parts_DPB}}</td>
            <td>{{$row->massage_rtn}}</td>
            <td>{{$row->reg_num_dpb}}</td>
            <td>{{$row->name_zepb}}</td>
            <td>{{$row->reg_num_date_zepb}}</td>
        </tr>
        <?php $i++?>
    @endforeach

    </tbody>

</table>
