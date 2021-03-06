@extends('layouts.admin')

@section('title')
    {{"プロフィール"}}
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">プロフィール</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" class="form-acc">
                            @csrf

                            <div class="form-group">
                                <label for="username">{{"ユーザー名"}}</label>
                                <input value="{{$user->username}}" class="form-control"
                                       id="username" disabled placeholder="ユーザー名">
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="change_password">
                                        {{"パスワードを編集する"}}
                                    </label>
                                </div>
                                <div id="div-change-pwd" style="display: none">
                                    <input type="password" class="form-control"
                                           name="new_password" placeholder="パスワード">
                                    <div style="padding-top: 5px">
                                        <input type="password" class="form-control"
                                               name="confirm_password" placeholder="パスワード確認">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">{{"名"}}</label>
                                <input value="{{$user->first_name}}" class="form-control" id="first_name" name="first_name" placeholder="名">
                            </div>
                            <div class="form-group">
                                <label for="password">{{"姓"}}</label>
                                <input value="{{$user->last_name}}" class="form-control" id="last_name" name="last_name" placeholder="姓">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="is_admin" {{$user->is_admin ? " checked" : " "}} disabled>
                                    {{"管理者"}}
                                </label>
                            </div>
                            <div>
                                <br/>
                                <button class="btn btn-primary ">
                                    {{$user->id == 0 ? "登録" : "編集"}}
                                </button>
                                <a id="delete-btn" href="{{route("adminAccountDelete", ["id"=>$user->id])}}" style="float: right" class="btn btn-danger ">
                                    {{"削除"}}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("footer")
    <script>
        $(document).ready(function () {

            $("#delete-btn").click(function () {
                var result = confirm("削除すますか?");
                if (!result) {
                    return false;
                }
            });

            if($(("[name='change_password']")).length > 0) {
                $(("[name='change_password']")).change(function () {
                    if(this.checked) {
                        $("#div-change-pwd").show();
                    } else{
                        $("#div-change-pwd").hide();
                    }
                });
            }


        });
    </script>
@endsection