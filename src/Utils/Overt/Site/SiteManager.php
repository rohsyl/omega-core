<?php


namespace rohsyl\OmegaCore\Utils\Overt\Site;


use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;

class SiteManager
{
    public $name;
    public $slogan;
    private $url;

    public function __construct($template_name = null){

        $this->name = om_config('om_site_title');
        $this->slogan = om_config('om_site_slogan');
        $this->url = url('/');
    }

    /**
     * @return \rohsyl\OmegaCore\Utils\Common\Widget\WidgetAreaManager
     */
    public function widgetArea() {
        return OmegaTheme::widgetArea();
    }

    /**
     * Get the name of the website
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get the slogan of the website
     * @return string|null
     */
    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    /**
     * Get the URL of the website
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}