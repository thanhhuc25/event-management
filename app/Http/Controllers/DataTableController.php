<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Province;
use App\Category;
use App\Event;
use Illuminate\Support\Facades\Auth;

class DataTableController extends Controller
{
    public function datatable()
    {
        return view('datatable');
    }

    public function getEvents()
    {
        $user = Auth::user();
        if($user->is_admin==1) {
            $events = Event::all();
        }
        else{
            $events = Event::where("user_created_id",$user->id);
        }
        //return \DataTables::of(Event::query())->make(true);
        return \DataTables::of($events)
            ->addColumn('action', function ($e) {
                return '<a href="'.route("adminEventEdit", ["id"=>$e->id]).'">'."編集".'</a>';
            })
            ->addColumn('category', function ($e) {
                if($e->category){
                    return $e->category->name;
                }
                return "";
            })
            ->addColumn('province', function ($e) {
                if($e->province){
                    return $e->province->name;
                }
                return "";
            })
            ->editColumn('open_date', function ($e) {
                return $e->displayOpenDate();
            })
            ->addColumn('creator', function ($e) use ($user){
                if($user->is_admin==1 && $e->user_created_id){
                    return '<a href="'.route("adminAccountEdit", ["id"=>$e->user_created_id]).'">'."作成者".'</a>';
                }
                return "";
            })
            ->rawColumns(['creator', 'action'])
            ->addIndexColumn()
            ->make(true);
    }
}
