<?php


namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit;


use Illuminate\Support\Str;
use Livewire\Component as LivewireComponent;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;

class ComponentSettings extends LivewireComponent
{

    public $component;

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

    public function mount() {

    }

    public function render() {
        $this->loadSettings();
        $this->loadSettingsForm();

        return view('omega::livewire.admin.content.page.edit.componentsettings');
    }

    public function loadSettings() {
        $this->compId = $this->component->settings['compId'] ?? '';
        $this->compTitle = $this->component->settings['compTitle'] ?? '';
        $this->compTemplate = $this->component->settings['pluginTemplate'] ?? null;
        $this->isHidden = $this->component->settings['isHidden'] ?? false;
        $this->compWidth = isset($this->component->settings['isWrapped'])
            ? ($this->component->settings['isWrapped'] ? 'wrapped' : 'full-width')
            : 'wrapped';
    }

    public function loadSettingsForm() {
        $pluginName = $this->component->plugin_form->plugin->name;
        $themeName = OmegaTheme::getName();
        $componentsTemplates = OmegaTheme::getRegister()->getAllComponentsViewForPlugin($pluginName);

        $pluginTemplatesWithTitle = [];
        $pluginTemplatesWithTitle[null] = __('Default');
        foreach ($componentsTemplates as $views) {
            foreach ($views as $newView) {
                $newViewName = $newView->getNewViewPath();
                $label = $newView->getLabel();
                if (!isset($label)) {
                    $label = Str::title($themeName) . ' - ' . Str::title($pluginName) . ' - ' . without_ext(without_ext(Str::title($newViewName)));
                }
                $pluginTemplatesWithTitle[theme_encode_components_template($themeName, $newView)] = $label;
            }
        }
        $this->componentTemplates = $pluginTemplatesWithTitle;
        $this->componentWidths = [
            'wrapped' => __('Wrapped'),
            'full-width' => __('Full Width')
        ];

    }

    public function saveSettings() {

        $inputs = $this->validate();
        $param = $this->component->param;
        $settings = $param['settings'] ?? [];
        $settings['compId'] = $inputs['compId'];
        $settings['compTitle'] = $inputs['compTitle'];
        $settings['pluginTemplate'] = $inputs['compTemplate'];
        $settings['isHidden'] = $inputs['isHidden'];
        $settings['isWrapped'] = $inputs['compWidth'] == 'wrapped' ? true : false;
        $param['settings'] = $settings;
        $this->component->param = $param;
        $this->component->save();

        $this->emitUp('settingsEditSaved');
    }

    public function cancelSettings() {
        $this->emitUp('settingsEditCancelled');
    }
}