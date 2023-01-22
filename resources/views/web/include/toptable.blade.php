<script>
    var tablePage = true;
</script>

<div class="table_head_block">
    <img alt="" src="{{asset('assets/images/t_left.svg')}}" class="table_left_corner">
    <table style="table-layout: fixed">
        <tbody>
        <tr>
            <td class="td_date" style="width: 15%; text-align: center">Дата</td>
            <td class="td_status" style="width: 15%; text-align: center">Статус</td>
            <td class="td_opo" style="width: 10%; text-align: center">ОПО</td>
            <td class="td_element" style="width: 20%; text-align: center">Элемент ОПО</td>
            <td class="td_number" style="width: 10%; text-align: center">Состояние</td>
            <td class="td_event" style="width: 30%; text-align: center">Событие</td>
            <td class="td_btn"><a href="{{ url('/jas_full') }}">Открыть полностью</a></td>
        </tr>
        </tbody>
    </table>
</div>


<div class="top_table_inside" id="top_table_inside" style="padding-left: 20px; padding-right: 20px">
    <table id="itemInfoTable" style="table-layout: fixed; width: 98%; ">
        <tbody>
        {{--        //Сюда нарожать строк из будущего журнала событий--}}
        </tbody>
    </table>
</div>

<script>

    $(document).ready(function () {
        getTableData();
        setInterval(getTableData, 10000);
    });

    function getTableData(type = null, data = null) {

        $.ajax({
            url: '/jas_in_top_table',
            // data: 1,
            type: 'GET',
            success: (res) => {
                // console.log(res[0]['id'])
                var table_body = document.getElementById('itemInfoTable').getElementsByTagName('tbody')[0]
                table_body.innerText = ''
                var check = 'Новое'
                for (var i = 0; i < res.length; i++) {
                    if (res[i]['check']) {
                        check = 'Просмотрено'
                    } else {
                        check = 'Новое'
                    }
                    let date = new Date(res[i]['date'].split('.')[0]);
                    let dd = date.getDate();
                    if (dd < 10) dd = '0' + dd;

                    let mm = date.getMonth() + 1;
                    if (mm < 10) mm = '0' + mm;

                    let yyyy = date.getFullYear();
                    var tr = document.createElement('tr')

                    tr.innerHTML += `<td class="td_date" style="text-align: center; width: 15%">
${dd}.${mm}.${yyyy} ${res[i]['date'].split('.')[0].split(' ')[1]}
</td>`
                    tr.innerHTML += `<td class="td_status" style="text-align: center; width: 15%">${res[i]['status']}</td>`
                    tr.innerHTML += `<td class="td_opo" style="text-align: center; width: 10%">${res[i]['opo']}</td>`
                    tr.innerHTML += `<td class="td_element" style="text-align: center; width: 20%">${res[i]['elem_opo']}</td>`
                    tr.innerHTML += `<td class="td_number" style="text-align: center; width: 10%">${check}</td>`
                    tr.innerHTML += `<td class="td_event" style="text-align: center; width: 30%">${res[i]['sobitie']}</td>`

                    table_body.appendChild(tr);
                }
            }
        })
    }

</script>
