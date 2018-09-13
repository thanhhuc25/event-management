<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if(strtolower($request->getMethod())=="post") {
            $user = User::findOrFail($user->id);
            $user->first_name = $request->input("first_name", "");
            $user->last_name = $request->input("last_name", "");
            if($request->input("change_password", "")){
                $pwd=$request->input("new_password", "");
                $cfPwd=$request->input("confirm_password", "");
                if($pwd!=$cfPwd){
                    Session::flash('message-class', 'alert-danger');
                    Session::flash('message', 'パスワードを確認してください');
                    return view('admin.profile', ["user"=>$user]);
                } else{
                    $user->password = Hash::make($pwd);
                }
            }
            $user->save();
            Session::flash('message', 'アカウントが編集しました');
        }
        return view('admin.profile', ["user"=>$user]);
    }

}
