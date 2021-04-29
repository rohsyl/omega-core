<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use rohsyl\LaravelAcl\Traits\UserAcl;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, UserAcl;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'fullname',
        'is_disabled',
        'avatar_id',
        'acl'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groups(){
        return $this->belongsToMany(Group::class);
    }

    public function getAvatar(){
        if(isset($this->avatar_id)){
            return asset(Media::Get($this->avatar_id)->path);
        }
        return null;
    }

    public function displayName(){
        return isset($this->fullname) ? $this->fullname : $this->email;
    }

}