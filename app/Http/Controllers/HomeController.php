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


        if(isset($_GET['map_url'])){

            if(strpos($_GET['map_url'],'/@') !== false){
                $check_arrayurl1 = explode("/@",$_GET['map_url']);
                $check_arrayurl2 = explode("/",$check_arrayurl1[1]);
                $check_arrayurl3 = explode(",",$check_arrayurl2[0]);

                $return_array['lat'] = array($check_arrayurl3[0]);
                $return_array['lng'] = array($check_arrayurl3[1]);

            }else{
                try{
                    $header = get_headers($_GET['map_url']);
                    $geturl = preg_replace('@^Location: @','',$header[7]);
                    $arrayurl1 = explode("/@",$geturl);
                    $arrayurl2 = explode("/",$arrayurl1[1]);
                    $arrayurl3 = explode(",",$arrayurl2[0]);

                    $return_array['lat'] = array($arrayurl3[0]);
                    $return_array['lng'] = array($arrayurl3[1]);
                }catch (\Exception $e){
                    $url=$_GET['map_url'];
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_HEADER, true);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $a = curl_exec($ch); // $a will contain all headers
                    $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL
                    $geturl = $url;
                    $arrayurl1 = explode("/@",$geturl);
                    $arrayurl2 = explode("/",$arrayurl1[1]);
                    $arrayurl3 = explode(",",$arrayurl2[0]);
                    $return_array['lat'] = array($arrayurl3[0]);
                    $return_array['lng'] = array($arrayurl3[1]);
                }
            }

            echo json_encode($return_array);

            exit;
        }
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
        if($area==""){
            $area = $request->input("area", "");
        }
        if($province==""){
            $province = $request->input("province", "");
        }
        if($category==""){
            $category = $request->input("category", "");
        }
        $filters = ["area"=>$area, "province"=>$province, "category"=>$category];
        $events = $this->_filterEvents($filters);
        return $this->_render($events);
    }

    private function _filterEvents($filters){
        $now = date('Y-m-d 00:00');
        $sixtyDay = date('Y-m-d H:i');
        $sixtyDay = date('Y-m-d H:i', strtotime($sixtyDay. ' + 60 days'));

        $events = Event::where(function ($query) use ($now, $sixtyDay){
            $query->orWhereBetween('open_date',[$now, $sixtyDay]);
            $query->orWhereBetween('open_date2',[$now, $sixtyDay]);
            $query->orWhereBetween('open_date3',[$now, $sixtyDay]);
            $query->orWhereBetween('open_date4',[$now, $sixtyDay]);
            $query->orWhereBetween('open_date5',[$now, $sixtyDay]);
        });
        $events = $events->orderBy("open_date","asc");


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
