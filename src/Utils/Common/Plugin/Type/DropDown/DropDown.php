<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\DropDown;

use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

class DropDown extends TypeEntry {

    public function getHtml()
    {
        $param = $this->getParam();
        $uid = $this->getUniqId();
        $isMultiple = isset($param['multiple']) && $param['multiple'];
        $v = $isMultiple ? json_decode($this->getValue(), true) : $this->getValue();

        $selectedValue = isset($v) ? $v : $param['default'];
        $options = $this->getOptions();
        $html = '<select name="'.$uid.($isMultiple ? '[]' : '').'" '.($isMultiple ? 'multiple' : '').' class="form-control">';
        foreach($options as $value => $title) {
            $checked = $this->isSelected($selectedValue, $value) ? 'selected' : '';
            $html .= '<option '.$checked.' value="'.$value.'">
                              '.$title.'
                          </option>';
        }
        $html .= '</select>';
        return $html;
    }

    private function isModel()
    {
        $param = $this->getParam();
        return isset($param['model']) && $param['model'];
    }

    private function getOptions()
    {
        if($this->isModel()) {
            $param = $this->getParam();
            $className = $param['model'];
            $model = new $className($this);
            return $model->getKeyValueArray();
        }
        else {
            return $param['options'] ?? [];
        }
    }

    private function isMultiple()
    {
        $param = $this->getParam();
        return isset($param['multiple']) && $param['multiple'];
    }

    private function isSelected($selectedValue, $value)
    {
        if($this->isMultiple()) {
            return is_array($selectedValue) && in_array($value, $selectedValue);
        }
        else {
            return $selectedValue == $value;
        }
    }

    public function getPostedValue()
    {
        return $this->getPost($this->getUniqId());
    }

    public  function getObjectValue()
    {
        $param = $this->getParam();
        $v = $this->getValue();

        $options = $this->getOptions();

        if($this->isMultiple()) {
            $selectedValues = json_decode($v, true) ?? [];

            $ret = [];
            foreach($selectedValues as $selectedValue) {
                $ret[] = [
                    'title' => isset($options[$selectedValue]) ? $options[$selectedValue] : '',
                    'value' => $selectedValue
                ];
            }
            return $ret;
        }
        else {
            $default = null;
            if(!isset($param['model'])){
                $default = $param['default'];
            }
            $selectedValue = isset($v) ? $v : $default;
            $ret = [
                'title' => isset($options[$selectedValue]) ? $options[$selectedValue] : '',
                'value' => $selectedValue
            ];
            return $ret;
        }

    }

    public function getDoc(){
        return view('omega::common.plugin.type.dropdown.doc');
    }
}

/*

Exemple hard coded values
{
	"default": 3,
	"options": {
		"3": "25%",
		"4": "33%",
		"5": "42%",
		"6": "50%",
		"8": "66%",
		"9": "75%"
	},
    "multiple": false
}
 */


/*
Exemple database content value
{
	"model" : "Omega\\Plugin\\DividedContent\\Model\\DropDownPage",
    "multiple": false
}
 */