<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page\WidgetArea;

use Illuminate\Http\Request;
use rohsyl\OmegaCore\Models\Component;
use rohsyl\OmegaCore\Models\Page;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\Type;

class WidgetController
{

    public function update(Request $request, Page $page, Component $component) {

        Type::FormSave($component->plugin_form_id, $component->id, $page->id);

        return response()->json([
            'success' => true,
        ]);
    }
}