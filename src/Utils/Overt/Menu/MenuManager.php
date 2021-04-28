<?php


namespace rohsyl\OmegaCore\Utils\Overt\Menu;


use Illuminate\Support\Collection;
use Omega\Utils\Url;
use rohsyl\OmegaCore\Models\Member;
use rohsyl\OmegaCore\Models\Menu;
use rohsyl\OmegaCore\Models\Page;
use rohsyl\OmegaCore\Utils\Overt\Facades\Entity;

class MenuManager
{

    /**
     * @var array
     */
    private $menuHtmlStruct;

    /**
     * @see Page
     * @var Page Active Page
     */
    private $currentPage = null;


    public function __construct()
    {
        $this->menuHtmlStruct = array(
            'ul_main' => '<ul>%1$s</ul>',
            'li_nochildren' => '<li class="nav-item-%3$s"><a href="%1$s" %4$s>%2$s</a></li>',
            'li_nochildrenactiv' => '<li class="active nav-item-%3$s"><a href="%1$s" class="active" %4$s>%2$s</a></li>',
            'li_children' => '<li class="nav-item-%3$s"><a href="%1$s" %5$s>%2$s</a>%4$s</li>',
            'ul_children' => '<ul>%1$s</ul>',
            'li_childrenactiv' => '<li class="active nav-item-%3$s"><a href="%1$s" %5$s>%2$s</a>%4$s</li>'
        );
    }

    /**
     * Set the active page
     * @param $page Page
     */
    public function setCurrentPage($page) {
        $this->currentPage = $page;
    }

    public function setMenuHtmlStruct($menuHtmlStruct) {
        $this->menuHtmlStruct = $menuHtmlStruct;
    }

    /**
     * @deprecated
     * @return string
     */
    public function getPublic() {
        return 'getPublic() is deprecated, use getBySecurity() instead.';
    }

    /**
     * Get a menu by id
     * @param $id int The id of the menu
     * @return string The html structure
     */
    public function getMenuById($id) {
        $menu = Menu::find($id);

        if($menu == null) return 'No menu';

        $menuHtml = $this->getHtmlFromJson($menu->json, $this->menuHtmlStruct, $menu->lang);

        return $menuHtml;
    }

    /**
     * Get the menu
     * @return string The html structure
     */
    public function getBySecurity() {

        $menu = null;
        if (isset($this->currentPage) && isset($this->currentPage->idMenu)) {
            $menu = Menu::find($this->currentPage->idMenu);
        }

        // else find menu by member group
        if (!isset($menu)) {
            $ids = $this->getMemberGroupOrPublic();
            foreach ($ids as $id) {

                $menu = Menu::query()
                    ->where('member_group_id', $id)
                    ->where('is_enabled', true)
                    ->where('is_main', true)
                    ->first();

                if (isset($menu)) {
                    break;
                }
            }
        }

        // if no menu found
        if (!isset($menu)) {
            return 'No menu';
        }

        return $this->getHtml($menu, $this->menuHtmlStruct, Entity::LocaleSlug());
    }

    /**
     * Get the main menu by security or by id if the id is given as paramenter
     * @param null $id The id of the menu to retrive
     * @return array
     */
    public function getAsArray($id = null){

        $menu = null;

        if(isset($id)){
            $menu = Menu::find($id);
        }

        if (isset($this->currentPage) && isset($this->currentPage->idMenu)) {
            $menu = Menu::find($this->currentPage->idMenu);
        }

        // else find menu by member group
        if (!isset($menu)) {
            $ids = $this->getMemberGroupOrPublic();
            foreach ($ids as $id) {

                $menu = Menu::query()
                    ->with(['items', 'items.children'])
                    ->where('member_group_id', $id)
                    ->where('is_enabled', true)
                    ->where('is_main', true)
                    ->first();

                if (isset($menu)) {
                    break;
                }
            }
        }

        // if no menu found
        if (!isset($menu)) {
            return [];
        }

        return [
            'menu' => json_decode($menu->json)
        ];
    }

    private function getHtml(Menu $menu, $html, $lang = null, $level = -1, &$containesActive = false) {
        $level++;

        $z = $this->getHtmlMenuItems($menu->items, $html, $lang, $level, $containesActive);

        $z .= $this->getMemberPart();
        //$z .= $this->getLanguagePart();
        $z = sprintf($html['ul_main'], $z);

        return $z;
    }

    private function getHtmlMenuItems(Collection $menuItems, $html, $lang = null, $level = -1, &$containesActive = false) {
        $current_page = substr(strrchr(strtok($_SERVER["REQUEST_URI"],'?'), "/"), 1);
        $z = '';
        foreach($menuItems as $item) {

            $url = $item->link;
            $title = $item->label;
            $isNewTab = isset($row['isnewtab']) ? $row['isnewtab'] : false;

            $target = $isNewTab ? 'target="_blank"' : '';

            if($item->children->count() > 0) {

                $children = $item->children;

                $containesActive = false;

                $sub = $this->getHtmlMenuItems($children, $html, $lang, $level, $containesActive);


                if($url == $current_page || $containesActive){

                    $z .= sprintf($html['li_childrenactiv'], $this->PrepareUrl($url, $lang), $title, strtolower(\Illuminate\Support\Str::slug($title)), $sub, $target);
                    $containesActive = true;

                } else {

                    $z .= sprintf($html['li_children'], $this->PrepareUrl($url, $lang), $title, strtolower(\Illuminate\Support\Str::slug($title)), $sub, $target);

                }

            }
            else {

                if($url == $current_page) {

                    self::$currentPageUrl = $url;

                    $z .= sprintf($html['li_nochildrenactiv'], $this->PrepareUrl($url, $lang), $title, strtolower(\Illuminate\Support\Str::slug($title)), $target);
                    $containesActive = true;

                } else {

                    $z .= sprintf($html['li_nochildren'], $this->PrepareUrl($url, $lang), $title, strtolower(\Illuminate\Support\Str::slug($title)), $target);

                }

            }
        }

        $z = sprintf($html['ul_children'], $z);

        return $z;
    }

    public function getMemberPart()
    {
        $html = $this->menuHtmlStruct;
        $z = '';

        if(config('omega.member.enabled')) {

            $title = '<span class="glyphicon glyphicon-user"></span> <span class="hidden-md hidden-lg">'.__('Member') .'</span>';
            $url = '#';

            if(auth()->guard('member')->check())
            {
                $subItems = sprintf($html['li_nochildren'], $this->PrepareUrl('/module/member/profile'), __('Profil'), 'profil', '');
                $subItems .= sprintf($html['li_nochildren'], $this->PrepareUrl('/module/member/logout'), __('Logout'), 'logout', '');
                $sub = sprintf($html['ul_children'], $subItems);
                $z .= sprintf($html['li_children'], $url, $title, 'member', $sub, '');
            }
            else
            {
                $subItems = sprintf($html['li_nochildren'], $this->PrepareUrl('/module/member/login'), __('Log in'), 'login', '');
                $sub = sprintf($html['ul_children'], $subItems);
                $z .= sprintf($html['li_children'], $url, $title, 'member', $sub, '');
            }
            return $z;
        }
        return '';
    }

    public function getLanguagePart()
    {

        $langEnabled = $this->langRepository->isEnabled();

        $html = $this->menuHtmlStruct;
        $z = '';

        // TODO use Front/Lang

        if($langEnabled) {

            $title = '<span class="glyphicon glyphicon-globe"></span> <span class="hidden-md hidden-lg">'.__('Language') .'</span>';
            $url = '#';

            $current_page = Entity::Page()->id;
            $current_page = $current_page != 0 ? $current_page : url()->previous();
            $languages = $this->langRepository->allEnabled();

            $subItems = '';
            foreach($languages as $lang)
            {
                if(session('front_lang') == $lang->slug){
                    $urlLang = Page::GetUrl($current_page);
                }
                else{
                    $urlLang = route('public.language.change', [
                        'target' => $lang->slug,
                        'referer' => $current_page
                    ]);
                }
                $htmlType = session('front_lang') == $lang->slug ? 'li_nochildrenactiv' : 'li_nochildren';
                $subItems .= sprintf($html[$htmlType], $urlLang, $lang->name, $lang->slug, '');
            }


            $sub = sprintf($html['ul_children'], $subItems);
            $z .= sprintf($html['li_children'], $url, $title, 'language', $sub, '');

            return $z;
        }



        return '';
    }

    /**
     * Get langs menu as an array
     * @return array
     */
    public function getLangaugeMenuAsArray()
    {
        $langEnabled = $this->langRepository->isEnabled();
        // TODO use Front/Lang
        if($langEnabled) {

            $current_page = Entity::Page()->id;
            $current_page = $current_page != 0 ? $current_page : url()->previous();
            $languages = $this->langRepository->allEnabled();

            $navItems = [];
            foreach($languages as $lang)
            {
                if(session('front_lang') == $lang->slug){
                    $urlLang = Page::GetUrl($current_page);
                }
                else{
                    $urlLang = route('public.language.change', [
                        'target' => $lang->slug,
                        'referer' => $current_page
                    ]);
                }
                $navItems[] = [
                    'url' => $urlLang,
                    'title' => $lang->name,
                    'lang' => $lang
                ];
            }

            return [
                'selected_lang' => $this->langRepository->getBySlug(session('front_lang')),
                'menu' => $navItems
            ];
        }

        return [];
    }


    private function getMemberGroupOrPublic()
    {
        if(session()->has('member_id')) {
            $member = Member::find(session('member_id'));

            if($member->membergroups->count() == 0){
                return [null];
            }
            return $member->membergroups->pluck('id');
        }
        else
            return [null];
    }

    /**
     * Format an URL
     * @param $url string The URL
     * @param null $lang The lang
     * @return string The new URL
     */
    public function PrepareUrl($url, $lang = null)
    {
        // if url start with '#', 'http://' or 'https://', then leave it like that
        if(strpos($url, '#') === 0
            || strpos($url, 'http://') === 0
            || strpos($url, 'https://') === 0
            || strpos($url, '/module') === 0){
            return $url;
        }

        if(!isset($lang))
            return url($url);


        $trimedUrl = trim($url, '/');
        // if lang slug already in $url, don't change the $url
        if(strpos($trimedUrl, $lang) === 0){
            return url($url);
        }
        // else add lang slug
        return url($lang . $url);

    }
}