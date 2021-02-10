<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class PageSecurity extends Model
{
    //
    public $timestamps = false;

    public function pages(){
        return $this->hasMany(Page::class, 'fkPage', 'id');
    }

    public function type(){
        return $this->belongsTo(PageSecurityType::class, 'fkType', 'id');
    }
}
