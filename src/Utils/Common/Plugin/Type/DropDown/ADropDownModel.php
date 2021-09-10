<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\DropDown;

use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

abstract class ADropDownModel{

    /**
     * @return TypeEntry
     */
    private $entry;

    public function __construct($entry) {
        $this->entry = $entry;
    }

    /**
     * @return TypeEntry
     */
    protected function getEntry(){
        return $this->entry;
    }

    public abstract function getKeyValueArray();
}