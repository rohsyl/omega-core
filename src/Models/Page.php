<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function owner(){
        return $this->belongsTo(User::class, 'fkUser', 'id');
    }

    public function parent(){
        return $this->belongsTo(Page::class, 'fkPageParent', 'id');
    }

    public function children(){
        return $this->hasMany(Page::class, 'fkPageParent', 'id');
    }

    public function modules(){
        return $this->hasMany(Module::class, 'fkPage', 'id');
    }

    public function modulesonly(){
        return $this->modules()->where('isComponent', 0);
    }

    public function components(){
        return $this->modules()->where('isComponent', 1);
    }

    public function security(){
        return $this->hasOne(PageSecurity::class, 'fkPage', 'id');
    }
}
