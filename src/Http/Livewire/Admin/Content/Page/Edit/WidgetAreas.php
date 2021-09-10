<?php


namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit;

use Livewire\Component as LivewireComponent;
use rohsyl\OmegaCore\Models\Component;
use rohsyl\OmegaCore\Models\ComponentWidgetArea;
use rohsyl\OmegaCore\Models\PluginForm;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\Type;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;

class WidgetAreas extends LivewireComponent
{
    protected $listeners = ['updatedWidget'];

    public $pageId;
    public $widgetAreas;

    public function render() {
        $this->loadWidetAreas();
        return view('omega::livewire.admin.content.page.edit.widgetareas');
    }

    public function loadWidetAreas() {
        $this->widgetAreas = OmegaTheme::widgetArea()->getAll();
    }


    public $widget_plugin_form_id;
    public $widget_name;
    public $widgetarea_id;
    public $creatableWidgetPluginForms;
    public $showAddWidgetForm = false;
    public function showAddWidgetForm($widgetAreaId) {
        $this->hideEditWidgetForm();
        $this->widgetarea_id = $widgetAreaId;
        $this->showAddWidgetForm = true;
        $this->creatableWidgetPluginForms = PluginForm::query()
            ->where('widgetable', true)
            ->get()
            ->pluck('title', 'id')
            ->toArray();
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
        $maxOrder = Component::query()->where('page_id', $this->pageId)->max('order');
        $maxId = Component::query()->where('page_id', $this->pageId)->max('id');

        $component = Component::create([
            'plugin_form_id' => $pluginForm->id,
            'page_id' => $this->pageId,
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

        $maxOrder = ComponentWidgetArea::query()->where('page_id', $this->pageId)->max('order');
        ComponentWidgetArea::create([
            'widget_area_id' => $this->widgetarea_id,
            'component_id' => $component->id,
            'page_id' => $this->pageId,
            'order' => $maxOrder+1,
        ]);

        $this->hideAddWidgetForm();
        $this->loadWidetAreas();
    }



    public $showEditWidgetForm = false;
    public $editableWidget;
    public $editableWidgetForm;
    public function showEditWidgetForm($widget_id) {
        $this->editableWidget = Component::find($widget_id);
        $this->showEditWidgetForm = true;
        $this->hideAddWidgetForm();

        $plugin = Plugin::getPlugin($this->editableWidget->plugin_form->plugin->name);
        $formRenderer = $plugin->getFormRendererComponent();
        $this->editableWidgetForm = [
            'settings' => $this->editableWidget->param['settings'] ?? [],
            'html' => Type::FormRender($this->editableWidget->plugin_form_id, $this->editableWidget->id, $this->pageId, $formRenderer),
        ];
    }
    public function hideEditWidgetForm() {
        $this->showEditWidgetForm = false;
        $this->editableWidget = null;
        $this->editableWidgetForm = null;
    }
    public function updatedWidget() {
        $this->hideEditWidgetForm();
    }
}