<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin\Controllers;


use Illuminate\Routing\Controller;

abstract class OvertPluginController extends Controller
{

    /**
     * @var array Force the view to this one.
     */
    private $forceView = [];

    /**
     * Register dependecies of the plugin (js and css)
     * @return array|null
     */
    public function registerDependencies() {}

    /**
     * Display a plugin's module in the page
     * @param $args array The parameter of the module
     * @param $data array The data of the module
     * @return mixed
     */
    public abstract function display($args, $data);

    protected function view($name, $data = []) {

        if(isset($this->forceView[$name])){
            $name = $this->forceView[$name];
        }
        else if(isset($this->forceView['default'])) {
            $name = $this->forceView['default'];
        }

        return view($name, $data);
    }


    /**
     * Force the view
     * @param $viewPath string The fill path to the view (blade)
     */
	public function forceView($viewName, $viewPath){
        $this->forceView[$viewName] = $viewPath;
    }
}