<?php


namespace rohsyl\OmegaCore\Utils\Overt;


use rohsyl\OmegaCore\Models\Locale;
use rohsyl\OmegaCore\Models\Page;
use rohsyl\OmegaCore\Utils\Overt\Menu\MenuManager;
use rohsyl\OmegaCore\Utils\Overt\Site\SiteManager;

class EntityManager
{
    /**
     * @var Page
     */
    private $page;

    /**
     * @var MenuManager
     */
    private $menu;

    /**
     * @var SiteManager
     */
    private $site;

    /**
     * @var Locale
     */
    private $lang;

    /**
     * @var string
     */
    private $langSlug = null;

    /**
     * @param $page Page
     */
    public function setPage($page){
        $this->page = $page;
    }

    /**
     * @param $menu MenuManager
     */
    public function setMenu($menu){
        $this->menu = $menu;
    }

    /**
     * @param $site object
     */
    public function setSite($site){
        $this->site = $site;
    }

    /**
     * @param $lang Locale
     */
    public function setLocale($lang){
        $this->lang = $lang;
    }

    public function setLocaleSlug($langSlug){
        $this->langSlug = $langSlug;
    }

    /**
     * @return MenuManager
     */
    public function Menu(){
        return $this->menu;
    }

    /**
     * @return Page
     */
    public function Page(){
        return $this->page;
    }

    /**
     * @return object
     */
    public function Site(){
        return $this->site;
    }

    /**
     * @return Locale
     */
    public function Locale(){
        return $this->lang;
    }

    /**
     * @return null|string
     */
    public function LocaleSlug(){

        return $this->langSlug;
    }
}