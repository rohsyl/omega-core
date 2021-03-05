<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'flag_id',
        'slug',
        'name',
        'is_enabled',
    ];

    public function flag(){
        return $this->belongsTo(Media::class, 'flag_id');
    }
}
