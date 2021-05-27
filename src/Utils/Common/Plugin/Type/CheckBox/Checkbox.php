<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\Checkbox;

use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

class Checkbox extends TypeEntry {

    public function getHtml()
    {
        $param = $this->getParam();
        $uid = $this->getUniqId();
        $v = $this->getValue();
        $checked = $param["checked"] ?? false;

        $html = '<div class="form-group">';
        $html .= '<input class="form-check-input" type="checkbox" name="'.$uid.'" checked="'.$checked.'" id="'.$uid.'">';
        $html .= '<label for="'.$uid.'" class="form-check-label">
                      '.$v.'
                  </label>';
        $html .= '</div>';
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