<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use rohsyl\LaravelAcl\Traits\GroupAcl;

class Group extends Model
{
    use SoftDeletes, GroupAcl;

    protected $fillable = [
        'name',
        'description',
        'is_enabled',
        'is_system',
        'acl'
    ];
    //
    public function getNiceName(){
        return prettify_text($this->name);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

}
