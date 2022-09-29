<?php

namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit\Modal;

use rohsyl\OmegaCore\Extensions\Livewire\Modal\ModalComponent;
use rohsyl\OmegaCore\Models\Component;
use rohsyl\OmegaCore\Models\Page;
use rohsyl\OmegaCore\Models\PluginForm;

class AddComponentModal extends ModalComponent
{
    public $page;

    public $creatablePluginForms;

    public function mount(Page $page) {
        $this->page = $page;
        $this->init();
    }

    private function init() {
        $this->creatablePluginForms = PluginForm::query()->where('componentable', true)->get();
    }

    public function render() {
        return view('omega::livewire.admin.content.page.edit.modal.add-component-modal');
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

        $this->emit('page:reload-components');
        $this->closeModal();
    }
}