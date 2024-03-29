<?php
namespace rohsyl\OmegaCore\Utils\Overt\Theme\Installer;

use Closure;

class Installer
{
    private $name;
    private $data;
    private $post_install;

    public static function For($name){
        return new Installer($name);
    }

    public function __construct($name) {
        $this->name = $name;
    }

    public function set($data){
        $this->data = $data;
        return $this;
    }

    public function postInstall(Closure $method){
        $this->post_install = $method;
        return $this;
    }

    public function getName(){
        return $this->name;
    }

    public function getData(){
        return $this->data;
    }

    public function getPostInstall(){
        return $this->post_install;
    }
}