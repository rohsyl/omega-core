<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePluginFormEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugin_form_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plugin_form_id');
            $table->string('name');
            $table->string('type');
            $table->longText('param')->nullable();
            $table->string('title')->nullable();
            $table->string('heading')->nullable();
            $table->text('description')->nullable();
            $table->boolean('mandatory')->default(0);
            $table->integer('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_entries');
    }
}
