<?php


namespace rohsyl\OmegaCore\Utils\Overt\Page;


use Illuminate\Http\RedirectResponse;
use rohsyl\OmegaCore\Models\Page;
use rohsyl\OmegaCore\Utils\Overt\Facades\Entity;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;
use rohsyl\OmegaCore\Utils\Overt\Menu\MenuManager;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PageManager
{

    private $id = null;
    private $lang = null;
    private $slug = null;

    private $viewName = null;
    private $viewArray = null;

    private $pageMeta = null;

    /**
     * @return $this
     */
    public function get() {
        return $this;
    }

    public function withSlug($slug){
        $this->slug = $slug;
        return $this;
    }

    public function withId($id){
        $this->id = $id;
        return $this;
    }

    public function withLang($lang){
        $this->lang = $lang;
        return $this;
    }

    public function withView($name, $param = []) {
        $this->viewName = $name;
        $this->viewArray = $param;
        return $this;
    }

    public function withPageMeta($pageMeta) {
        $this->pageMeta = $pageMeta;
        return $this;
    }

    private function getHome() {

        $homePageId = om_config('om_home_page_id');

        // no home page defined
        if(!isset($homePageId)) {
            $pageId = Page::query()
                ->published()
                ->orderBy('order')
                ->first();

            if (isset($pageId)){
                om_config(['om_home_page_id' => $pageId->id]);
                $homePageId = $pageId;
            }
            else
            {
                return abort(404);
            }
        }

        return $homePageId;
    }

    private function getId() {
        $page =
            Page::query()
                ->published()
                ->where('slug', $this->slug)
                ->select('id', 'slug')
                ->first();

        if(!isset($page)) {
            return abort(404);
        }

        return $page->id;
    }



    public function render() {

        if(isset($this->viewName)) {
            return $this->renderByView();
        }

        // if no id and no slug are set, then we will get the id of the homepage
        if($this->id == null && $this->slug == null){
            $res = $this->getHome();
        }

        // get page by slug
        if(isset($this->slug)){
            $res = $this->getId();
        }

        if($res instanceof RedirectResponse)
            return $res;
        else if($res instanceof HttpException)
            return $res;

        $this->id = $res;

        return $this->renderById();
    }


    /**
     * Render the page with the given id
     * @return mixed The rendered content
     */
    private function renderById(){
        if(!isset($this->id)) {
            return abort(404);
        }

        Entity::setPage(Page::find($this->id));
        Entity::Menu()->setCurrentPage(Entity::Page());

        return $this->renderPage(Entity::Page());
    }

    private function renderByView() {
        $page = new Page();
        $page->published_at = now();
        $page->content = view($this->viewName, $this->viewArray ?? [])->render();

        if(isset($this->pageMeta)) {
            foreach($this->pageMeta as $property => $value) {
                $page->$property = $value;
            }
        }

        Entity::setPage($page);
        Entity::Menu()->setCurrentPage(Entity::Page());

        return $this->renderPage(Entity::Page());
    }

    /**
     * @param $page Page The page to render
     */
    function renderPage($page)
    {
        $themePath = OmegaTheme::getThemePath();
        if(!file_exists( $themePath )) {
            // throw no theme exception
            return abort(404);
        }
        if(!Entity::Page()->is_published) {
            return abort(404);
        }

        $page->render();

        if($page->needRedirect()){
            return $page->getRedirect();
        }

        $modelPath = $themePath . DIRECTORY_SEPARATOR . 'template'. DIRECTORY_SEPARATOR . $page->model;

        // we load body and footer before the header so every assets is listed
        // in the Html object and then we can do a render of CSS and JS in the header
        if(isset($page->model) && !empty($page->model) && $page->model != 'default' && file_exists($modelPath)) {
            $pageBodyAndFooter = view('theme::template.'.without_ext(without_ext($page->model)))->render();
        }
        else {
            $pageBodyAndFooter = view('theme::index')->render();
        }

        // load the header and echo the body and footer
        $pageHeader = view('theme::header')->render();

        return new PageRenderable($pageHeader.$pageBodyAndFooter);
    }
}