<?php

namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\Adapter;

use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

abstract class TypeAdapter
{
    private TypeEntry $typeEntry;

    public function __construct(TypeEntry $typeEntry) {
        $this->typeEntry = $typeEntry;
    }

    public abstract function getHtml();

    public abstract function getRequestValue();

    public function getTypeEntry(): TypeEntry
    {
        return $this->typeEntry;
    }
}