{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">--}}
{{--    <title>Fancytree - Example</title>--}}
    <script src="{{asset('/js/jquery.min.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="{{asset('/sumchecker/sumchecker_tree/src/skin-win8/ui.fancytree.css')}}" rel="stylesheet">
    <script src="{{asset('/sumchecker/sumchecker_tree/src/jquery-ui-dependencies/jquery.fancytree.ui-deps.js')}}"></script>
    <script src="{{asset('/sumchecker/sumchecker_tree/src/jquery.fancytree.js')}}"></script>

    <style>
        #tree_footer{
            left: 0;
            bottom: 0; /* Левый нижний угол */
        }
        ul.fancytree-container {
            border: none;
            background-color: whitesmoke;
        }
        #files_tree_footer_btns{
            margin-left: auto;
            margin-right: auto;
            width: 300px;
            left: 50%;
            display: flex;
            justify-content: center
        }
        #files_tree_footer_btns{
            margin-left: auto;
            margin-right: auto;
            width: 300px;
            left: 50%;
            display: flex;
            justify-content: center;
        }
        #files_tree_footer_btns +.files_tree_btns{
            margin-left: 10px;
        }
        .files_tree_btns{
            margin-top: 15px;
            background-color: #3490dc;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            margin-left: 7px;
            margin-right: 7px;
            border-radius: 4px;
            opacity: 0.7;
            transition: 0.3s;
        }
        .files_tree_btns.focus {
            color: #fff;
            background-color: #286090;
            border-color: #122b40;
        }
        .files_tree_btns:hover {
            color: #fff;
            background-color: #286090;
            border-color: #204d74;
            opacity: 1
        }
        #files_tree_modal{
            height: 800px;
            width: 90%;
            max-width: 1000px;
            text-align: center;

        }


        #files_tree_callback_message{
            position: fixed; /* Фиксированное положение */
            right: 0; bottom: 0; /* Левый нижний угол */
            background-color: #f44336;
            color: white;
            float:right;
            width: 100px;
            display: flex;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            line-height: 1.6;
            border-radius: 0.25rem;
            height: 25px;
            margin: 10px;
            text-align: center;
         }
        .files_tree_div{
            border: 1px solid rgba(0, 0, 0, 0.125);
            overflow-y: scroll;
            height: 500px;
            width: 47%;
            margin: 5px;
            background-color: whitesmoke;
            text-align: left;
        }
        #sumchecker_last_logs_content{
            border: 1px solid rgba(0, 0, 0, 0.125);
            overflow-y: scroll;
            height: 200px;
            width: calc(94% + 12px);
            margin: 5px;
            background-color: whitesmoke;
            display: inline-block;
            vertical-align: middle;
            text-align: left;
            justify-content: center;
        }
        #files_trees{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            align-content: center;
        }
        #choiced_div_text, #last_logs_h{
            margin: 10px;
        }
        #sumchecker_last_logs{
            text-align: left;
            font-family: "Andale Mono", monospace;
            padding: 10px;
        }


        /*All logs dialog*/
        dialog{
            z-index: 2001;
            border:none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.85);
            height: 60%;
            max-height: 60%;
            position: fixed; /* Фиксированное положение */
            top:20%;
            margin-left: auto;
            margin-right: auto; /* Левый нижний ;угол */
            float: bottom;
            padding: 10px; /* Поля вокруг текста */
        }
        #all_logs_dialog_content > p{
            margin-top: 0.1em; /* Отступ сверху */
            margin-bottom: 0.1em; /* Отступ снизу */
        }
        #all_logs_dialog_content{
            text-align: left;
            font-family: "Andale Mono", monospace;
            padding: 10px;
            /*overflow-y: scroll;*/
            height: 75%;
        }
        #all_logs_table{
            height: 100%;
            width: 100%;
            border: none;
            margin-bottom: 20px;
            overflow-y: scroll;
        }
        .all_logs_dialog_tb_header{
            font-weight: bold;
            text-align: left;
            border: none;
            padding: 10px 15px;
            background: #d8d8d8;
            font-size: 14px;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }
        #all_logs_table>tbody td{
            text-align: left;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            padding: 10px 15px;
            font-size: 14px;
            vertical-align: top;
        }
        #all_logs_table>tbody{
            display: block;
            height: 100%;
            overflow-y: scroll;
        }
        #all_logs_table>thead{
            display: table;
        }
        #all_logs_table thead tr th:first-child, .table tbody tr td:first-child {
            border-left: none;
        }
        #all_logs_table thead tr th:last-child, .table tbody tr td:last-child {
            border-right: none;
        }
        #all_logs_table tbody tr:nth-child(even){
            background: #f3f3f3;
        }
        #files_tree_modal_content{
            text-align: center;
        }
    </style>
    <!-- (Irrelevant source removed.) -->
{{--</head>--}}

{{--<body class="example">--}}


{{--    <div class="overlay" data-close=""></div>--}}
{{--    <div id="files_tree_modal"  class="dlg-modal dlg-modal-slide">--}}
{{--        <div class="modal_header">--}}
{{--            <span class="closer_btn" data-close="" id="files_tree_closer"></span>--}}
{{--            <h1 >Контрольные суммы</h1>--}}
{{--        </div>--}}
        <div id="files_tree_modal_content">
            <div id="files_trees">
                <div id="all_files_tree" class="files_tree_div" data-type="json">
                </div>

                <div id="choice_files_tree" class="files_tree_div">
                    <h2 id="choiced_div_text"></h2>
                </div>
            </div>
            <div id="sumchecker_last_logs_content">
                <h2 id="last_logs_h">Последние логи</h2>
                <div id="sumchecker_last_logs">
                </div>
            </div>

            <div id="tree_footer">
                <div id="files_tree_footer_btns">
                    <input type="button" id="set_paths_btn" class="files_tree_btns" value="Сохранить">
                    <input type="button" id="clear_choice_files_tree" class="files_tree_btns" value="Очистить список">
                    <input type="button" id="sumchecker_update_btn" class="files_tree_btns" value="Обновить суммы">
                    <input type="button" id="sumchecker_check_btn" class="files_tree_btns" value="Проверить суммы">
                    <input type="button" id="sumchecker_all_logs_btn" class="files_tree_btns" value="Все логи">
                </div>
                <div id="files_tree_callback_message">
                    <a id="files_tree_message_strong"></a>
                </div>
            </div>
        </div>
        <dialog id="all_logs_dialog">
            <h3>Все логи</h3>
            <div id="all_logs_dialog_content">
                <table id="all_logs_table">
                    <tbody>
                        <tr>
                            <td class="all_logs_dialog_tb_header">Время</td>
                            <td class="all_logs_dialog_tb_header">Событие</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="button" id="all_logs_dialog-exit" class="files_tree_btns" value="Закрыть">
        </dialog>
{{--    </div>--}}
{{--ALL LOGS DIALOG--}}


<script type="text/javascript">

    $(document).ready(function (){
        $.getScript("{{asset('/js/modals_function.js')}}", function() {
            console.log("Script loaded but not necessarily executed.");
        });
        $('#files_tree_callback_message').hide();
        load_files_tree()

    })
    function load_files_tree() {

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        function InitChoiceFilesTree(data){
            $("#choice_files_tree").fancytree({
                checkbox:false,
                source:data,
                loadChildren:function (event, data){
                    var cmp=function(a, b) {
                        var x = (a.isFolder() ? "0" : "1") + a.title.toLowerCase(),
                            y = (b.isFolder() ? "0" : "1") + b.title.toLowerCase();
                        return x === y ? 0 : x > y ? 1 : -1;
                    }
                    var rootNode=data.tree.getRootNode();
                    rootNode.sortChildren(cmp, true);
                    if (data.tree.getRootNode().children!=null){
                        $('#choiced_div_text').text('Выбранные файлы');
                    }
                    else{
                        $('#choiced_div_text').text('Файлы не выбраны');
                    }
                },
                init:function (event, data){
                    if (data.tree.getRootNode().children!=null){
                        $('#choiced_div_text').text('Выбранные файлы');
                    }
                    else{
                        $('#choiced_div_text').text('Файлы не выбраны');
                    }
                }

            })
        }
        // var selected_files=[];
        var FT = $.ui.fancytree;
        $(function(){
            // attach to instance 1 and 3
            $("#all_files_tree").fancytree({
                checkbox: true,
                loadChildren: function(event, data) {
                    var cmp=function(a, b) {
                        var x = (a.isFolder() ? "0" : "1") + a.title.toLowerCase(),
                            y = (b.isFolder() ? "0" : "1") + b.title.toLowerCase();
                        return x === y ? 0 : x > y ? 1 : -1;
                    }
                    var rootNode=data.tree.getRootNode();
                    rootNode.sortChildren(cmp, true);
                    // for(child in rootNode.children){
                    //     rootNode.children[child].setSelected(rootNode.children[child].data.choiced);
                    // }
                    if (data.node.isSelected()){
                        data.node.children.forEach(function(node){
                            node.setSelected();
                        })
                    }

                },
                checkboxAutoHide: true, // Display check boxes on hover only
                selectMode: 3,
                source:{
                    url: '/sumcontroller/get_tree',
                    data:{
                        key:'.'
                    },
                    cache:false
                },
                lazyLoad: function(event, data) {
                    var node = data.node;
                    // Issue an Ajax request to load child nodes
                    data.result = {
                        url: "/sumcontroller/get_tree",
                        data: {key: node.key}
                    }

                },
                select: function(event, data) {
                    if (data.node.key!='_1'){
                        function nodeSelect(node){
                            var choice_files_tree=FT.getTree("#choice_files_tree");
                            if (choice_files_tree==null){
                                if (!node.isFolder()){
                                    InitChoiceFilesTree([{
                                        title:node.title+ ' ('+node.key+')',
                                        folder: false,
                                        key: node.key,
                                        selected: true,
                                    }]);
                                }
                            }
                            else{
                                if (node.isFolder()){
                                    if (node.children!=null){
                                        node.children.forEach(function (nd){
                                            nd.setSelected(node.isSelected());
                                            nodeSelect(nd);
                                        })
                                    }
                                }
                                else{
                                    if (node.isSelected()){
                                        try{
                                            choice_files_tree.getRootNode().addChildren({
                                                title:node.title+ ' ('+node.key+')',
                                                folder: false,
                                                key: node.key,
                                                selected: true,
                                            });
                                        }
                                        catch (e){
                                            console.log(e)
                                        }
                                    }
                                    else{
                                        choice_files_tree.getRootNode().children.forEach(function (nd){
                                            if (nd.key==node.key){
                                                nd.remove();
                                            }
                                        })
                                    }
                                }
                                if (choice_files_tree.getRootNode().children!=null){
                                    $('#choiced_div_text').text('Выбранные файлы');
                                }
                                else{
                                    $('#choiced_div_text').text('Файлы не выбраны');
                                }
                            }
                        }

                        if (data.node.isFolder()){
                            data.node.setActive();
                            data.node.setExpanded(true);
                            nodeSelect(data.node);
                        }
                        else{
                            nodeSelect(data.node);
                        }
                    }

                }
            });
            $.ajax({
                url:'/sumcontroller/get_choiced',
                type: 'GET',
                success: function(data) {
                    if (data!=''){
                        InitChoiceFilesTree(data);
                    }
                    else{
                        $('#choiced_div_text').text('Файлы не выбраны');
                    }
                }
            });


        });


        document.getElementById('set_paths_btn').onclick=function (){
            var array=[];
            var paths_tree=FT.getTree("#choice_files_tree");
            if (paths_tree==null){
                $('#files_tree_callback_message').css("background-color", '#ea6a6a');
                $('#files_tree_callback_message').show();
                $('#files_tree_message_strong').text('Ошибка!');
                $('#files_tree_callback_message').fadeOut(3000);
                return;
            }
            if (paths_tree.getRootNode().children!=null){
                paths_tree.getRootNode().children.forEach(function (node){
                    if (node.key!='_2'){
                        array.push(node.key);
                    }
                })
            }
            else{
                array='none';
            }

            $.ajax({
                url:'/sumcontroller/set_paths',
                type:"POST",
                data:{
                    paths:array
                },
                success:function(data)
                {
                    console.log(data);
                    if (data==1){
                        $('#files_tree_callback_message').css("background-color", '#38c172');
                        $('#files_tree_callback_message').show();
                        $('#files_tree_message_strong').text('Сохранено!');
                        $('#files_tree_callback_message').fadeOut(2000);
                    }
                    else{
                        $('#files_tree_callback_message').css("background-color", '#ea6a6a');
                        $('#files_tree_callback_message').show();
                        $('#files_tree_message_strong').text('Ошибка!');
                        $('#files_tree_callback_message').fadeOut(3000);
                    }
                }
            })
        };


        document.getElementById('clear_choice_files_tree').onclick=function (){
            clear_tree();
        };

        function sumchecker_set_cmd(cmd){
            $.ajax({
                url:'/sumcontroller/cmd',
                type:'GET',
                data:{
                    type:cmd
                },
                success:function (data){
                    console.log(data)

                    if (data['code']!=0 || data==null){
                        var html=$('#sumchecker_last_logs').html()
                        $('#sumchecker_last_logs').html(html+'An error occurred on the server!<br>');
                    }
                    else{
                        console.log(data['data']);
                        data['data'].forEach(function (item){
                            if (item!=''){
                                var html=$('#sumchecker_last_logs').html()
                                $('#sumchecker_last_logs').html(html+item+'<br>');
                            }
                        })
                    }
                }
            })
        }

        document.getElementById('sumchecker_update_btn').onclick=function (){
            sumchecker_set_cmd('update');
        }
        document.getElementById('sumchecker_check_btn').onclick=function (){
            sumchecker_set_cmd('check');
        }

        //ALL LOGS DIALOG
        var dialog = document.getElementById('all_logs_dialog');
        document.getElementById('sumchecker_all_logs_btn').onclick = function() {
            console.log('Нажалось')
            $.ajax({
                url:'/sumcontroller/get_all_logs',
                type:'GET',
                success: function (data){
                    if (data!='' && data!=null){
                        var tbody=document.querySelector('#all_logs_table>tbody');
                        data.forEach(function (log){
                            var tr=document.createElement('tr');
                            tr.innerHTML='<td>'+log['time']+'</td>';
                            tr.innerHTML+='<td>'+log['event']+'</td>';
                            tbody.appendChild(tr);
                        })
                    }
                }
            })
            dialog.show();
        };
        document.getElementById('all_logs_dialog-exit').onclick = function() {
            dialog.close();
        };

    }
    function clear_tree(){

        var FT = $.ui.fancytree;
        var paths_tree=FT.getTree("#choice_files_tree");
        if (paths_tree!=null){
            paths_tree.getRootNode().removeChildren();
            $('#choiced_div_text').text('Файлы не выбраны');

            FT.getTree('#all_files_tree').getSelectedNodes().forEach(function (nd){
                try{
                    nd.setSelected(false);
                }
                catch (e){
                    console.log(e);
                }
            });
        }
    }
</script>
<!-- (Irrelevant source removed.) -->
{{--</body>--}}
{{--</html>--}}



