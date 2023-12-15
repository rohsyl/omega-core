<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetGroupsDefaultAcl extends Migration
{

    private array $groups = [
        'public' => null,
        'user' => '000000000000000000000000000001100001000110000000000',
        'administrator' => '1',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->groups as $group => $acl) {
            \rohsyl\OmegaCore\Models\Group::query()
                ->where('name', $group)
                ->update([
                    'acl' => $acl
                ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->groups as $group => $acl) {
            \rohsyl\OmegaCore\Models\Group::query()
                ->where('name', $group)
                ->update([
                    'acl' => null
                ]);
        }
    }
}
