<div id="jda_attention_modal_content" style="text-align: center">
    <h3 id="jda_attention_text"></h3>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function (){
        var modal_content=document.getElementById('files_tree_modal_content')
        var modal=new ModalWindow('Контрольные суммы', modal_content, AnimationsTypes['stickyUp'])
        document.getElementById('seumchecker_go_btn').addEventListener('click',function (){
            clear_tree();
            load_files_tree();
            // var modal=document.getElementById('files_tree_modal');
            // // console.log(modal)
            // modalShow(modal)
            modal.show()
        });
        document.getElementById('files_tree_closer').addEventListener('click', function (){
            console.log($('#choice_files_tree').removeData('uiFancytree'))
        });
    });
</script>
<div class="btn-group">
    @can('jda-show')
        <a href="/admin" class="btn btn-primary" aria-current="page">Журнал событий</a>
    @endcan
    <a href="/admin/perm" class="btn btn-primary">Список привилегий</a>
    <a class="btn btn-primary" href="{{ route('roles.index') }}">Список ролей</a>
    <a class="btn btn-primary" href="{{ route('users.index') }}">Список пользователей</a>
        @can('check-sum')
{{--    <a class="btn btn-primary" id="seumchecker_go_btn">Контрольные суммы</a>--}}
        @endcan
        @can('safety-edit')
        <a class="btn btn-primary" href="{{ route('config_safety') }}">Конфигурация безопасности</a>
        @endcan
</div>

<script>
    document.addEventListener('DOMContentLoaded', function test() {

        async function check(){
            while (true){
                $.ajax({
                    url:"/check_journal_full",
                    type:"GET",
                    success:function(data)
                    {
                        var modal_content=document.getElementById('jda_attention_modal_content')
                        var modal=new ModalWindow('Внимание', modal_content, AnimationsTypes['fadeIn'])
                        var btn=document.createElement('a')

                        btn.className="btn btn-danger"
                        btn.textContent='Очистить журнал'

                        if (data==4){
                            if (modal_content.getElementsByClassName('btn btn-danger').length==0){
                                btn.href="clear_logs"
                                modal_content.appendChild(btn)
                            }
                            $('#jda_attention_text').html('Журнал событий заполнен до критической отметки')
                            modal.show()
                        }

                        if (data==3){
                            if (modal_content.getElementsByClassName('btn btn-danger').length!=0){
                                modal_content.removeChild(btn)
                            }
                            $('#jda_attention_text').html('Журнал событий заполнен до предупредительной отметки')
                            modal.show()
                        }


                    }
                })
                await sleep(60);
            }
        }
        check();

    })
</script>

