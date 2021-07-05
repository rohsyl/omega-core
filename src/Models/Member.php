<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Notifications\Notifiable;
use rohsyl\OmegaCore\Modules\Member\Auth\MemberAuthenticatable as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'avatar',
        'validation_hash',
        'lost_password_hash',
        'is_enabled',
        'acl',
        'validated_at',
    ];

    public function membergroups(){
        return $this->belongsToMany(MemberGroup::class );
    }

    public function getIsValidatedAttribute() {
        return isset($this->validated_at);
    }

    public function getUsernameAndEmailAttribute() {
        return $this->username . ' - ' . $this->email;
    }
}
