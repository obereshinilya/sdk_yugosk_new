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

    <div class="inside_content">
        <div class="row justify-content-center" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h2 class="text-muted" style="text-align: center">Добавление записи в справочник элементов ОПО
                        </h2>
                    </div>

                    <div class="inside_tab_padding form51"
                         style="height:70vh; padding: 0px; margin: 0px; overflow-y: auto">
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
                                    <td style="padding: 0px"><select style="height: 100%; width: 70%" onchange="get_opo_from_do(this.value); this.setAttribute('disabled', 'true')"
                                                                     class="select-css">
                                            <option value="">Наименование филиала...</option>
                                        @foreach(\App\Models\Main_models\RefDO::orderby('short_name_do')->get() as $row)
                                                <option value="{{$row->id_do}}">{{$row->short_name_do}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr id="opo" style="display: none">
                                    <th style="text-align: center">ОПО</th>
                                    <td style="padding: 0px"><select id="id_opo" style="height: 100%; width: 70%" onchange="this.setAttribute('disabled', 'true')"
                                                                     class="select-css">
                                            <option value="">Наименование ОПО...</option>
                                            {{--                                            @foreach(\App\Models\Main_models\RefOpo::all() as $row)--}}
{{--                                                <option value="{{$row->id_opo}}">{{$row->full_name_opo}}</option>--}}
{{--                                            @endforeach--}}
                                        </select></td>
                                </tr>
                                <tr id="type" style="display: none">
                                    <th style="text-align: center">Тип элемента ОПО</th>
                                    <td style="padding: 0px"><select id="type_obj" style="height: 100%; width: 70%"
                                                                     class="select-css">
                                            <option value="">Тип элемента ОПО...</option>
                                        @foreach(\App\Models\Main_models\TypeObj::all() as $row)
                                                <option value="{{$row->type_obj}}">{{$row->full_name_type}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr style="display: none">
                                    <th style="text-align: center">Краткое наименование элемента ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="short_name_obj"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr style="display: none">
                                    <th style="text-align: center">Полное наименование элемента ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="full_name_obj"
                                                                    style="height: 100%; width: 95%"
                                                                    class="text-field__input"></td>
                                </tr>
                                <tr style="display: none">
                                    <th style="text-align: center">Идентификатор элемента ОПО</th>
                                    <td style="padding: 0px"><input type="text" id="guid_obj"
                                                                       style="height: 100%; width: 95%"
                                                                       class="text-field__input"></td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a href="#" onclick="save()">Сохранить</a></div>
                                <div class="bat_add"
                                     style="width: 10%; display: inline-block; margin-top: 20px; margin-bottom: 20px; margin-left: 0px">
                                    <a style="background-color: #CD5C5C" href="/docs/directory_obj">Отменить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function get_opo_from_do(id_do){
            $.ajax({
                url: '/get_do/'+id_do,
                type: 'GET',
                success: (res) => {
                    var select_opo = document.getElementById('id_opo')
                    for(var opo of res){
                        var option = new Option(opo['full_name_opo'], opo['id_opo'])
                        select_opo.append(option)
                    }
                    var trs = document.getElementById('table_obj').getElementsByTagName('tr')
                    for(var tr of trs){
                        tr.style.display = ''
                    }
                }
            })
            // console.log(id_do)
        }
        function save() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var params = ['id_opo', 'type_obj', 'short_name_obj', 'full_name_obj', 'guid_obj',]
            var out_data = []
            var check_data = true
            for (var param of params) {
                if (param !== 'guid_obj'){
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
                $.ajax({
                    url: '/docs/directory_obj/save',
                    type: 'POST',
                    data: {keys: JSON.stringify(Object.keys(out_data)), values: JSON.stringify(Object.values(out_data))},
                    success: (res) => {
                        window.location.href = '/docs/directory_obj'
                    }
                })
            }

        }

    </script>

@endsection
