<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Form\Renderer;

use Illuminate\Contracts\Support\Renderable;
use rohsyl\OmegaCore\Utils\Common\Plugin\Form\FormEntry;

abstract class PluginFormRenderer implements Renderable
{

    /**
     * @var FormEntry[]
     */
    private $entries = [];

    /**
     * @param $entries FormEntry[]
     */
    public function setEntries($entries) {
        $this->entries = $entries;
    }

    /**
     * @param $name
     * @return FormEntry|null
     */
    public function getEntry($name) {
        if(!isset($this->entries[$name]))
            return null;

        return $this->entries[$name];
    }

    /**
     * @return FormEntry[]
     */
    public function getEntries() {
        return $this->entries;
    }

    abstract public function render();
}