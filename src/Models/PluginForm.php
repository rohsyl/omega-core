<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function plugin_form_entries() {
        return $this->hasMany(PluginFormEntry::class)->orderBy('order');
    }
}
