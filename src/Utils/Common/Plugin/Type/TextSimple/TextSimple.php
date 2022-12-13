<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 05.08.2017
 * Time: 19:12
 */
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextSimple;

use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

class TextSimple extends TypeEntry {

    public function getHtml()
    {
        $uid = $this->getUniqId();
        $value = $this->getObjectValue();
        return '<input type="text" id="'.$uid.'" name="'.$uid.'" value="'.$value.'" class="form-control" />';
    }

    public function getPostedValue()
    {
        return $this->getPost($this->getUniqId());
    }

    public  function getObjectValue() {
        $v = $this->getValue();
        return isset($v) ? $v : '';
    }

    public function getDoc(){
        return view('omega::common.plugin.type.textsimple.doc');
    }

    /*public function getGTypeDefintion() {
        return <<<'JS'
            
        JS;

    }*/
}