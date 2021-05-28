<?php


namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit;


use Livewire\Component as LivewireComponent;
use rohsyl\OmegaCore\Models\ComponentWidgetArea;
use rohsyl\OmegaCore\Models\Menu;
use rohsyl\OmegaCore\Models\Page;
use rohsyl\OmegaCore\Models\PluginForm;
use rohsyl\OmegaCore\Models\Component;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;
use rohsyl\OmegaCore\Utils\Common\Facades\WidgetArea;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\Type;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;

class EditPageComponent extends LivewireComponent
{
    public $readyToLoad = false;

    /**
     * @var Page
     */
    public $page;

    public $tab = 'content';

    protected $queryString = ['tab'];

    public $pages = [];
    public $models = [];
    public $menus = [];

    public $pageParents = [];
    public $pageModels = [];
    public $pageMenus = [];

    public $widgetAreas;

    public function mount() {
        $this->tab = request()->has('tab') ? request()->input('tab') : 'content';
    }

    public function render() {
        $componentsForms = $this->renderComponentsForms();
        $this->loadSettings();
        $this->loadWidetAreas();

        return view('omega::livewire.admin.content.page.edit.edit', compact('componentsForms'));
    }


    public function init() {
        $this->readyToLoad = true;
    }

    public function loadSettings() {
        $this->pageParents =
            [null => __('No parent')] + Page::query()
                ->where('id', '!=', $this->page->id)
                ->select(['title', 'id'])
                ->get()
                ->pluck('title', 'id')
                ->toArray();

        $this->pageModels = [null => __('No model')] + OmegaTheme::getThemeTemplate();

        $this->pageMenus =
            [null => __('No menu')] + Menu::query()
                ->enabled()
                ->select(['name', 'id'])
                ->get()
                ->pluck('name', 'id')
                ->toArray();

    }

    public function loadWidetAreas() {
        $this->widgetAreas = WidgetArea::getAll();
    }

    public function renderComponentsForms() {
        $components = [];
        foreach($this->page->components as $component) {
            $plugin = Plugin::getPlugin($component->plugin_form->plugin->name);
            $formRenderer = $plugin->getFormRendererComponent();
            $components[] = [
                'id' => $component->id,
                'name' => $component->plugin_form->plugin->name,
                'html' => Type::FormRender($component->plugin_form_id, $component->id, $component->page_id, $formRenderer),
            ];
        }
        return $components;
    }

    public $creatablePluginForms;
    public $showAddComponentForm = false;
    public function showAddComponentForm() {
        $this->showAddComponentForm = true;
        $this->creatablePluginForms = PluginForm::query()->where('componentable', true)->get();
    }
    public function hideAddComponentForm() {
        $this->showAddComponentForm = false;
    }
    public function createComponent($plugin_form_id) {

        $pluginForm = PluginForm::find($plugin_form_id);

        $maxOrder = Component::query()->where('page_id', $this->page->id)->max('order');
        $maxId = Component::query()->where('page_id', $this->page->id)->max('id');

        Component::create([
            'plugin_form_id' => $pluginForm->id,
            'page_id' => $this->page->id,
            'name' => $pluginForm->name . $maxId ?? 0,
            'param' => [
                'settings' => [
                    'compId' => $pluginForm->name . $maxId ?? 0
                ],
            ],
            'is_enabled' => true,
            'is_widget' => false,
            'order' => $maxOrder ?? 0,
        ]);

        $this->page->load('components');
        $this->hideAddComponentForm();
    }
    public function deleteComponent($component_id) {
        Component::destroy($component_id);
        $this->page->load('components');
    }

    public function setTab($tab) {
        $this->tab = $tab;
        $this->hideAddWidgetForm();
        $this->hideEditWidgetForm();
    }

    public $widget_plugin_form_id;
    public $widget_name;
    public $widgetarea_id;
    public $creatableWidgetPluginForms;
    public $showAddWidgetForm = false;
    public $showEditWidgetForm = false;
    public $editableWidget;
    public function showAddWidgetForm($widgetAreaId) {
        $this->widgetarea_id = $widgetAreaId;
        $this->showAddWidgetForm = true;
        $this->creatableWidgetPluginForms = PluginForm::query()->where('widgetable', true)->get()->pluck('title', 'id');
    }
    public function hideAddWidgetForm() {
        $this->showAddWidgetForm = false;
        $this->widgetarea_id = null;
        $this->widget_plugin_form_id = null;
        $this->widget_name = null;
    }
    public function createWidget() {
        $this->validate([
            'widget_plugin_form_id' => 'required|exists:plugin_forms,id',
            'widget_name' => 'required|string',
        ]);

        $pluginForm = PluginForm::find($this->widget_plugin_form_id);
        $maxOrder = Component::query()->where('page_id', $this->page->id)->max('order');
        $maxId = Component::query()->where('page_id', $this->page->id)->max('id');

        $component = Component::create([
            'plugin_form_id' => $pluginForm->id,
            'page_id' => $this->page->id,
            'name' => $this->widget_name,
            'param' => [
                'settings' => [
                    'compId' => $pluginForm->name . $maxId ?? 0
                ],
            ],
            'is_enabled' => true,
            'is_widget' => true,
            'order' => $maxOrder ?? 0,
        ]);

        $maxOrder = ComponentWidgetArea::query()->where('page_id', $this->page->id)->max('order');
        ComponentWidgetArea::create([
            'widget_area_id' => $this->widgetarea_id,
            'component_id' => $component->id,
            'page_id' => $this->page->id,
            'order' => $maxOrder+1,
        ]);

        $this->hideAddWidgetForm();
        $this->loadWidetAreas();
    }

    public function showEditWidgetForm($widget_id) {
        $this->editableWidget = Component::find($widget_id);
        $this->showEditWidgetForm = true;
    }
    public function hideEditWidgetForm() {
        $this->showEditWidgetForm = false;
        $this->editableWidget = null;
    }
    public function updateWidget() {

    }
}