<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plugin_form_id');
            $table->unsignedBigInteger('page_id')->nullable();
            $table->string('name');
            $table->longText('param');
            $table->boolean('is_enabled')->default(true);
            $table->boolean('is_widget')->default(false);
            $table->integer('order' );
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
        Schema::dropIfExists('components');
    }
}
