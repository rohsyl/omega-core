<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin\Form;


use rohsyl\OmegaCore\Models\PluginForm;
use rohsyl\OmegaCore\Models\PluginFormEntry;

class PluginFormFactory
{
    private $pluginName;

    private $form;
    private $formComponentable;
    private $formWidgetable;
    private $formTitle;

    private $entries;

    public function __construct($name)
    {
        $this->pluginName = $name;
        $this->form = [];
        $this->entries = [];
    }

    public function form($name, $componentable, $widgetable, $title) {
        $this->form = [
            'name' => $name,
            'componentable' => $componentable,
            'widgetable' => $widgetable,
            'title' => $title
        ];
    }

    public function entry($name, $type, $param, $title, $description, $order, $mandatory) {
        $this->entries[$name] = [

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