<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
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
}
