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
            $table->text('open_date_time')->nullable();

            $table->dateTime('open_date2')->nullable();
            $table->text('open_date_time2')->nullable();
            $table->dateTime('open_date3')->nullable();
            $table->text('open_date_time3')->nullable();
            $table->dateTime('open_date4')->nullable();
            $table->text('open_date_time4')->nullable();
            $table->dateTime('open_date5')->nullable();
            $table->text('open_date_time5')->nullable();

            $table->dropColumn(['end_date']);
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
