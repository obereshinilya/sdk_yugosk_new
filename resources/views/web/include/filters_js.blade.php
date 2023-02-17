<style>
    label {
        font: 14px 'Fira Sans', sans-serif;
    }

    .checkbox {
        float: left;
        width: 90%;
        text-align: left;
    }

    input {
        margin: 0.4rem;
    }

    fieldset {
        position: absolute;
        width: 250px;
        height: 500px;
        right: -240px;
        bottom: -510px;
        background-color: white;
        z-index: 30;
        padding: 3px;
        overflow-y: auto
    }

    .img {
        position: absolute;
        right: 0px;
        bottom: 0px;
        width: 20px;
        border: 2px solid white;
        border-radius: 2px;
        background-color: white
    }

    .img:hover {
        border: 2px solid darkgray;
    }
</style>
<script>
    let img;
    document.querySelectorAll('.filter').forEach((el) => {
        img = document.createElement('img');
        img.classList.add('img');
        img.src = "{{asset('assets/images/icons/arrow_bottom.svg')}}";
        img.onclick = function () {
            get_group_conclusion(el.classList[1], el, el.classList[2]);
            hide_all_field('fieldsheet_' + el.classList[1])
            console.log(el.classList[1]);
        }
        el.append(img)
    })

    function get_group_conclusion(column, th, table) {
        if (!document.getElementById('fieldsheet_' + column)) {
            let params = {};
            let fieldsheets = document.getElementsByTagName('fieldset');
            for (var fieldsheet of fieldsheets) {
                var check_input_all = fieldsheet.getElementsByTagName('input')
                var check_input = []
                var all_input_checked = true
                for (var one_input of check_input_all) {
                    if (one_input.hasAttribute('checked')) {
                        check_input.push(one_input.getAttribute('name'))
                    } else {
                        all_input_checked = false
                    }
                }
                params[fieldsheet.id.replace('fieldsheet_', '')] = check_input.join('!!');
            }
            if (document.getElementById('select__year')) {
                // console.log(document.getElementById('select__year').value)
                params['year'] = document.getElementById('select__year').value
            }
            console.log(params)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/get_group/' + table + '/' + column,
                type: 'POST',
                data: params,
                success: (res) => {
                    var fieldset = document.createElement('fieldset')
                    fieldset.id = 'fieldsheet_' + column
                    fieldset.innerHTML += `<div class="doc_header" style="padding: 0px; width: 100%;  top: 0px; position: sticky">
    <input type="text" id="search_fieldsheet_${column}" style="margin: 9px 0px" placeholder="Поиск..." oninput="find_field('fieldsheet_${column}')">
    <div class="bat_add" style="margin-left: 0px;">
        <a
            onclick="get_data()"
            style="display: inline-block; margin-left: 0px">Применить</a>
        <a class="on_off_btn"
           onclick="checked('fieldsheet_${column}')"
           style="display: inline-block; margin-left: 0px">Вкл/выкл все</a>
    </div>
</div>`
                    for (var row of res) {
                        if (column == 'completion_mark') {
                            fieldset.innerHTML += `<div class="checkbox">
    <input type="checkbox" class="checkbox_button" name="${row[column]}" checked>
    <label for="${row[column]}">${row[column] ? 'Выполнено' : 'Не выполнено'}</label>
</div>`
                        } else {
                            fieldset.innerHTML += `<div class="checkbox">
    <input type="checkbox" class="checkbox_button" name="${row[column]}" checked>
    <label for="${row[column]}">${row[column]}</label>
</div>`
                        }
                    }
                    th.appendChild(fieldset)
                    checked()
                }
            })
        }
    }

    function hide_all_field(id) {
        for (var field of document.getElementsByTagName('fieldset')) {
            if (field.id == id) {
                if (field.style.display === 'none') {
                    field.style.display = ''
                } else {
                    field.style.display = 'none'
                }
            } else {
                field.style.display = 'none'
                field.getElementsByClassName('on_off_btn')[0].onclick = ''
                for (var input of field.getElementsByTagName('input')) {
                    input.setAttribute('disabled', true)
                }
            }
        }
    }

    function checked(id) {
        if (id) {
            var true_button = false
            var checkboxes = document.getElementById(id).getElementsByClassName('checkbox_button')
            for (var check of checkboxes) {
                if (check.hasAttribute('checked')) {
                    true_button = true
                }
            }
            if (true_button) {
                for (var check of checkboxes) {
                    check.removeAttribute('checked')
                }
            } else {
                for (var check of checkboxes) {
                    check.setAttribute('checked', true)
                }
            }
        } else {
            for (var check of document.getElementsByClassName('checkbox_button')) {
                check.addEventListener('click', function () {
                    if (this.hasAttribute('checked')) {
                        this.removeAttribute('checked')
                    } else {
                        this.setAttribute('checked', true)
                    }
                })
            }
        }
    }

    function print_data(type) {
        var fieldsheets = document.getElementsByTagName('fieldset')
        var data = {}
        for (var fieldsheet of fieldsheets) {
            var check_input_all = fieldsheet.getElementsByTagName('input')
            var check_input = []
            var all_input_checked = true

            for (var one_input of check_input_all) {
                if (one_input.hasAttribute('checked')) {
                    check_input.push(one_input.getAttribute('name'))
                } else {
                    all_input_checked = false
                }
            }
            console.log(check_input.join(','))
            data[fieldsheet.id.replace('fieldsheet_', '')] = check_input.join('!!')
        }
        data['year'] = document.getElementById('select__year').value
        for (let key in data) {
            const input = document.createElement('input')
            input.type = 'text'
            input.name = key;
            input.value = data[key];
            if (type == 'excel') {
                document.getElementById('excel_form').append(input)
            } else {
                document.getElementById('pdf_form').append(input)
            }
        }
        if (type == 'excel') {
            document.getElementById('excel_button').click()
        } else {
            document.getElementById('pdf_button').click()
        }
    }
</script>
