<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\DropDown;

abstract class ADropDownModel{

    private $entry;

    public function __construct($entry) {
        $this->entry = $entry;
    }

    protected function getEntry(){
        return $this->entry;
    }

    public abstract function getKeyValueArray();
}