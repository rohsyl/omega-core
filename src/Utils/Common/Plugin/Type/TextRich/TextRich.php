<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextRich;

use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

class TextRich extends TypeEntry {

    public function getHtml()
    {
        $uid = $this->getUniqId();
        $value = $this->getObjectValue();
        $html = '<textarea class="form-control '.$uid.'" name="'.$uid.'">'.$value.'</textarea>
            <script>
                omega.initSummerNote(\'.'.$uid.'\');
            </script>';
        return $html;
    }

    public function getPostedValue()
    {
        return $this->getPost($this->getUniqId());
    }

    public  function getObjectValue()
    {
        $v = $this->getValue();

        return isset($v) ? $v : '';
        // todo : render special content
        //return isset($v) ? Page::RenderSpecialContent($v) : '';
    }

    public function getDoc(){
        return view('omega:common.plugin.type.textrich.doc');
    }
}