<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ログイン</title>
    <!-- Bootstrap -->
    <link href="{{ asset('assets/bootstrap-3/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/login.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
                <form class="card" method="post" action="">
                    @csrf

                    <div class="card-title">{{"イベント管理"}}</div>
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">{{$errors->first()}}</div>
                    @endif

                    <div class="form-group">
                        <label for="username">ユーザーネーム</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="ユーザーネーム">
                    </div>
                    <div class="form-group">
                        <label for="password">パスワード</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="パスワード">
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">ログイン</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>