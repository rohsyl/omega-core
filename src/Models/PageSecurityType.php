<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class PageSecurityType extends Model
{
    //
    public $timestamps = false;

    public function securities(){
        return $this->hasMany(PageSecurity::class, 'fkType', 'id');
    }
}
