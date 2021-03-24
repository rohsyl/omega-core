<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'parent_id',
        'menu_id',
        'label',
        'link',
        'sort',
        'class',
        'depth',
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')
            ->orderBy('sort', 'ASC');
    }
}
