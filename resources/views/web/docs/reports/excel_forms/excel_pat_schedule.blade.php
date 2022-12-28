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
        <th colspan="16"><h2 class="text-muted" style="text-align: center">{{$title}}</h2></th>
    </tr>
    <tr>
        <th style="text-align: center;">№ п/п</th>
        <th style="text-align: center;">Наименование филиала</th>
        <th style="text-align: center;">Рег. № ОПО</th>
        <th style="text-align: center;">Наименование ОПО</th>
        <th style="text-align: center;">Январь, <br>№ темы</th>
        <th style="text-align: center;">Февраль, <br>№ темы</th>
        <th style="text-align: center;">Март, <br>№ темы</th>
        <th style="text-align: center;">Апрель, <br>№ темы</th>
        <th style="text-align: center;">Май, <br>№ темы</th>
        <th style="text-align: center;">Июнь, <br>№ темы</th>
        <th style="text-align: center;">Июль, <br>№ темы</th>
        <th style="text-align: center;">Август, <br>№ темы</th>
        <th style="text-align: center;">Сентябрь, <br>№ темы</th>
        <th style="text-align: center;">Октябрь, <br>№ темы</th>
        <th style="text-align: center;">Ноябрь, <br>№ темы</th>
        <th style="text-align: center;">Декабрь, <br>№ темы</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->name_filial}}</td>
            <td>{{$row->reg_num_opo}}</td>
            <td>{{$row->opo_name}}</td>
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
    @endforeach
    </tbody>
</table>
