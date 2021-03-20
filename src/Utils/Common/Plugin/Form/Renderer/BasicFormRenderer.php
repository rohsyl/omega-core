<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Form\Renderer;


class BasicFormRenderer extends PluginFormRenderer
{
    public function render()
    {
        $html = '';
        foreach($this->getEntries() as $entry){
            $html .= $entry->getHtml();
        }
        return $html;
    }
}