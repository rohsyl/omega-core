<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PluginFormEntryValue extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'plugin_form_entry_id',
        'component_id',
        'locale',
        'value',
    ];

    public function plugin_form_entry() {
        return $this->belongsTo(PluginFormEntry::class);
    }

    public function component() {
        $this->belongsTo(Component::class);
    }
}
