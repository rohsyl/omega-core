<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Component extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'plugin_id',
        'page_id',
        'name',
        'param',
        'is_enabled',
        'is_widget',
        'order',
    ];

    protected $casts = [
        'param' => 'array',
    ];

    public function plugin(){
        return $this->belongsTo(Plugin::class);
    }

    public function page(){
        return $this->belongsTo(Page::class);
    }
}
