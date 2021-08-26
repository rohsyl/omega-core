<?php


namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit;


use Illuminate\Support\Str;
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
use rohsyl\OmegaCore\Utils\Overt\Theme\Component\Template;

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

    protected $listeners = [
        'settingsEditSaved',
        'settingsEditCancelled',
    ];

    public function mount() {
        $this->tab = request()->has('tab') ? request()->input('tab') : 'content';
    }

    public function render() {
        $this->dispatchBrowserEvent('omega-form-rendered');
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
                'settings' => $component->param['settings'] ?? [],
                'order' => $component->order,
                'html' => Type::FormRender($component->plugin_form_id, $component->id, $component->page_id, $formRenderer),
            ];
        }
        return $components;
    }

    public $creatablePluginForms;
    public $showAddComponentForm = false;
    public function showAddComponentForm() {
        $this->hideSidebarForms();
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

    public $settingsEditableComponent;
    public $showSettingsComponentForm = false;
    public function showSettingsComponentForm($component_id) {
        $this->hideSidebarForms();
        $this->settingsEditableComponent = Component::find($component_id);
        $this->showSettingsComponentForm = true;
    }
    public function settingsEditSaved() {
        $this->hideSettingsComponentForm();
    }
    public function settingsEditCancelled() {
        $this->hideSettingsComponentForm();
    }
    public function hideSettingsComponentForm() {
        $this->settingsEditableComponent = null;
        $this->showSettingsComponentForm = false;
    }

    public function hideSidebarForms() {
        $this->hideAddComponentForm();
        $this->hideSettingsComponentForm();
    }

    public function setTab($tab) {
        $this->tab = $tab;
        $this->hideAddWidgetForm();
        $this->hideEditWidgetForm();
    }


}