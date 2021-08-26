<?php


namespace rohsyl\OmegaCore\Utils\Common\Widget;


use rohsyl\OmegaCore\Models\WidgetArea;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;
use rohsyl\OmegaCore\Utils\Overt\Theme\ThemeManager;

class WidgetAreaManager
{
    private $themeManager;

    public function __construct(ThemeManager $themeManager)
    {
        $this->themeManager = $themeManager;
    }

    public function getAll() {

        return WidgetArea::query()
            ->where('theme', $this->themeManager->getName())
            ->get();
    }

    public function create($name) {
        WidgetArea::create([
            'name' => $name,
            'theme' => $this->themeManager->getName()
        ]);
    }


}