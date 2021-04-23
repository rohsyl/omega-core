<?php
namespace rohsyl\OmegaCore\Utils\Overt\Page;

use Illuminate\Contracts\Support\Renderable;

class PageRenderable implements Renderable
{
    private $content;

    public function __construct($content){
        $this->content = $content;
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render() {
        return $this->content;
    }
}