<?php


namespace rohsyl\OmegaCore\Utils\Common\Widget;


use rohsyl\OmegaCore\Models\Component;
use rohsyl\OmegaCore\Models\ComponentWidgetArea;
use rohsyl\OmegaCore\Models\WidgetArea;
use rohsyl\OmegaCore\Utils\Common\Facades\OmegaUtils;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\Type;
use rohsyl\OmegaCore\Utils\Overt\Facades\Entity;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;
use rohsyl\OmegaCore\Utils\Overt\Theme\Component\ComponentView;
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
            ->with([
                'component_widget_areas',
                'component_widget_areas.component',
                'component_widget_areas.component.plugin_form',
            ])
            ->where('theme', $this->themeManager->getName())
            ->get();
    }

    public function create($name, $theme = null) {
        WidgetArea::create([
            'name' => $name,
            'theme' => $theme ?? $this->themeManager->getName()
        ]);
    }

    public function get($name, $theme = null) {
        $theme = $theme ?? $this->themeManager->getName();
        return WidgetArea::query()
            ->where('name', $name)
            ->where('theme', $theme)
            ->first();
    }

    public function exists($name, $theme = null) {
        $theme = $theme ?? $this->themeManager->getName();
        return WidgetArea::query()
            ->where('name', $name)
            ->where('theme', $theme)
            ->exists();
    }

    /**
     * Display the content of a modulearea
     * @see Page
     * @param $page Page The Page
     * @param $name string The name of the modulearea
     * @param $theme string The name of the theme
     */
    public function display($name)
    {
        $page = Entity::Page();
        $theme = $this->themeManager->getName();

        $html = __('This widgetarea does not exists...');
        if($this->exists($name, $theme)){

            $widgetArea = $this->get($name, $theme);

            $html = '';
            foreach($widgetArea->visible_component_widget_areas as $position)
            {
                if(!isset($position->page_id) || $position->page_id == $page->id)
                {
                    if(!om_config('om_enable_front_langauge') || $position->lang == null || $position->lang == $page->lang)
                    {
                        $plugin = Plugin::getPlugin($position->component->plugin_form->plugin->name);
                        $controllerClass = $plugin->overtController();
                        $instance = app()->make($controllerClass);

                        OmegaUtils::addDependencies($instance->registerDependencies());

                        $data = Type::GetValues($position->component->plugin_form->id, $position->component->id, $page->id);
                        $args = $position->component->param;
                        $args['placement'] = 'modulearea';


                        $defaultComponentView = new ComponentView(
                            $position->component->plugin_form->name, 'default', '*', 'theme::template.' . $position->component->plugin_form->name . '.widget', 'Widget default'
                        );

                        if(view()->exists($defaultComponentView->getNewView())) {
                            $instance->forceView($defaultComponentView->getViewName(), $defaultComponentView->getNewView());
                        }

                        $content = $instance->display($args, $data);

                        $html .= view()->first(['theme::template.widget', 'omega::overt.widget'])->with([
                            'content' => $content,
                            'plugin' => $plugin,
                        ])->render();
                    }
                }
            }
        }
        return $html;
    }
}