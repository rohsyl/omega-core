<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use rohsyl\OmegaCore\Models\Media;

class MediaRoot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $root = Media::create([
            'is_system' => true,
            'parent_id' => null,
            'name' => Media::ROOT_DIRECTORY,
            'type' => Media::TYPE_DIRECTORY,
        ]);

        Media::create([
            'is_system' => true,
            'parent_id' => $root->id,
            'name' => Media::PUBLIC_DIRECTORY,
            'type' => Media::TYPE_DIRECTORY,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Media::where('name', Media::ROOT_DIRECTORY)->get()->delete();
        Media::where('name', Media::PUBLIC_DIRECTORY)->get()->delete();
    }
}
