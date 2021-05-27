<?php


namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit;


use Livewire\Component as LivewireComponent;
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
        $this->widgetAreas = WidgetArea::getAll();
    }

    public function render() {
        $componentsForms = $this->renderComponentsForms();
        $this->loadSettings();

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
    }

    public $creatableWidgetPluginForms;
    public $showAddWidgetForm = false;
    public function showAddWidgetForm($widgetAreaId) {
        $this->showAddWidgetForm = true;
        $this->creatableWidgetPluginForms = PluginForm::query()->where('widgetable', true)->get();
    }
    public function hideAddWidgetForm() {
        $this->showAddWidgetForm = false;
    }
    public function createWidget() {

    }
}