<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Component extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'plugin_form_id',
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

    public function plugin_form(){
        return $this->belongsTo(PluginForm::class, 'plugin_form_id');
    }

    public function page(){
        return $this->belongsTo(Page::class);
    }

    public function getSettingsAttribute() {
        return $this->param['settings'] ?? [];
    }
}
