<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\Checkbox;

use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

class Checkbox extends TypeEntry {

    public function getHtml()
    {
        $param = $this->getParam();
        $uid = $this->getUniqId();
        $v = $this->getValue();
        $checkboxValue = ($v ?? false ) || $param["checked"] ? 'checked="true"' : '';
        $html = '<br><input class="" type="checkbox" name="'.$uid.'" '. $checkboxValue . '" id="'.$uid.'"><br />';

        return $html;
    }

    public function getPostedValue()
    {
        return $this->getBooleanValue($this->getPost($this->getUniqId()));
    }

    public  function getObjectValue() {
        $param = $this->getParam();
        $v = $this->getValue();
        return $this->getBooleanValue($v, $param['checked'] ?? false);
    }

    private function getBooleanValue($value, $default = false) {
        return filter_var($value ?? $default, FILTER_VALIDATE_BOOLEAN);
    }

    public function getDoc(){
        return view('omega::common.plugin.type.checkbox.doc');
    }
}