<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class PluginForm extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'plugin_id',
        'name',
        'title',
        'widgetable',
        'componentable',
    ];

    public function plugin() {
        return $this->belongsTo(Plugin::class);
    }

    public function plugin_form_entries() {
        return $this->hasMany(PluginFormEntry::class)->orderBy('order');
    }

    public function components() {
        return $this->hasMany(Component::class);
    }

    protected static function booted()
    {
        static::deleting(function ($plugin_form) {
            foreach($plugin_form->plugin_form_entries as $entry) {
                $entry->delete();
            }
            foreach($plugin_form->components as $component) {
                $component->delete();
            }
        });
    }
}
