<?php
namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class PageSecurity extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'page_id',
        'type',
        'param',
    ];

    protected $casts = [
        'param' => 'array',
    ];

    public function pages(){
        return $this->hasMany(Page::class);
    }
}
