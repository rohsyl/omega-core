<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAcl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('acl')->nullable()->after('remember_token');
        });
        Schema::table('groups', function(Blueprint $table) {
            $table->string('acl')->nullable()->after('is_system');
        });
        Schema::drop('permissions');
        Schema::drop('group_permission');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('acl');
        });
        Schema::table('groups', function(Blueprint $table) {
            $table->dropColumn('acl');
        });
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
        });
        Schema::create('group_permission', function (Blueprint $table) {
            $table->integer('group_id')->unsigned();
            $table->integer('permission_id')->unsigned();
        });
    }
}
