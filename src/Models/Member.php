<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{


    public function membergroups(){
        return $this->belongsToMany(Membergroup::class, 'membergrouping', 'fkMember', 'fkMemberGroup' );
    }
}
