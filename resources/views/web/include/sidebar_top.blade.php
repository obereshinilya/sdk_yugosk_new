<div class="sidebar_top">
    <div class="sidebar_top_single main rounded white_bg">
        <a href="{{route('gazprom')}}">
            <div class="sidebar_top_single info">
               <div class="class_rate good" id="min_ip_of_GTU"></div>
                <div class="class_name">
                   <p class="bold blue_text">ООО «Газпром трансгаз Югорск»</p>
                    <p class="grey_text">Перейти на ситуационный план</p>
                </div>
            </div>
            <div class="more_arrow"><img alt="Далее" src="{{asset('assets/images/icons/arrow_right.svg')}}" class="more_arrow_icon"></div>
        </a>
    </div>
    <div class="sidebar_top_single main rounded white_bg">
        <a href="{{url('/opo')}}">
            <div class="sidebar_top_single info">
                <div class="class_rate good" id="min_ip_of_opo"></div>
                <div class="class_name">
                    <p class="bold blue_text">Краснотурьинское ЛПУ МГ</p>
                    <p class="grey_text">Перейти на ситуационный план</p>
                </div>
            </div>
            <div class="more_arrow"><img alt="Далее" src="{{asset('assets/images/icons/arrow_right.svg')}}" class="more_arrow_icon"></div>
        </a>
    </div>
</div>
<script>
    //написать скрипт для обновления статуса
    $.ajax({
        url: '/get_status_do',
        type: 'GET',
        success: (res) => {
            var main_status = document.getElementById('min_ip_of_opo')
            main_status.classList.remove('good')
            main_status.classList.add(res)
        }, async: false,
    })
    setInterval(function (){
        $.ajax({
            url: '/get_status_do',
            type: 'GET',
            success: (res) => {
                var main_status = document.getElementById('min_ip_of_opo')
                main_status.classList.remove('good')
                main_status.classList.add(res)
            }, async: false,
        })
    } ,30000)

</script>

