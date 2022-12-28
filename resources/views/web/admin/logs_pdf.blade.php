<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 10px}
</style>
<h1 style="font-size: 12; text-align: center">{{$title}}</h1>
<table class="table table-hover" style="border-collapse: collapse">
    <thead>
    <tr>
        <th scope="col" style="border: 1px solid black">#</th>
        <th scope="col" style="border: 1px solid black">Описание события</th>
        <th scope="col" style="border: 1px solid black">Пользователь</th>
        <th scope="col" style="border: 1px solid black">IP адрес</th>
        <th scope="col" style="border: 1px solid black">Дата</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($logs as $log)
        <tr>
            <th style="text-align: center; border: 1px solid black" scope="row-4">{{ $count-- }}</th>
            <td  style="text-align: center; border: 1px solid black">{{ $log->description }}</td>
            <td style="text-align: center; border: 1px solid black">{{ $log->username }}</td>
            <td style="text-align: center; border: 1px solid black">{{ $log->ip }}</td>
            <td style="text-align: center; border: 1px solid black">{{ $log->created_at }}</td>
        </tr>
    @endforeach


    </tbody>

</table>
