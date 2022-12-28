<style>
    .btn {
        display: inline-block;
        font-weight: 400;
        color: #212529;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
        line-height: 1.6;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    @media (prefers-reduced-motion: reduce) {
        .btn {
            transition: none;
        }
    }

    .btn:hover {
        color: #212529;
        text-decoration: none;
    }

    .btn:focus,
    .btn.focus {
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.25);
    }

    .btn.disabled,
    .btn:disabled {
        opacity: 0.65;
    }

    .btn:not(:disabled):not(.disabled) {
        cursor: pointer;
    }

    a.btn.disabled,
    fieldset:disabled a.btn {
        pointer-events: none;
    }
    .btn-danger {
        color: #fff;
        background-color: #e3342f;
        border-color: #e3342f;
    }

    .btn-danger:hover {
        color: #fff;
        background-color: #d0211c;
        border-color: #c51f1a;
    }

    .btn-danger:focus,
    .btn-danger.focus {
        color: #fff;
        background-color: #d0211c;
        border-color: #c51f1a;
        box-shadow: 0 0 0 0.2rem rgba(231, 82, 78, 0.5);
    }

    .btn-danger.disabled,
    .btn-danger:disabled {
        color: #fff;
        background-color: #e3342f;
        border-color: #e3342f;
    }

    .btn-danger:not(:disabled):not(.disabled):active,
    .btn-danger:not(:disabled):not(.disabled).active,
    .show > .btn-danger.dropdown-toggle {
        color: #fff;
        background-color: #c51f1a;
        border-color: #b91d19;
    }

    .btn-danger:not(:disabled):not(.disabled):active:focus,
    .btn-danger:not(:disabled):not(.disabled).active:focus,
    .show > .btn-danger.dropdown-toggle:focus {
        box-shadow: 0 0 0 0.2rem rgba(231, 82, 78, 0.5);
    }
</style>
<div id="jda_attention_modal_content" style="text-align: center; width: auto; height: auto">
    <div class="prokrutka" style="">
        <div style="background: #FFFFFF; text-align: center; overflow-y: auto" class="form51">
            <table id="itemInfoTable_jas" style="display: none; width: 100%">
                <thead>
                <tr>
                    <th style="text-align: center">Дата</th>
                    <th style="text-align: center">Статус</th>
                    <th style="text-align: center">ОПО</th>
                    <th style="text-align: center">Элемент ОПО</th>
                    <th style="text-align: center">Событие</th>
                    @can('events-kavit')
                    <th style="text-align: center">Действие</th>
                    @endcan
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <a id="button_new_jas" class="btn btn-danger" style="text-decoration: none; margin-top: 20px; display: none" href="/jas_full">Перейти в журнал аварийных событий</a>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function test() {
        check_new_JAS()
        setInterval(check_new_JAS ,30000)
    })

    function check_new_JAS(){
        $.ajax({
            url:'/check_new_JAS',
            type:'GET',
            success:(res)=>{
                if (res){
                    if (document.getElementsByClassName('FadeIn').length === 0){
                        var modal_content=document.getElementById('jda_attention_modal_content')
                        var modal=new ModalWindow('Внимание!', modal_content, AnimationsTypes['fadeIn'])
                        document.getElementById('itemInfoTable_jas').style.display = ''
                        var table_body=document.getElementById('itemInfoTable_jas').getElementsByTagName('tbody')[0]
                        table_body.innerText=''
                        for (var i=0; i<res.length; i++){
                            var tr=document.createElement('tr')
                            tr.innerHTML+=`<td>${res[i]['date'].split('.')[0]}</td>`
                            tr.innerHTML+=`<td>${res[i]['status']}</td>`
                            tr.innerHTML+=`<td>${res[i]['opo']}</td>`
                            tr.innerHTML+=`<td>${res[i]['elem_opo']}</td>`
                            tr.innerHTML+=`<td>${res[i]['sobitie']}</td>`
                            @can('events-kavit')
                                tr.innerHTML+=`<td id="kvit_id_${res[i]['id']}" style="align-content: center"><a onclick="commit_jas(${res[i]['id']})" class="btn btn-danger" style="padding: 2Px; margin-left: 5%">Квитировать</a></td>`
                            @endcan
                            table_body.appendChild(tr);
                        }
                        document.getElementById('button_new_jas').style.display = ''
                        modal.show()
                    }
                } else {

                }
            }
        })
    }
    function commit_jas(id){
        $.ajax({
            url: '/jas_commit/' + id,
            type: 'GET',
            success: (res) => {
                var td = document.getElementById('kvit_id_'+id)
                td.innerText = 'Просмотрено'
            }
        })
    }

</script>


<style>
    .dlg-modal{
        position: fixed;
        /*top: 20%;*/
        left: 50%;
        width: 50%;
        min-width: 800px;
        height: auto;
    }

    .prokrutka {
        max-height: 600px;
        background: #fff; /* цвет фона, белый */
        /*border: 1px solid #C1C1C1; !* размер и цвет границы блока *!*/
        /*overflow-x: scroll; !* прокрутка по горизонтали *!*/
        overflow-y: scroll; /* прокрутка по вертикали */
    }
</style>

