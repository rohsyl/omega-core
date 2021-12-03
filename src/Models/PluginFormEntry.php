<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class PluginFormEntry extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'plugin_form_id',
        'name',
        'type',
        'param',
        'title',
        'heading',
        'description',
        'mandatory',
        'order',
    ];

    protected $casts = [
        'param' => 'array',
    ];

    public function plugin_form_entry_values() {
        return $this->hasMany(PluginFormEntryValue::class);
    }


    protected static function booted()
    {
        static::deleting(function ($plugin_form_entry) {
            $plugin_form_entry->plugin_form_entry_values()->delete();
        });
    }
}
