<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public function getNiceName(){
        return prettify_text($this->name);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'usergroups', 'fkGroup', 'fkUser' );
    }

    public function rights(){
        return $this->belongsToMany(Right::class, 'grouprights', 'fkGroup', 'fkRight');
    }

}
