<?php


namespace rohsyl\OmegaCore\Utils\Common\Widget;


use rohsyl\OmegaCore\Models\WidgetArea;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;

class WidgetAreaManager
{
    private $themeName;

    public function __construct()
    {
        $this->themeName = OmegaTheme::getName();
    }

    public function getAll() {

        return WidgetArea::query()
            ->where('theme', $this->themeName)
            ->get();
    }

    public function create($name) {
        WidgetArea::create([
            'name' => $name,
            'theme' => $this->themeName
        ]);
    }


}