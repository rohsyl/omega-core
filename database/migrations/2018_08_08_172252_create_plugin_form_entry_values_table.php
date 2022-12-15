<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePluginFormEntryValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugin_form_entry_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plugin_form_entry_id');
            $table->unsignedBigInteger('component_id');
            $table->string('locale')->nullable();
            $table->longText('value')->nullable();


            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_entry_values');
    }
}
