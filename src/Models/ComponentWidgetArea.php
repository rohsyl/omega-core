<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ComponentWidgetArea extends Pivot
{
    public $timestamps = false;

    protected $fillable = [
        'widget_area_id',
        'component_id',
        'page_id',
        'order',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function page(){
        return $this->belongsTo(Page::class);
    }

    public function component(){
        return $this->belongsTo(Component::class);
    }

    public function widget_area() {
        return $this->belongsTo(WidgetArea::class);
    }
}
