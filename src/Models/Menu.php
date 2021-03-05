<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'member_group_id',
        'name',
        'description',
        'structure',
        'is_enabled',
        'is_main',
    ];

    public function member_group(){
        return $this->belongsTo(MemberGroup::class);
    }

}
