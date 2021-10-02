<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WidgetArea extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'theme',
    ];

    public function component_widget_areas(){
        return $this->hasMany(ComponentWidgetArea::class)
            ->orderBy('order');
    }

    public function visible_component_widget_areas(){
        return $this->component_widget_areas()
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }
}
