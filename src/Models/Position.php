<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public $timestamps = false;

    public function page(){
        return $this->belongsTo(Page::class, 'fkPage', 'id');
    }

    public function module(){
        return $this->belongsTo(Module::class, 'fkModule', 'id');
    }
}
