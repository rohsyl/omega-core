<?php

namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\Adapter;

class InputTypeAdapter extends TypeAdapter
{

    public function getHtml()
    {
        return $this->getTypeEntry()->getHtml();
    }

    public function getRequestValue()
    {
        return $this->getTypeEntry()->getPostedValue();
    }
}