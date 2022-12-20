<?php

namespace rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page\PageBuilder;

use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Models\PluginForm;

class BlockController extends Controller
{
    public function __invoke() {

        $blocks = PluginForm::query()
            ->where('componentable', true)
            ->get();



        return response()->json([
            'data' => [
                'blocks' => $this->toBlocks($blocks),
            ]
        ]);
    }

    private function toBlocks($blocks) {

        $b = [
            'id' => 'id',
            'config' => [

            ]
        ];

        return $blocks;
    }
}