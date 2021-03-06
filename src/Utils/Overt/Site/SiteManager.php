<?php


namespace rohsyl\OmegaCore\Utils\Overt\Site;


class SiteManager
{
    public $name;
    public $slogan;
    public $template_directory_uri;
    public  $template_name;
    public  $php_template_path;
    private $url;

    public function __construct($template_name = null){

        $this->name = om_config('om_site_title');
        $this->slogan = om_config('om_site_slogan');
        $this->url = url('/');
    }
}