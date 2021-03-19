<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\RadioButtons;

use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

class RadioButtons extends TypeEntry {

    public function getHtml()
    {
        $param = $this->getParam();
        $uid = $this->getUniqId();
        $v = $this->getValue();
        $selectedValue = isset($v) ? $v : $param['default'];
        $options = $param['options'];

        $i = 0;
        $html = '<div class="form-group">';
        foreach($options as $value => $title) {
            $checked = $selectedValue == $value ? 'checked' : '';
            $html .= '<label for="'.$uid.'-'.$i.'" class="radio-inline">
                          <input name="'.$uid.'" id="'.$uid.'-'.$i.'" value="'.$value.'" '.$checked.' type="radio"> '.$title.'
                      </label>';
            $i++;
        }
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
        $selectedValue = isset($v) ? $v : $param['default'];
        $ret = array(
            'title' => $param['options'][$selectedValue],
            'value' => $selectedValue
        );
        return $ret;
    }

    public function getDoc(){
        return view('omega:common.plugin.type.radiobuttons.doc');
    }
}