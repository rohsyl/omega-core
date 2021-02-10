<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class Membergroup extends Model
{
    public function menus(){
        return $this->hasMany(Menu::class, 'fkMemberGroup');
    }


    public function members(){
        return $this->belongsToMany(Member::class, 'membergrouping', 'fkMemberGroup', 'fkMember' );
    }
}
