<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
    //

    public function getNiceName(){
        return prettify_text($this->name);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'userrights', 'fkUser', 'fkRight');
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'grouprights', 'fkGroup', 'fkRight');
    }
}
