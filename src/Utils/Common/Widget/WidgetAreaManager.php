<?php


namespace rohsyl\OmegaCore\Utils\Common\Widget;


use rohsyl\OmegaCore\Models\WidgetArea;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;

class WidgetAreaManager
{
    public function getAll() {

        return WidgetArea::query()
            ->where('theme', OmegaTheme::getName())
            ->get();
    }

    public function create($name, $theme) {
        WidgetArea::create([
            'name' => $name,
            'theme' => $theme
        ]);
    }


}