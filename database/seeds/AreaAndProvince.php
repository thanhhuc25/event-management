<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Area;
use App\Province;

class AreaAndProvince extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            "北海道" => ["北海道"],
            "東北" => ["青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県"],
            "関東" => ["茨城県", "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県"],
            "中部" => ["新潟県", "富山県", "石川県", "福井県", "山梨県", "長野県", "岐阜県", "静岡県", "愛知県"],
            "近畿" => ["三重県", "滋賀県", "京都府", "大阪府", "兵庫県", "奈良県", "和歌山県"],
            "中国" => ["鳥取県", "島根県", "岡山県", "広島県", "山口県"],
            "四国" => ["徳島県", "香川県", "愛媛県", "高知県"],
            "九州" => ["福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"]
        ];
        foreach ($areas as $area => $province){
            $a = new Area;
            $a->name = $area;
            $a->save();
            foreach ($province as $item){
                $p = new Province;
                $p->name = $item;
                $p->area_id = $a->id;
                $p->save();
            }
        }

    }
}
