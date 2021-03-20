<?php


namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit;


use Livewire\Component as LivewireComponent;
use rohsyl\OmegaCore\Models\Page;
use rohsyl\OmegaCore\Models\PluginForm;
use rohsyl\OmegaCore\Models\Component;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\Type;

class EditPageComponent extends LivewireComponent
{

    /**
     * @var Page
     */
    public $page;

    public function mount() {

    }

    public function render() {
        $componentsForms = $this->renderComponentsForms();
        return view('omega::livewire.admin.content.page.edit.edit', compact('componentsForms'));
    }

    public function renderComponentsForms() {
        $components = [];
        foreach($this->page->components as $component) {
            $plugin = Plugin::getPlugin($component->plugin_form->plugin->name);
            $formRenderer = $plugin->getFormRendererComponent();
            $components[] = [
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
}