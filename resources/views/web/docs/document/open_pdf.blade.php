@extends('web.layouts.app')
@section('title')
    Просмотр
@endsection

@section('content')
    {{--    Включаем всплывашку с новым сообщением о событии--}}
    @can('events-view')
        @include('web.admin.inc.new_JAS')
    @endcan
    @include('web.include.sidebar_doc')
    <style>
        table {
            -webkit-print-color-adjust: exact; /* благодаря этому заработал цвет*/
            white-space: -moz-pre-wrap; /* Mozilla, начиная с 1999 года */
            white-space: -pre-wrap; /* Opera 4-6 */
            white-space: -o-pre-wrap; /* Opera 7 */
            word-wrap: break-word;
            word-break: break-word;
        }
    </style>
    <div class="inside_content" style="margin-top: 0px">
        <div class="inside_tab_padding" style="height: 87vh; overflow-y: hidden; margin-top: 0px; padding-top: 0px">
            <object style="width: 100%; height: 100%" type="application/pdf"
                    data="{{asset($image.'?#zoom=100&scrollbar=1&toolbar=1&navpanes=1')}}">
                <p>Файл не найден.</p>
            </object>
        </div>
    </div>
    <script>

    </script>

@endsection
