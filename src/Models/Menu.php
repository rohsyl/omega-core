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

    public function items() {
        return $this->hasMany(MenuItem::class, 'menu_id')
            ->where('parent_id', 0)
            ->orderBy('sort', 'ASC');
    }

    public function scopeEnabled($query) {
        return $query->where('is_enabled', true);
    }

    public function scopeMain($query) {
        return $query->where('is_main', true);
    }
}
