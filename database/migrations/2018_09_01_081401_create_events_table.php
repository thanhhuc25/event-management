<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shop_name')->nullable();
            $table->unsignedInteger("category_id")->nullable();
            $table->foreign("category_id")->references("id")->on("categories");
            $table->unsignedInteger("user_created_id")->nullable();
            $table->foreign("user_created_id")->references("id")->on("users")->onDelete('set null');
            $table->dateTime('open_date')->nullable();
            $table->string('position')->nullable();
            $table->string('phone')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
