<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{

    protected $fillable = [
        'username',
        'email',
        'password',
        'validation_hash',
        'lost_password_hash',
        'is_enabled',
        'validated_at',
    ];


    public function membergroups(){
        return $this->belongsToMany(MemberGroup::class );
    }

    public function getIsValidatedAttribute() {
        return isset($this->validated_at);
    }
}
