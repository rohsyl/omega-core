<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediaPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media', function(Blueprint $table) {
            $table->unsignedBigInteger('owner_id')->nullable()->after('parent_id');
            $table->unsignedBigInteger('group_id')->nullable()->after('owner_id');
            $table->boolean('is_system')->default(0)->after('description');
            $table->string('owner_permission')->nullable()->after('is_system');
            $table->string('group_permission')->nullable()->after('owner_permission');
            $table->string('other_permission')->nullable()->after('group_permission');
            $table->string('public_permission')->nullable()->after('other_permission');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media', function(Blueprint $table) {
            $table->dropColumn('owner_id');
            $table->dropColumn('group_id');
            $table->dropColumn('is_system');
            $table->dropColumn('owner_permission');
            $table->dropColumn('group_permission');
            $table->dropColumn('other_permission');
            $table->dropColumn('public_permission');
        });
    }
}
