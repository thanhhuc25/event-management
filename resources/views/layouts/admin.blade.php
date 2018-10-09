<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title", "イベント管理")</title>
    <!-- Bootstrap -->
    <link href="{{ asset('assets/bootstrap-3/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet">
    @section("header")
    @show

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div>
    @include("admin.partials._header")
    <div class="content">
        <div class="container">
            @if(Session::has('message'))
                <div class="alert {{Session::has("message-class") ? Session::get("message-class") : 'alert-success'}} ">
                    {{ Session::get('message') }}
                </div>
            @endif
        </div>
        @yield('content')
    </div>

</div>

<script src="{{asset("js/jquery.min.js")}}"></script>
<script src="{{asset("assets/bootstrap-3/js/bootstrap.min.js")}}"></script>
@yield('footer', "")
</body>
</html>