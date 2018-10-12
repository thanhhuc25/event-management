<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            [
                "shop_name"=>"（有）チハラ金物店",
                "open_date"=>"2018-09-08",
                "phone"=> "0495-72-0014", "position"=>"埼玉県本庄市児玉町児玉１５１",
                "comment"=>"充実ラインナップのマキタ製品をご体感ください",
                "lat"=>36.18982500594721, "long"=>139.1293496, "province"=>11
            ],
            [
                "shop_name"=>"中戸金物店",
                "open_date"=>"2018-09-08",
                "phone"=> "0495-72-0014", "position"=>"埼玉県本庄市児玉町児玉１５１",
                "comment"=>"充実ラインナップのマキタ製品をご体感ください",
                "lat"=>36.18982500594721, "long"=>139.1293496, "province"=>11
            ]

        ];
        foreach ($events as $event){
            $e = new Event;
            $e->province_id = isset($event["province"]) ? $event["province"]: null;
            $e->category_id = isset($event["category"]) ? $event["category"]: null;
            $e->shop_name = isset($event["shop_name"]) ? $event["shop_name"]: null;
            $e->open_date = isset($event["open_date"]) ? $event["open_date"]: null;
            $e->phone = isset($event["phone"]) ? $event["phone"]: null;
            $e->comment = isset($event["comment"]) ? $event["comment"]: null;
            $e->lat = isset($event["lat"]) ? $event["lat"]: null;
            $e->long = isset($event["long"]) ? $event["long"]: null;
            $e->position = isset($event["position"]) ? $event["position"]: null;
            $e->save();
        }
    }
}
