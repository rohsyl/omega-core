<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugin_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('plugin_id');
            $table->string('name')->unique();
            $table->string('title');
            $table->boolean('widgetable')->default(false);
            $table->boolean('componentable')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
