<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\HtmlEditor;


use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

class HtmlEditor extends TypeEntry
{
    public function getPostedValue() {
        return $this->getPost($this->getUniqId());
    }

    public function getDoc() {
        return view('omega::common.plugin.type.htmleditor.doc');
    }

    public function getObjectValue() {
        return $this->getValue();
    }

    public function getHtml() {
        return view('omega::common.plugin.type.htmleditor.form', [
            'uid' => $this->getUniqId(),
            'value' => $this->getObjectValue()
        ]);
    }
}