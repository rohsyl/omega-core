<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function plugin(){
        return $this->belongsTo(Plugin::class, 'fkPlugin', 'id');
    }

    public function page(){
        return $this->belongsTo(Page::class, 'fkPage', 'id');
    }

    public function positions(){
        return $this->hasMany(Position::class, 'fkModule', 'id');
    }
}
