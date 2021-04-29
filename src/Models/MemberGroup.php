<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use rohsyl\LaravelAcl\Traits\GroupAcl;

class MemberGroup extends Model
{
    use SoftDeletes, GroupAcl;

    protected $fillable = [
        'name',
        'acl'
    ];

    public function menus(){
        return $this->hasMany(Menu::class);
    }

    public function members(){
        return $this->belongsToMany(Member::class);
    }
}
