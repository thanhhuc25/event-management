<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminAccountController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ( Auth::user()->is_admin==1)
                return $next($request);
            else
                abort(404, 'Access denied');
        });

    }

    public function index()
    {
        $accounts = User::orderBy("created_at", "desc")->paginate(20);
        return view('admin.accounts',["accounts"=>$accounts]);
    }

    public function create(Request $request)
    {
        $user = new User;
        $user->id = 0;
        if(strtolower($request->getMethod())=="post") {
            return $this->_save($request, $user);
        }
        return $this->_createOrEdit($request, $user);
    }
    public function edit(Request $request, $id=0)
    {
        $user = User::findOrFail($id);
        if(strtolower($request->getMethod())=="post") {
            return $this->_save($request, $user);
        }
        return $this->_createOrEdit($request, $user);
    }

    public function delete(Request $request, $id=0)
    {
        $user = User::findOrFail($id);
        $isCanDelete = false;
        $isSelfDelete = false;
        if(Auth::user()->id == $id){
            $isCanDelete = true;
            $isSelfDelete = true;
        } else {
            if ( Auth::user()->is_admin==1 && $user->is_admin != 1)
            {
                $isCanDelete = true;
                $isSelfDelete = false;
            }
        }
        if(!$isCanDelete){
            abort(404);
        }else{
            Session::flash('message', '削除しました');
            if($isSelfDelete){
                User::destroy($id);
                return Redirect::route("adminShowLogin");
            }else{
                User::destroy($id);
                return Redirect::route("adminAccounts");
            }

        }
    }



    private function _createOrEdit(Request $request, User $user){
        return view('admin.accountedit',
            [
                "user" => $user
            ]
        );
    }

    private function _save(Request $request, User $user){
        if($user->is_admin==1){
            Session::flash('message-class', 'alert-danger');
            Session::flash('message', '管理者を編集できない');
            return $this->_createOrEdit($request, $user);
        }
        if($user->id==0){
            if(!$request->input("username", "")){
                Session::flash('message-class', 'alert-danger');
                Session::flash('message', 'ユーザー名を入力してください');
                $user->password = "";
                return $this->_createOrEdit($request, $user);
            }
            $user->username = $request->input("username", "");
            $checkExitUserName = User::where("username", $user->username)->first();
            if($checkExitUserName===null){
                $user->password = $request->input("password", "");
                $user->password = Hash::make($user->password);
                $user->first_name = $request->input("first_name", "");
                $user->last_name = $request->input("last_name", "");
                if($request->input("is_admin", "")){
                    $user->is_admin = 1;
                }
                $user->save();
                Session::flash('message', 'アカウントが作成しました');
                return Redirect::route("adminAccounts");
            } else{
                Session::flash('message-class', 'alert-danger');
                Session::flash('message', 'ユーザー名が存在しました');
                $user->password = "";
                return $this->_createOrEdit($request, $user);
            }
        }
        else{
            $user->first_name = $request->input("first_name", "");
            $user->last_name = $request->input("last_name", "");
            if($request->input("is_admin", "")){
                $user->is_admin = 1;
            }
            if($request->input("change_password", "")){
                $pwd=$request->input("new_password", "");
                $cfPwd=$request->input("confirm_password", "");
                if($pwd!=$cfPwd){
                    Session::flash('message-class', 'alert-danger');
                    Session::flash('message', 'パスワードを確認してください');
                    return $this->_createOrEdit($request, $user);
                } else{
                    $user->password = Hash::make($pwd);
                }
            }
            $user->save();
            Session::flash('message', 'アカウントが編集しました');
            return Redirect::route("adminAccountEdit",["id"=>$user->id]);
        }




    }



}
