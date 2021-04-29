<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemberAcl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function(Blueprint $table) {
            $table->string('acl')->nullable()->after('is_enabled');
        });
        Schema::table('member_groups', function(Blueprint $table) {
            $table->string('acl')->nullable()->after('name');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function(Blueprint $table) {
            $table->dropColumn('acl');
        });
        Schema::table('member_groups', function(Blueprint $table) {
            $table->dropColumn('acl');
        });
    }
}
