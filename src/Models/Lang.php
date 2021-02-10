<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    public $timestamps = false;

    public function media(){
        return $this->belongsTo(Media::class, 'fkMediaFlag');
    }
}
