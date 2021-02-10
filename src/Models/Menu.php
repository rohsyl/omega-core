<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //


    public function membergroup(){
        return $this->belongsTo(Membergroup::class, 'fkMemberGroup', 'id');
    }

}
