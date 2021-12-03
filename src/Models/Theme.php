<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Theme extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'title',
        'description',
        'website',
        'param',
    ];

    protected $casts = [
        'param' => 'array'
    ];

    public function widget_areas() {
        return $this->hasMany(WidgetArea::class, 'theme', 'name');
    }

    protected static function booted()
    {
        static::deleting(function ($theme) {
            foreach($theme->widget_areas as $widget_area) {
                $widget_area->delete();
            }
        });
    }

}
