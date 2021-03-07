<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

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
}
