<?php
use rohsyl\OmegaCore\Models\Config;
use rohsyl\OmegaCore\Utils\Facades\Common\OmegaConfig;

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