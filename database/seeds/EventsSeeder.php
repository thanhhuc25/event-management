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
                "open_datetime"=>"10:00～ 12:00, 13:00～14:00, 14:00～15:00",
                "open_date2"=>"2018-10-08",
                "open_datetime2"=>"10:00～ 12:00, 13:00～14:00, 14:00～15:00",
                "phone"=> "0495-72-0014", "position"=>"埼玉県本庄市児玉町児玉１５１", "comment"=>"充実ラインナップのマキタ製品をご体感ください",
                "lat"=>36.18982500594721, "long"=>139.1293496, "province"=>11
            ],
            [
                "shop_name"=>"中戸金物店",
                "open_date"=>"2018-09-08",
                "open_datetime"=>"10:00～ 12:00, 13:00～14:00, 14:00～15:00",
                "phone"=> "0495-72-0014", "position"=>"埼玉県本庄市児玉町児玉１５１", "comment"=>"充実ラインナップのマキタ製品をご体感ください",
                "lat"=>36.18982500594721, "long"=>139.1293496, "province"=>11
            ]

        ];
        foreach ($events as $event){
            $e = new Event;
            $e->province_id = isset($event["province"]) ? $event["province"]: null;
            $e->category_id = isset($event["category"]) ? $event["category"]: null;
            $e->shop_name = isset($event["shop_name"]) ? $event["shop_name"]: null;
            $e->open_date = isset($event["open_date"]) ? $event["open_date"]: null;
            $e->open_date_time = isset($event["open_datetime"]) ? $event["open_datetime"]: null;
            $e->open_date2 = isset($event["open_date2"]) ? $event["open_date2"]: null;
            $e->open_date_time2 = isset($event["open_datetime2"]) ? $event["open_datetime2"]: null;
            $e->phone = isset($event["phone"]) ? $event["phone"]: null;
            $e->comment = isset($event["comment"]) ? $event["comment"]: null;
            $e->lat = isset($event["lat"]) ? $event["lat"]: null;
            $e->long = isset($event["long"]) ? $event["long"]: null;
            $e->position = isset($event["position"]) ? $event["position"]: null;
            $e->save();
        }
    }
}
