<!DOCTYPE html>
<html lang="ru">
@section('title')
    Ситуационный план ОПО — Югорск
@endsection
{{--    Включаем всплывашку с новым сообщением о событии--}}
@can('events-view')
    @include('web.admin.inc.new_JAS')
@endcan
<head>
    @include('web.include.yugorsk_head')
</head>
<style>
    .map_dot#ug02 {
        margin-top: 207px;
        margin-left: 690px;
    }
    .map_dot#ug08 {
        margin-top: 249px;
        margin-left: 725px;
    }
    .map_hover_jas {
        bottom: auto;
        border-collapse: collapse;
        /*width: 519px;*/
        width: 660px;
        overflow-y: scroll;
        z-index: 999;
    }
    .map_hover_jas tbody{
        font-size: 12px;
        text-align: center;
    }
    .map_hover_jas th
    {
        padding: 7px;
    }

    .form table tr th {
        font-size: 14px;
        padding: 10px 15px;
        border-bottom: 1px solid #ececec;
        border-right: 1px solid #ececec;
        font-weight: normal;
        color: #858585;
        background: #f2f2f2;
    }

    .form {
        bottom: 15%;
        right: 3%;
        height: 250px;
        position: absolute;
        overflow-y: scroll
    }

</style>
<body class="ugorsk">
<div class="side_menu">
    @include('web.include.side_menu')
</div>
<div class="header">
    @include('web.include.header')
</div>

<div class="content map_content fond_content flex_main">

    <div class="fond_map risk_block_top centered">
        <div class="high_risk risk_color"><span></span> Предельное состояние</div>
        <div class="middle_risk risk_color"><span></span> Работоспособно</div>
{{--        <div class="low_risk risk_color"><span></span> Предпосылка к инциденту</div>--}}
        <div class="no_risk risk_color"><span></span> Исправно</div>
        <div class="bad_info_risk risk_color"><span></span> Недостоверные данные </div>
        <div class="repair_risk risk_color"><span></span> Ремонтные работы </div>
    </div>

    <div class="flex_content">
        <div class="fond_info">
            <table>
                <tr>
                    <td>
                        <p>Ситуационный план</p>
                        <h3>ООО «Газпром трансгаз Югорск»</h3><br/>
{{--                        <a href="#openModal_info">Общие сведения</a>--}}
                    </td>
                    <td class="centered">
                        <p>Текущее состояние:</p>
                        <div id="sostoyanie" class="rate_fond {{$class}}" style="font-size: 11px; line-height: 1.2; display: flex; align-items: center; word-wrap: break-word">{{$text}}</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="plan_naming"><p style="color:#000">Ситуационный план ООО «Газпром трансгаз Югорск»</p></div>


        <table class="modal_table map_hover">
            <tbody>
            <tr>
                <td>Регион</td>
                <td>ХМАО-Югра</td>
            </tr>
            <tr>
                <td>Город</td>
                <td>Югорск</td>
            </tr>

            </tbody>
        </table>
<div class="form">
        <table class="map_hover_jas" id="map_hover_jas" >
            <thead>
            <tr>
                <th>Дата</th>
                <th>Филиал ДО</th>
                <th>ТБ</th>
                <th>Событие</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4">Аварийных событий нет</td>
                </tr>
            </tbody>

        </table>
    </div>
        <div class="map_block fond_map_block ugorsk">
            <div class="m_move_adapt">
                <div class="m_move">
                    <a href="#openModal" onclick="window.open_modal_opos(1)" class="map_dot good" id="ug01"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(2)" class="map_dot good" id="ug02"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(3)" class="map_dot good" id="ug03"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(4)" class="map_dot good" id="ug04"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(5)" class="map_dot good" id="ug05"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(6)" class="map_dot good" id="ug06"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(7)" class="map_dot good" id="ug07"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(8)" class="map_dot good" id="ug08"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(9)" class="map_dot good" id="ug09"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(10)" class="map_dot good" id="ug10"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(11)" class="map_dot good" id="ug11"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(12)" class="map_dot good" id="ug12"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(13)" class="map_dot good" id="ug13"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(14)" class="map_dot good" id="ug14"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(15)" class="map_dot good" id="ug15"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(16)" class="map_dot good" id="ug16"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(17)" class="map_dot good" id="ug17"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(18)" class="map_dot good" id="ug18"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(19)" class="map_dot good" id="ug19"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(20)" class="map_dot good" id="ug20"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(21)" class="map_dot good" id="ug21"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(22)" class="map_dot good" id="ug22"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(23)" class="map_dot good" id="ug23"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(24)" class="map_dot good" id="ug24"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(25)" class="map_dot good" id="ug25"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(26)" class="map_dot good" id="ug26"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(27)" class="map_dot good" id="ug27"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(28)" class="map_dot good" id="ug28"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(29)" class="map_dot good" id="ug29"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(30)" class="map_dot good" id="ug30"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(31)" class="map_dot good" id="ug31"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(32)" class="map_dot good" id="ug32"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(33)" class="map_dot good" id="ug33"></a>
{{--                    Краснотурьинская--}}
                    <a href="#openModal" onclick="window.open_modal_opos(34)" class="map_dot {{$class}}" id="ug34"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(35)" class="map_dot good" id="ug35"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(36)" class="map_dot good" id="ug36"></a>
                    <a href="#openModal" onclick="window.open_modal_opos(37)" class="map_dot good" id="ug37"></a>

                </div>
            </div>
        </div>
    </div>
</div>





<div id="openModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <table class="modal_table map_hover">
                    <tbody>
                    <tr>
                        <td>ДО</td>
                        <td>ООО «Газпром трансгаз Югорск»</td>
                    </tr>
                    <tr>
                        <td>ЛПУ МГ</td>
                        <td id="name_opo"></td>
                    </tr>
                    <tr>
                        <td>Статус</td>
                        <td class="{{$class}}" id="status">{{$text}}</td>
                    </tr>
                    <tr id="view_opo">
                        <td colspan="2" style="text-align: center; border-left: none">
                            <a href="/opo" style="">Просмотр</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function test() {
        check_new_JAS()
        setInterval(check_new_JAS ,10000)
    })
    function check_new_JAS(){
        $.ajax({
            url: '/new_jas_main',
            type: 'GET',
            success: (res) => {
                if (res.length){
                    var table_body = document.getElementById('map_hover_jas').getElementsByTagName('tbody')[0]
                    table_body.innerHTML = ''
                    for (var i=0; i<res.length; i++){
                        var tr = document.createElement('tr')
                        tr.innerHTML+=`<td>${res[i]['date']}</td>`
                        tr.innerHTML+=`<td>${res[i]['name_do']}</td>`
                        tr.innerHTML+=`<td>${res[i]['name_tb']}</td>`
                        tr.innerHTML+=`<td>${res[i]['event']}</td>`
                        table_body.appendChild(tr);
                    }
                }else {
                    var table_body = document.getElementById('map_hover_jas').getElementsByTagName('tbody')[0]
                    table_body.innerHTML = ''
                    var tr = document.createElement('tr')
                    tr.innerHTML+=`<td colspan="4"></td>`
                    table_body.appendChild(tr);
                    var tr = document.createElement('tr')
                    tr.innerHTML+=`<td colspan="4">Аварийных событий нет</td>`
                    table_body.appendChild(tr);
                }
            }
        })
    }
    document.getElementById('main_link_li').className = 'active'
    function open_modal_opos(id){
        var opos = new Map([     //массив наименований ОПО по точкам
            [1, 'Харп'],
            [2, 'Лабытнанги'],
            [3, 'Ямбург'],
            [4, 'Пуровская'],
            [5, 'Ныдинская'],
            [6, 'Н. Уренгойская'],
            [7, 'Хасырейская'],
            [8, 'Салехард'],
            [9, 'Надымская'],
            [10, 'Пангодинская'],
            [11, 'Правохеттинская'],
            [12, 'Ягельная'],
            [13, 'Лонг-Югальская'],
            [14, 'Приозерная'],
            [15, 'Сорумская'],
            [16, 'Сосновская'],
            [17, 'Казымская'],
            [18, 'Верхнеказымская'],
            [19, 'Бобровская'],
            [20, 'Перегребненская'],
            [21, 'Октябрьская'],
            [22, 'Приполярная'],
            [23, 'Сосьвинская'],
            [24, 'Пунгинская'],
            [25, 'Узюм-Юганская'],
            [26, 'Таежная'],
            [27, 'Ново-Комсомольская'],
            [28, 'Ужгородская'],
            [29, 'Комсомольская'],
            [30, 'Н.Пелымская'],
            [31, 'Пелымская'],
            [32, 'Н.Ивдельская'],
            [33, 'Ивдельская'],
            [34, 'Краснотурьинская'],
            [35, 'Карпинская'],
            [36, 'Лялинская'],
            [37, 'Нижнетуринскя'],
        ])
        document.getElementById('name_opo').textContent = opos.get(id)
        var status = document.getElementById('status')
        if (id != 34){
            document.getElementById('view_opo').style.display = 'none'
            status.className = 'good'
            status.textContent = 'Нет данных'
        } else {
            status.className = document.getElementById('sostoyanie').classList[1]
            status.textContent = document.getElementById('sostoyanie').textContent
            document.getElementById('view_opo').style.display = ''
        }
    }
</script>
<style>
    .modal-body a{background:#e5f2f9;color:#4689aa;padding:8px 15px;border-radius:7px;font-size:12px;text-decoration:none;}
    .modal-body a:hover{background:#4689aa;color:#fff;}
</style>
</html>

