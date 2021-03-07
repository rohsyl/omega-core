<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

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

    /**
     * Check if the user has the given permission
     *
     * @param $ability string The name of the permission
     * @param bool $force Force to check in the database
     * @return bool|int
     */
    public function hasRight($ability, $force = false){
        // if force is true, then we check the perm from the database
        if($force) {
            DB::statement('SET @rightId = 0');
            DB::statement('SET @userId = :userId', ['userId' => $this->id]);
            DB::statement('SET @hasRight = 0');
            DB::statement('SELECT id INTO @rightId FROM rights WHERE name = :ability', ['ability' => $ability]);
            DB::statement('SELECT COUNT(1) INTO @hasRight FROM (
                    SELECT 1 FROM userrights WHERE fkUser = @userId AND fkRight = @rightId 
                    UNION
                    SELECT 1 FROM grouprights WHERE fkRight = @rightId AND fkGroup IN (SELECT fkGroup FROM usergroups WHERE fkUser = @userId)) as t');
            $results = DB::select('SELECT @hasRight as hasRight');
            return boolval($results[0]->hasRight);
        }
        // else we check the perm in the session
        $rightMasks = session('perm.masks');
        $userMask = session('perm.umask');
        return $userMask & $rightMasks[$ability] == $rightMasks[$ability];
    }
}