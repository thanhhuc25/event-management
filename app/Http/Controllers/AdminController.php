<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use App\Event;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLogin()
    {
        return view('admin.login');
    }



    public function doLogin(Request $request)
    {
        $loggedIn = $this->attemptLogin($request);
        if($loggedIn){
            return Redirect::to('admin');
        } else{
            return Redirect::to('admin/login')
                ->withErrors(["ユーザーネームまたはパスワードが違います"]);
        }
    }

    protected function loggedOut(Request $request)
    {
        return Redirect::to('admin/login');
    }

    public function index()
    {
        $user = Auth::user();
        if($user->is_admin==1) {
            $recentEvents = Event::orderBy("created_at","desc")->take(5)->get();
            $count = Event::count();
        }
        else{
            $recentEvents = Event::where("user_created_id",$user->id)->orderBy("created_at","desc")->take(5)->get();
            $count = Event::where("user_created_id",$user->id)->count();
        }

        return view('admin.index',["recentEvents"=>$recentEvents, "count"=>$count]);
    }


    protected function credentials(Request $request)
    {
        return array(
            'username'     => $request->input("username", ""),
            'password'     => $request->input("password", "")
        );
    }
}
