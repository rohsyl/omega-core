<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberGroup extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function menus(){
        return $this->hasMany(Menu::class);
    }

    public function members(){
        return $this->belongsToMany(Member::class);
    }
}
