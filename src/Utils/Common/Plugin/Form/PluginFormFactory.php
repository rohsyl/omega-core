<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin\Form;


use Illuminate\Support\Arr;
use rohsyl\OmegaCore\Models\PluginForm;
use rohsyl\OmegaCore\Models\PluginFormEntry;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;

class PluginFormFactory
{
    private $pluginName;

    private $form;

    private $entries;

    public function __construct($name)
    {
        $this->pluginName = $name;
        $this->form = [];
        $this->entries = [];
    }

    public function form($title, $componentable = true, $widgetable = false) {
        $this->form = [
            'plugin_id' => Plugin::getModel($this->pluginName, true)->id,
            'name' => $this->pluginName,
            'componentable' => $componentable,
            'widgetable' => $widgetable,
            'title' => $title
        ];
    }

    public function entry($name, $type, $param = null, $title = '', $description = '', $order = 0, $mandatory = false) {
        $this->entries[$name] = [
            'name' => $name,
            'type' => $type,
            'param' => $param,
            'title' => $title,
            'description' => $description,
            'order' => $order,
            'mandatory' => $mandatory
        ];
    }

    /**
     * This method will create or update an existing PluginForm
     */
    public function make() {
        // Find the plugin form or instance a new one if already exists
        $pluginForm = PluginForm::firstOrNew(Arr::only($this->form, ['plugin_id', 'name']));
        $pluginForm->fill(Arr::except($this->form, ['plugin_id', 'name']));
        $pluginForm->save();
        $createdEntries = [];
        foreach($this->entries as $entry) {
            $entry = array_merge(['plugin_form_id' => $pluginForm->id], $entry);
            // Find the plugin form entry or instance a new one if already exists
            $pluginFormEntry = PluginFormEntry::firstOrNew(Arr::only($entry, ['plugin_form_id', 'name']));
            $pluginFormEntry->fill(Arr::except($entry, ['plugin_form_id', 'name']));
            $pluginFormEntry->save();
            $createdEntries[] = $pluginFormEntry->name;
        }
        PluginFormEntry::query()
            ->where('plugin_form_id', $pluginForm->id)
            ->whereNotIn('name', $createdEntries)
            ->get()->each(function($entry) {
                $entry->delete();
            });

    }
}