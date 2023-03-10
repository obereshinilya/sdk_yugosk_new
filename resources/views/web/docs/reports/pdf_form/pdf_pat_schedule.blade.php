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
        <th style="text-align: center; width: 1%">№ п/п</th>
        <th style="text-align: center; padding: 10px 2px">Наименование филиала</th>
        <th style="text-align: center; padding: 10px 2px">Рег. № ОПО</th>
        <th style="text-align: center; padding: 10px 2px">Наименование ОПО</th>
        <th style="text-align: center; padding: 10px 2px">Январь, № темы</th>
        <th style="text-align: center; padding: 10px 2px">Февраль, № темы</th>
        <th style="text-align: center; padding: 10px 2px">Март, № темы</th>
        <th style="text-align: center; padding: 10px 2px">Апрель, № темы</th>
        <th style="text-align: center; padding: 10px 2px">Май, № темы</th>
        <th style="text-align: center; padding: 10px 2px">Июнь, № темы</th>
        <th style="text-align: center; padding: 10px 2px">Июль, № темы</th>
        <th style="text-align: center; padding: 10px 2px">Август, № темы</th>
        <th style="text-align: center; padding: 10px 2px">Сентябрь, № темы</th>
        <th style="text-align: center; padding: 10px 2px">Октябрь, № темы</th>
        <th style="text-align: center; padding: 10px 2px">Ноябрь, № темы</th>
        <th style="text-align: center; padding: 10px 2px">Декабрь, № темы</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1 ?>
    @foreach($data as $row)
        <tr>
            <td>{{$i}}</td>
            <td>{{$row->short_name_do }}</td>
            <td>{{$row->reg_num_opo}}</td>
            <td>{{$row->full_name_opo}}</td>
            <td>{{$row->jan}}</td>
            <td>{{$row->feb}}</td>
            <td>{{$row->mar}}</td>
            <td>{{$row->apr}}</td>
            <td>{{$row->may}}</td>
            <td>{{$row->jun}}</td>
            <td>{{$row->jul}}</td>
            <td>{{$row->aug}}</td>
            <td>{{$row->sep}}</td>
            <td>{{$row->oct}}</td>
            <td>{{$row->nov}}</td>
            <td>{{$row->dec}}</td>
        </tr>
        <?php $i++?>
    @endforeach
    </tbody>
</table>

<table style="margin-top: 50px; display: table; table-layout: fixed; width: 100%">

    <tbody style="border: 0px">
    <tr style="text-align: left">
        <td style="font-size: 12px; width: 30%">Утверждающий</td>
        <td style="border-bottom: 2px solid black; width: 30%"></td>
        <td style="width: 30%;"></td>
        <td style="border-bottom: 2px solid black; width: 10%"></td>
    </tr>
    <tr style="text-align: left; height: 30px">
        <td>.</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr style="text-align: left">
        <td style="font-size: 12px">Исполнитель</td>
        <td style="border-bottom: 2px solid black"></td>
        <td></td>
        <td style="border-bottom: 2px solid black"></td>
    </tr>
    </tbody>
</table>

