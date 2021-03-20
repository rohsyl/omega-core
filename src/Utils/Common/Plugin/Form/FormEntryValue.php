<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin\Form;


class FormEntryValue
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getId(){
        return $this->value['id'];
    }

    public function getValue(){
        return $this->value['value'];
    }
}