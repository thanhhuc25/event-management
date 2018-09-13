<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\User;

class DataTableUsersController extends Controller
{
    public function datatable()
    {
        return view('datatable');
    }

    public function getUsers()
    {
        $user = Auth::user();
        if(!$user->is_admin==1) {
            abort(404);
        }
        $users = User::all();
        return \DataTables::of($users)
            ->addColumn('action', function ($e) {
                return '<a href="'.route("adminAccountEdit", ["id"=>$e->id]).'">'."編集".'</a>';
            })
            ->addColumn('role', function ($e) {
                return $e->is_admin == 1 ? "管理人" : "";
            })
            ->rawColumns([ 'action'])
            ->editColumn("password", function ($u){
                return "xxxxxx";
            })
            ->addIndexColumn()
            ->make(true);
    }
}
