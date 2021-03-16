<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin\Controllers;


use Illuminate\Routing\Controller;

abstract class OvertPluginController extends Controller
{

    /**
     * Register dependecies of the plugin (js and css)
     * @return array|null
     */
    // TODO : do i need that ?
    public function registerDependencies() {}

    /**
     * Display a plugin's module in the page
     * @param $args array The parameter of the module
     * @param $data array The data of the module
     * @return mixed
     */
    public abstract function display($args, $data);

}