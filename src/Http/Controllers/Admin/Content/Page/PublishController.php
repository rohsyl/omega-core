<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page;


use rohsyl\OmegaCore\Models\Page;

class PublishController
{
    public function publish(Page $page) {

        $page->published_at = now();
        $page->save();

        return redirect()->back();
    }

    public function unpublish(Page $page) {
        $page->published_at = null;
        $page->save();

        return redirect()->back();
    }
}