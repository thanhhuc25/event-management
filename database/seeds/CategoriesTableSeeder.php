<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = [ "ホームセンター", "その他" ];
        foreach ($cats as $cat){
            Category::create(["name"=>$cat]);
        }
    }
}
