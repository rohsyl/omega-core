<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_widget_area', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('widget_area_id');
            $table->unsignedBigInteger('component_id');
            $table->unsignedBigInteger('page_id')->nullable();
            $table->integer('order');
            $table->dateTime('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
