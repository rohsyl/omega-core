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

        $viewName = $this->getViewFileNameFromFullViewName($name);

        if(isset($this->forceView[$viewName])){
            $name = $this->forceView[$viewName];
        }
        else if(isset($this->forceView['default'])) {
            if($viewName === 'display') {
                $name = $this->forceView['default'];
            }
            else {
                $viewSuffix = $this->getViewSuffixFromViewName($viewName);
                $defaultSuffixedView = $this->forceView['default'] . '-' . $viewSuffix;
                if(view()->exists($defaultSuffixedView))  {
                    $name = $defaultSuffixedView;
                }
            }
        }

        if(!view()->exists($name)) return view('omega::overt.components.template.notfound', compact('name'));

        return view($name, $data);
    }

    private function getViewFileNameFromFullViewName($name) {
        $strrpos = strrpos($name, '.');
        if($strrpos === false) return $name;
        return substr($name,  $strrpos + 1);
    }

    private function getViewSuffixFromViewName($name) {
        $strrpos = strrpos($name, '-');
        if($strrpos === false) return $name;
        return substr($name,  $strrpos + 1);
    }

    /**
     * Force the view
     * @param $viewPath string The fill path to the view (blade)
     */
	public function forceView($viewName, $viewPath){
        $this->forceView[$viewName] = $viewPath;
    }
}