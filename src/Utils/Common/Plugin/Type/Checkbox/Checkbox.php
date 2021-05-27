<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\Checkbox;

use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

class Checkbox extends TypeEntry {

    public function getHtml()
    {
        $param = $this->getParam();
        $uid = $this->getUniqId();
        $v = $this->getValue();
        $checkboxValue = $param["checked"] ? 'checked="true"' : '';
        $html = '<br><input class="" type="checkbox" name="'.$uid.'" '. $checkboxValue . '" id="'.$uid.'">';

        return $html;
    }

    public function getPostedValue()
    {
        return $this->getPost($this->getUniqId());
    }

    public  function getObjectValue() {
        $param = $this->getParam();
        $v = $this->getValue();
        return $param['checked'] ?? false;

    }

    public function getDoc(){
        return view('omega::common.plugin.type.checkbox.doc');
    }
}