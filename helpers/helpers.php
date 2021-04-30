<?php
use rohsyl\OmegaCore\Models\Config;
use rohsyl\OmegaCore\Utils\Common\Facades\OmegaConfig;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;

define('DATEFORMAT', 'Y-m-d');
define('DATETIMEFORMAT', 'Y-m-d H:i:s');

if (!function_exists('om_config')) {
    /**
     * Get or set the key value in the configs table in the datable
     * @param $arg string|array if a string is passed, it will return the value of the config entry.
     *                          if an array is passed, it will set the key entry value.
     * @return string The value
     */
    function om_config($arg){
        if(is_array($arg)){
            $key = key($arg);
            $config = Config::firstOrNew(['key' => $key]);
            $config->value = $arg[$key];
            $config->save();
            OmegaConfig::updateIfExists($config);
            return $config->value;
        }
        else{
            // first try to load the value from the global cache
            $value = OmegaConfig::get($arg);
            if(isset($value)){
                return $value;
            }

            // and then if null, then load it from the database
            $config = Config::where('key', $arg)->first();
            return isset($config) ? $config->value : null;
        }
    }
}


if(!function_exists('without_ext')) {
    /**
     * Remove the extention from a filename
     * @param $filename
     * @return mixed
     */
    function without_ext($filename){
        return pathinfo($filename, PATHINFO_FILENAME);
    }
}



if(!function_exists('theme_asset')) {
    /**
     * @return string
     */
    function theme_asset($path)
    {
        return asset('theme/'.$path);
    }
}

if(!function_exists('get_template_register')) {

    function get_template_register()
    {
        $registerPath = OmegaTheme::getRegisterPath();

        if(!file_exists($registerPath)){
            return null;
        }

        return include($registerPath);
    }
}

if(!function_exists('theme_encode_components_template')) {
    /**
     * @param $themeName string
     * @param $newView \rohsyl\OmegaCore\Utils\Overt\Theme\Component\ComponentView
     * @return string
     */
    function theme_encode_components_template($newView)
    {
        return $newView->getPluginName() . '.' . $newView->getViewName() . '.' . $newView->getNewViewPath();
    }
}

if(!function_exists('theme_decode_components_template')) {
    /**
     * @param $componentsTemplateString string
     * @return \rohsyl\OmegaCore\Utils\Overt\Theme\Component\ComponentView
     */
    function theme_decode_components_template($componentsTemplateString)
    {
        if(!isset($componentsTemplateString) || $componentsTemplateString == 'null'){
            return null;
        }

        $t = explode('.',  $componentsTemplateString);
        $pluginName = $t[0];
        $viewName = $t[1];
        $newViewPath = $t[2];

        $register = get_template_register();

        $cv = $register->getComponentView($pluginName, $viewName, $newViewPath);

        return $cv;
    }
}

if (! function_exists('labelling_array')) {
    function labelling_array($array, $label_prefix = 'label.')
    {
        return array_combine($array, array_map(function ($value) use ($label_prefix) {
            return __($label_prefix.$value);
        }, $array));
    }
}