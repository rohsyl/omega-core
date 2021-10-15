<?php

namespace rohsyl\OmegaCore\Extensions\Filters\Admin\Page;

use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\OmegaCore\Models\Page;

class PageAdvancedQueryFilter extends AdvancedQueryFilter
{

    public function __construct()
    {
        parent::__construct();
        $this->pagination = DEFAULT_PAGINATION;
    }

    public function query()
    {
        return Page::query();
    }

    public function finalize($query)
    {
        return $query->with(['author']);
    }

    public function plain($query, $text) {
        return $query->whereLike([
            'slug',
            'title',
            'subtitle',
            'keywords',
        ], $text);
    }

}