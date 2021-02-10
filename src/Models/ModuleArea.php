<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleArea extends Model
{
    public $timestamps = false;

    public function positions(){
        return $this->hasMany(Position::class, 'fkModuleArea', 'id')->orderBy('order');
    }
}
