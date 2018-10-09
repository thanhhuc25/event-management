<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimesToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(("open_date_time"));
            for($i=2; $i<=5;$i++){
                $table->dropColumn(("open_date_time".$i));
            }
            // new times
            for($i=1;$i<=5;$i++){
                $colSuffix = "_".$i;
                // comment
                $table->text(("comment_day".$colSuffix))->nullable();
                // times
                for($row = 1; $row<=5; $row++){
                    $rowSuffix =  "_".$row;
                    $table->string(("opentime_day_hour_start".$colSuffix.$rowSuffix), 2)->nullable();
                    $table->string(("opentime_day_minute_start".$colSuffix.$rowSuffix), 2)->nullable();
                    $table->string(("opentime_day_hour_end".$colSuffix.$rowSuffix), 2)->nullable();
                    $table->string(("opentime_day_minute_end".$colSuffix.$rowSuffix), 2)->nullable();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
