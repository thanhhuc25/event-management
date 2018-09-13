<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Province;
use App\Category;
use App\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = $this->_filterEvents([]);
        return $this->_render($events);
    }

    private function _render($events){
        $areas = Area::all();
        $provinces = Province::all();
        $categories = Category::all();

        return view('home', ["areas"=>$areas,
            "provinces"=>$provinces,
            "categories"=>$categories,
            "events"=>$events
        ]);
    }

    public function search(Request $request)
    {
        $area = $request->query('area', "") ;
        $province = $request->query('province', "");
        $category = $request->query('category', "");
        $filters = ["area"=>$area, "province"=>$province, "category"=>$category];
        $events = $this->_filterEvents($filters);
        return $this->_render($events);
    }

    private function _filterEvents($filters){
        $now = date('Y-m-d H:i');
        $sixtyDay = date('Y-m-d H:i');
        $sixtyDay = date('Y-m-d H:i', strtotime($sixtyDay. ' + 62 days'));
        $events = Event::whereBetween('open_date',[$now, $sixtyDay])->orderBy("open_date","asc");
        if(isset($filters["province"]) && $filters["province"]){
            $events = $events->where("province_id", intval($filters["province"]));
        }
        if(isset($filters["area"]) && $filters["area"]){
            /** @var \App\Area $area */
            $area = Area::where("id",intval($filters["area"]))->first();
            if($area){
                $provinces = $area->provinces;
                $provinceIds = $provinces->map(function ($p) {
                    return $p->id;
                });
                if(count($provinceIds) > 0) {
                    $events = $events->whereIn("province_id", $provinceIds);
                }
            }
        }

        if(isset($filters["category"]) && $filters["category"]){
            $events = $events->where("category_id", intval($filters["category"]));
        }
        return $events->get();
    }
}
