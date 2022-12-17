<?php

namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type;

use Illuminate\Support\HtmlString;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\Adapter\InputTypeAdapter;

class TypeManager
{
    public function getInput(string $className, ?array $args = [])
    {

        $instance = $this->getInstance($className, $args);

        $adapter = new InputTypeAdapter($instance);

        return new HtmlString($adapter->getHtml());
    }

    public function getRequest(string $className, ?array $args = [])
    {
        $instance = $this->getInstance($className, $args);

        $adapter = new InputTypeAdapter($instance);

        return $adapter->getRequestValue();
    }

    private function getInstance(string $className, ?array $args = []) : TypeEntry
    {
        $reflectionInstance = new \ReflectionClass($className);
        return $reflectionInstance->newInstanceArgs($args ?? []);
    }
}