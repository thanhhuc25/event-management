<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed"
                    data-toggle="collapse" data-target="#header-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route("adminIndex")}}">
                {{"イベンド管理"}}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="header-collapse">
            <ul class="nav navbar-nav">
                {{--<li>--}}
                    {{--<a href="{{route("adminEventList")}}" title="イベントリスト">--}}
                        {{--{{"イベントリスト"}}--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li>
                    <a href="{{route("adminEventCreate")}}" title="イベント作成">
                        {{"イベント作成"}}
                    </a>
                </li>
                @if(Auth::user()->is_admin==1)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"
                           data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{"アカウント"}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route("adminAccounts")}}" title="リスト">{{"リスト"}}</a></li>
                            <li><a href="{{route("adminAccountCreate")}}" title="登録">{{"登録"}}</a></li>
                        </ul>
                    </li>
                @endif

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                       role="button" aria-haspopup="true"
                       aria-expanded="false">
                        {{"設定"}}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("adminProfile")}}" title="{{"プロフィール"}}">{{"プロフィール"}}</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route("adminLogout")}}" title="{{"ログアウト"}}">{{"ログアウト"}}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>