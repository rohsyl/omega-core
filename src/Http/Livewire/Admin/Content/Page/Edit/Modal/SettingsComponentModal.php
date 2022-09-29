<?php

namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit\Modal;

use Illuminate\Support\Str;
use rohsyl\OmegaCore\Extensions\Livewire\Modal\ModalComponent;
use rohsyl\OmegaCore\Models\Component;
use rohsyl\OmegaCore\Models\Page;
use rohsyl\OmegaCore\Models\PluginForm;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;

class SettingsComponentModal extends ModalComponent
{
    public $componentItem;

    public $compId;
    public $compTitle;
    public $compTemplate;
    public $isHidden;
    public $compWidth;

    public $componentTemplates;
    public $componentWidths;


    protected $rules = [
        'compId' => 'required|string',
        'compTitle' => 'nullable|string',
        'compTemplate' => 'nullable|string',
        'isHidden' => 'nullable|boolean',
        'compWidth' => 'required|string',
    ];

    public function mount(Component $componentItem) {
        $this->componentItem = $componentItem;
        $this->init();
    }

    private function init() {
        $this->loadSettings();
        $this->loadSettingsForm();

    }

    public function loadSettings() {
        $this->compId = $this->componentItem->settings['compId'] ?? '';
        $this->compTitle = $this->componentItem->settings['compTitle'] ?? '';
        $this->compTemplate = $this->componentItem->settings['pluginTemplate'] ?? null;
        $this->isHidden = $this->componentItem->settings['isHidden'] ?? false;
        $this->compWidth = isset($this->componentItem->settings['isWrapped'])
            ? ($this->componentItem->settings['isWrapped'] ? 'wrapped' : 'full-width')
            : 'wrapped';
    }


    public function loadSettingsForm() {
        $pluginName = $this->componentItem->plugin_form->plugin->name;
        $themeName = OmegaTheme::getName();
        $componentsTemplates = OmegaTheme::getRegister()->getAllComponentsViewForPlugin($pluginName);

        $pluginTemplatesWithTitle = [];
        $pluginTemplatesWithTitle[null] = __('Default');
        foreach ($componentsTemplates as $views) {
            foreach ($views as $newView) {
                $newViewName = $newView->getNewView();
                $label = $newView->getLabel();
                if (!isset($label)) {
                    $label = Str::title($themeName) . ' - ' . Str::title($pluginName) . ' - ' . without_ext(without_ext(Str::title($newViewName)));
                }
                $pluginTemplatesWithTitle[theme_encode_components_template($newView)] = $label;
            }
        }
        $this->componentTemplates = $pluginTemplatesWithTitle;
        $this->componentWidths = [
            'wrapped' => __('Wrapped'),
            'full-width' => __('Full Width')
        ];

    }

    public function render() {
        return view('omega::livewire.admin.content.page.edit.modal.settings-component-modal');
    }


    public function saveSettings() {

        $inputs = $this->validate();
        $param = $this->componentItem->param;
        $settings = $param['settings'] ?? [];
        $settings['compId'] = $inputs['compId'];
        $settings['compTitle'] = $inputs['compTitle'];
        $settings['pluginTemplate'] = $inputs['compTemplate'];
        $settings['isHidden'] = $inputs['isHidden'];
        $settings['isWrapped'] = $inputs['compWidth'] == 'wrapped' ? true : false;
        $param['settings'] = $settings;
        $this->componentItem->param = $param;
        $this->componentItem->save();

        $this->emit('page:reload-components');
        $this->closeModal();
    }

}