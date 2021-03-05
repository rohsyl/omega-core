<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberGroup extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'validation_hash',
        'lost_password_hash',
        'is_enabled',
        'validated_at',
    ];

    public function menus(){
        return $this->hasMany(Menu::class);
    }

    public function members(){
        return $this->belongsToMany(Member::class);
    }
}
