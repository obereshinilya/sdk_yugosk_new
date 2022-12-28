

{{--ОСНОВНОЙ КОНТЕНТ--}}
<div class="logo_block">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img alt="Логотип" src="{{ asset('assets/images/logo.svg') }}" class="side_menu_logo">
    </a>
</div>
<div class="links_block">
    <ul>
        <li id="main_link_li"><a href="/"><img alt="Главная" src="{{asset('assets/images/icons/home.svg')}}" class="links_block_icon"></a></li>
        <li id="OPOs_link_li"><a href="{{asset('/opo')}}"><img alt="Настройки" src="{{asset('assets/images/icons/settings.svg')}}" class="links_block_icon"></a></li>
        <li id="docs_link_li"><a href="{{ url('/docs') }}"><img alt="Документация" src="{{asset('assets/images/icons/docs.svg')}}" class="links_block_icon"></a></li>
    </ul>
</div>
{{--<div class="info_block">--}}
{{--    <ul>--}}
{{--        <li class=""><a href="{{ url('/docs/glossary') }}"><img alt="Справка" src="{{asset('assets/images/icons/info.svg')}}" class="side_menu_faq"></a></li>--}}
{{--    </ul>--}}
{{--</div>--}}

{{--Контент всплывашек--}}
<span id="main_link_li_tooltip_content" hidden="true">Главная</span>
<span id="OPOs_link_li_tooltip_content" hidden="true">ОПО</span>
<span id="docs_link_li_tooltip_content" hidden="true">Документы</span>

<script>
    $(document).ready(function() {

        $('.links_block ul a').each(function () {

            if (this.href.split('/')[3] == location.href.split('/')[3]) $(this).parent().addClass('active');
        });

        $( '.links_block ul a' ).on( 'click', function () {
            $( '.links_block ul' ).find( 'li.active' ).removeClass( 'active' );
            $( this ).parent( 'li' ).addClass( 'active' );
        });

        var tooltip_main_content=document.getElementById('main_link_li_tooltip_content');
        tooltip_main_content.hidden=false;
        var tooltip1=new Tooltip(tooltip_main_content, 'side_menu_main_tooltip', "main_link_li");

        var tooltip_OPOs_content=document.getElementById('OPOs_link_li_tooltip_content');
        tooltip_OPOs_content.hidden=false;
        var tooltip2=new Tooltip(tooltip_OPOs_content, 'side_menu_OPOs_tooltip', "OPOs_link_li");

        var tooltip_docs_content=document.getElementById('docs_link_li_tooltip_content');
        tooltip_docs_content.hidden=false;
        var tooltip3=new Tooltip(tooltip_docs_content, 'side_menu_docs_tooltip', "docs_link_li");
    });
</script>
