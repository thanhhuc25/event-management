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
                "shop_name"=>"（有）チハラ金物店", "open_date"=>"2018-09-08 10:00", "end_date"=>"2018-09-08 17:00",
                "phone"=> "0495-72-0014", "position"=>"埼玉県本庄市児玉町児玉１５１", "comment"=>"充実ラインナップのマキタ製品をご体感ください",
                "lat"=>36.18982500594721, "long"=>139.1293496, "province"=>11
            ],
            [
                "shop_name"=>"ホームセンターコーナン 寝屋川昭栄店", "open_date"=>"2018-09-09 10:00", "end_date"=>"2018-09-09 14:00",
                "phone"=> "072-811-3660", "position"=>"大阪府寝屋川市昭栄町18番20号", "comment"=>"今年もやります！園芸ファンに大人気、マキタの充電式園芸工具が一堂に！
                    　新商品も続々登場。最新の草刈機など、実際に触ってみたくなる商品が
                    　勢ぞろい。",
                "lat"=>34.758573, "long"=>135.62562000000003, "category"=>1, "province"=>27
            ],
            [
                "shop_name"=>"ホームセンターコーナン 外環新石切店", "open_date"=>"2018-09-09 10:00", "end_date"=>"2018-09-09 14:00",
                "phone"=> "072-811-3660", "position"=>"大阪府寝屋川市昭栄町18番20号", "comment"=>"今年もやります！園芸ファンに大人気、マキタの充電式園芸工具が一堂に！
                    　新商品も続々登場。最新の草刈機など、実際に触ってみたくなる商品が
                    　勢ぞろい。",
                "lat"=>34.758573, "long"=>135.62562000000003, "category"=>1, "province"=>27
            ],
            [
                "shop_name"=>"後藤機工㈱", "open_date"=>"2018-09-09 10:00", "end_date"=>"2018-09-09 14:00",
                "phone"=> "072-811-3660", "position"=>"大阪府寝屋川市昭栄町18番20号", "comment"=>"今年もやります！園芸ファンに大人気、マキタの充電式園芸工具が一堂に！
                    　新商品も続々登場。最新の草刈機など、実際に触ってみたくなる商品が
                    　勢ぞろい。",
                "lat"=>34.758573, "long"=>135.62562000000003,  "province"=>1
            ],
            [
                "shop_name"=>"（有）有木機工", "open_date"=>"2018-10-09 10:00", "end_date"=>"2018-09-09 14:00",
                "phone"=> "072-811-3660", "position"=>"大阪府寝屋川市昭栄町18番20号", "comment"=>"今年もやります！園芸ファンに大人気、マキタの充電式園芸工具が一堂に！
                    　新商品も続々登場。最新の草刈機など、実際に触ってみたくなる商品が
                    　勢ぞろい。",
                "lat"=>34.758573, "long"=>135.62562000000003, "category"=>1, "province"=>1
            ],
            [
                "shop_name"=>"佐伯機工", "open_date"=>"2018-10-10 10:00", "end_date"=>"2018-09-09 14:00",
                "phone"=> "072-811-3660", "position"=>"大阪府寝屋川市昭栄町18番20号", "comment"=>"今年もやります！園芸ファンに大人気、マキタの充電式園芸工具が一堂に！
                    　新商品も続々登場。最新の草刈機など、実際に触ってみたくなる商品が
                    　勢ぞろい。",
                "lat"=>34.758573, "long"=>135.62562000000003,  "province"=>18
            ]
        ];
        foreach ($events as $event){
            $e = new Event;
            $e->province_id = isset($event["province"]) ? $event["province"]: null;
            $e->category_id = isset($event["category"]) ? $event["category"]: null;
            $e->shop_name = isset($event["shop_name"]) ? $event["shop_name"]: null;
            $e->open_date = isset($event["open_date"]) ? $event["open_date"]: null;
            $e->end_date = isset($event["end_date"]) ? $event["end_date"]: null;
            $e->phone = isset($event["phone"]) ? $event["phone"]: null;
            $e->comment = isset($event["comment"]) ? $event["comment"]: null;
            $e->lat = isset($event["lat"]) ? $event["lat"]: null;
            $e->long = isset($event["long"]) ? $event["long"]: null;
            $e->position = isset($event["position"]) ? $event["position"]: null;
            $e->save();
        }
    }
}
