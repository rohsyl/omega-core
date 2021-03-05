<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertRights extends Migration
{

    /**
     * @var array
     */
    private $rights = [
        // TODO : Define permissions
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*// empty the rights table
        DB::table('permissions')->delete();

        // and fill it with the new rights
        foreach($this->rights as $right){

        }*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*foreach($this->rights as $right){
            DB::table('permissions')
                ->where('name', $right[0])
                ->delete();
        }*/
    }
}
