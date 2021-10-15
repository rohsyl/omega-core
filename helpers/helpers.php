<?php
use rohsyl\OmegaCore\Models\Config;
use rohsyl\OmegaCore\Utils\Common\Facades\OmegaConfig;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;
use rohsyl\OmegaCore\Models\Media;

define('DATEFORMAT', 'Y-m-d');
define('DATETIMEFORMAT', 'Y-m-d H:i:s');
define('DEFAULT_PAGINATION', 50);

// Authorized extensions for upload
// Pictures
define('AUTHORIZED_PICTURE_TYPE', serialize(array(
    'jpg',        'jpeg',
    'png',        'svg',
    'gif'
)));
// Videos
define('AUTHORIZED_VIDEO_TYPE', serialize(array(
    'mp4',     'm4v',
    'mov',     'wmv',
    'avi',     'mpg'
)));
// Audios
define('AUTHORIZED_AUDIO_TYPE', serialize(array(
    'mp3',     'm4a',
    'ogg',     'wav'
)));
// Documents
define('AUTHORIZED_DOCUMENT_TYPE', serialize(array(
    'pdf',
    'doc',     'docx',
    'ppt',     'pptx',
    'pps',     'ppsx',
    'xls',     'xlsx',
    'odt',     'odp',
    'ods',    'ott'
)));
define('AUTHORIZED_OTHER_TYPE', serialize(array(

)));

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
        return $newView->getPluginName() . '|' . $newView->getViewName() . '|' . $newView->getNewView();
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

        $t = explode('|',  $componentsTemplateString);

        if(sizeof($t) !== 3) {
            return null;
        }

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

if (! function_exists('media_type_by_ext')) {
    function media_type_by_ext($ext) {
        if(in_array($ext, unserialize(AUTHORIZED_PICTURE_TYPE))){
            $file_type = Media::MT_PICTURE;
        }
        elseif(in_array($ext, unserialize(AUTHORIZED_VIDEO_TYPE))){
            $file_type = Media::MT_VIDEO;
        }
        elseif(in_array($ext, unserialize(AUTHORIZED_AUDIO_TYPE))){
            $file_type = Media::MT_MUSIC;
        }
        elseif(in_array($ext, unserialize(AUTHORIZED_DOCUMENT_TYPE))){
            $file_type = Media::MT_DOCUMENT;
        }
        elseif(in_array($ext, unserialize(AUTHORIZED_OTHER_TYPE))){
            $file_type = Media::MT_OTHER;
        }
        else {
            $file_type = null;
        }
        return $file_type;
    }
}