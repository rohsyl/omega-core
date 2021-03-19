<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin\Form;


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

    public function make() {

        $pluginForm = PluginForm::create($this->form);

        foreach($this->entries as $entry) {
            PluginFormEntry::create(array_merge(
                [
                    'plugin_form_id' => $pluginForm->id
                ],
                $entry
            ));
        }
    }
}