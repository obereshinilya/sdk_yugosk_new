@extends('web.layouts.app')
@section('title')
    Создание
@endsection

@section('content')
    {{--    Включаем всплывашку с новым сообщением о событии--}}
    @can('events-view')
        @include('web.admin.inc.new_JAS')
    @endcan
    @include('web.include.sidebar_doc')
<p style="display: none" id="select_type_tb"></p>
    <div class="inside_content">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h2 class="text-muted" style="text-align: center">Добавление записи в справочник ТБ элементов ОПО
                        </h2>
                    </div>

                    <div class="inside_tab_padding form51"
                         style="height:77vh; padding: 0px; margin: 0px; overflow-y: auto">
                        <div style="background: #FFFFFF; border-radius: 6px" class="form51">
                            <table>
                                <col style="width: 30%">
                                <col style="width: 70%">
                                <thead>
                                <tr>
                                    <th style="text-align: center">Наименование</th>
                                    <th style="text-align: center">Содержание</th>

                                </tr>
                                </thead>
                                <tbody id="table_obj">
                                <tr>
                                    <th style="text-align: center">Филиал дочернего общества</th>
                                    <td style="padding: 0px"><select style="height: 100%; width: 70%" onchange="get_opo(this.value); this.setAttribute('disabled', 'true')"
                                                                     class="select-css">
                                            <option value="">Наименование филиала ДО...</option>
                                        @foreach(\App\Models\Main_models\RefDO::orderby('short_name_do')->get() as $row)
                                                <option value="{{$row->id_do}}">{{$row->short_name_do}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr id="opo" style="display: none">
                                    <th style="text-align: center">ОПО</th>
                                    <td style="padding: 0px"><select id="select_opo" style="height: 100%; width: 70%" onchange="get_obj(this.value); this.setAttribute('disabled', 'true')"
                                                                     class="select-css">
                                            <option value="">Наименование ОПО...</option>

                                        </select></td>
                                </tr>
                                <tr id="obj" style="display: none">
                                    <th style="text-align: center">Элемент ОПО</th>
                                    <td style="padding: 0px"><select id="id_obj" style="height: 100%; width: 70%" onchange="get_typetb(this.value); this.setAttribute('disabled', 'true')"
                                                                     class="select-css">
                                            <option value="">Элемент ОПО...</option>

                                        </select></td>
                                </tr>
                                <tr id="tb" style="display: none">
                                    <th style="text-align: center">Тип ТБ</th>
                                    <td style="padding: 0px"><select id="type_tb" style="height: 100%; width: 70%" onchange="get_tb(this.value); this.setAttribute('disabled', 'true')"
                                                                     class="select-css">
                                            <option value="">Тип ТБ...</option>

                                        </select></td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a href="#" id="save_button" style="display: none" onclick="save()">Сохранить</a></div>
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a style="background-color: #CD5C5C" href="/docs/directory_tb">Отменить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function get_opo(id_do){
            $.ajax({
                url: '/get_do/'+id_do,
                type: 'GET',
                success: (res) => {
                    var select_opo = document.getElementById('select_opo')
                    for(var opo of res){
                        var option = new Option(opo['full_name_opo'], opo['id_opo'])
                        select_opo.append(option)
                    }
                    document.getElementById('opo').style.display = ''
                }
            })
        }
        function get_obj(id_opo){
            $.ajax({
                url: '/get_obj/'+id_opo,
                type: 'GET',
                success: (res) => {
                    var select_opo = document.getElementById('id_obj')
                    for(var opo of res){
                        var option = new Option(opo['full_name_obj'], opo['id_obj'])
                        select_opo.append(option)
                    }
                    document.getElementById('obj').style.display = ''
                }
            })
        }
        function get_typetb(id_obj){
            $.ajax({
                url: '/get_typetb/'+id_obj,
                type: 'GET',
                success: (res) => {
                    var select_opo = document.getElementById('type_tb')
                    for(var opo of res){
                        var option = new Option(opo['full_name_type'], opo['type_tb'])
                        select_opo.append(option)
                    }
                    document.getElementById('tb').style.display = ''
                }
            })
        }
        function get_tb(type_tb){
            $.ajax({
                url: '/get_tb/'+type_tb,
                type: 'GET',
                success: (res) => {
                    var table_body = document.getElementById('table_obj')
                    for (var row of res){
                        var tr = document.createElement('tr')
                        tr.innerHTML+=`<th style="text-align: center">${row['text']}</th>`
                        tr.innerHTML+=`<td style="padding: 0px"><input type="${row['type']}" id="${row['id']}"
                                                                style="height: 100%; width: 95%"
                                                                class="text-field__input data_tb"></td>`
                        table_body.appendChild(tr);
                    }
                    document.getElementById('save_button').style.display = ''
                    document.getElementById('select_type_tb').textContent = type_tb
                }
            })
        }
        function save() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var params = ['id_obj', 'type_tb']
            var inputs = document.getElementsByClassName('data_tb')
            for (var input of inputs){
                params.push(input.id)
            }
            var out_data = []
            var check_data = true
            for (var param of params) {
                if (param !== 'guid_tb'){
                    if (document.getElementById(param).value){
                        out_data[param] = document.getElementById(param).value
                    }else {
                        check_data = false
                    }
                }else {
                    out_data[param] = document.getElementById(param).value
                }
            }

            if (!check_data){
                alert('Неверно заполнена форма!')
            }else{
                // console.log(out_data)
                $.ajax({
                    url: '/docs/directory_tb/save/'+document.getElementById('select_type_tb').textContent,
                    type: 'POST',
                    data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                    success: (res) => {
                        // console.log(res)
                        window.location.href = '/docs/directory_tb'
                    }
                })
            }
        }

    </script>

@endsection
