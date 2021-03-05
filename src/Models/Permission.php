<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
    ];

    public function getNiceName(){
        return prettify_text($this->name);
    }

    public function groups(){
        return $this->belongsToMany(Group::class);
    }
}
