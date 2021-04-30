<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\Alert;

use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

class Alert extends TypeEntry {

    public function getHtml()
    {
        $uid = $this->getUniqId();
        $param = $this->getParam();
        $html = '<div class="alert alert-'.$param['type'].' alert-'.$uid.'">'.$param['text'].'</div>';
        return $html;
    }

    public function getPostedValue()
    {
        return '';
    }

    public  function getObjectValue() {
        return $this->getParam();
    }

    public function getDoc(){
        return view('omega::common.plugin.type.alert.doc');
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
	}
}
 */


/*
Exemple database content value
{
	"model" : "Omega\\Plugin\\DividedContent\\Model\\DropDownPage"
}
 */