<?php


namespace rohsyl\OmegaCore\Utils\Overt\Page;


use Illuminate\Http\RedirectResponse;
use rohsyl\OmegaCore\Utils\Common\Facades\OmegaUtils;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\Type;
use rohsyl\OmegaCore\Utils\Overt\Facades\Entity;
use rohsyl\OmegaCore\Utils\Overt\Theme\Component\ComponentView;

trait OvertPageTrait
{

    public string $content;

    private $needRedirect = false;
    private $redirectTo = null;

    public function render()
    {
        if(!isset($this->content)) {
            $this->renderComponent();

            // TODO : page securities

            /*if($this->secure && (session()->has('public.connectedToPage_'.$this->id) || isset($_SESSION['member_connected'])))
            {
                $this->renderComponent();
            }
            else if($this->securityType == 'none')
            {
                $this->renderComponent();
            }
            $this->doSecurityAction();*/
        }
    }

    public function doSecurityAction() {


        switch ($this->securityType)
        {
            case 'bypassword':

                $request = request();
                if(!session()->has('public.connectedToPage_'.$this->id))
                {
                    $hasLogin = false;
                    $hasError = false;

                    if($request->has('securityDoLogin'))
                    {
                        $hasLogin = true;
                        $password = $request->input('securityPassword');

                        if($password == $this->securityData['password'])
                        {
                            session(['public.connectedToPage_'.$this->id => true]);
                            $this->reload();
                        }
                        else
                        {
                            $hasError = true;
                            $this->securityData['error'] = __('Wrong password!');
                        }
                    }
                    if(!$hasLogin || ($hasLogin && $hasError))
                    {
                        $this->content = view('public.page.security.bypassword')->with($this->securityData)->render();
                        $this->model = 'default';
                    }
                }
                else
                {
                    $this->content .= view('public.page.security.bypassword_logout')->with($this->securityData)->render();

                    if($request->has('logout'))
                    {
                        session()->forget('public.connectedToPage_'.$this->id);
                        $this->reload();
                    }
                }
                break;

            case 'bymember':
                /*
                $error403 = function() {
                    if(isset($_SESSION['member_connected']) && $_SESSION['member_connected'] == true) {
                        MessageFront::error(Library\oo('You do not have permission to see this page', true));
                        Redirect::toUrl(PController::Url('error', '_403', true));
                    }
                    else {
                        MessageFront::error(Library\oo('You do not have permission to see this page. Please login....', true));
                        Redirect::toUrl(PController::Url('member', 'login', true));
                    }
                };

                if(isset($_SESSION['member_connected']) && $_SESSION['member_connected'] == true) {

                    if($this->securityData['membergroup'] != 1)
                    {
                        if (!OmegaUtil::member_IsInGroup($_SESSION['member_id'], $this->securityData['membergroup']))
                        {
                            $error403();
                        }
                    }
                }
                else $error403();*/
                break;
        }
    }

    public function reload() {
        $this->needRedirect = true;
        $this->redirectTo = redirect(self::GetUrl($this->page->id));
    }

    public function renderMacroFromContent($content) {
        $content = preg_replace_callback(
            '#\[macro\=(.+)\]\[\/macro\]#iUs',
            function($matches) {

                ob_start();
                include Path::Combine(macro_path(), $matches[1]);
                $html = ob_get_clean();

                return $html;
            },
            $content
        );
        return $content;
    }

    public function renderPhpFromContent($content) {
        ob_start();
        eval('?>' . $content);
        return ob_get_clean();
    }

    public function getComponentsViewArray(){

        $views = array();
        foreach($this->components as $component)
        {
            $plugin = Plugin::getPlugin($component->plugin_form->plugin->name);

            $controllerClass = $plugin->overtController();

            $instance = app()->make($controllerClass);;

            $instance->component_id = $component->id;

            // register css and js of the component
            OmegaUtils::addDependencies($instance->registerDependencies());

            $data = Type::GetValues($component->plugin_form->id, $component->id, $this->id);

            $args = $component->param;


            $defaultComponentView = new ComponentView(
                $component->plugin_form->name, 'default', '*', 'theme::template.' . $component->plugin_form->name . '.default', 'Theme Default'
            );

            // force using an other view defined in the settings of the component
            if(isset($args['settings']['pluginTemplate'])){
                $ct = theme_decode_components_template($args['settings']['pluginTemplate']);
                $instance->forceView($ct->getViewName(), $ct->getNewView());
            }
            else if(view()->exists($defaultComponentView->getNewView())) {
                $instance->forceView($defaultComponentView->getViewName(), $defaultComponentView->getNewView());
            }

            $isHidden = isset($args['settings']['isHidden']) ? $args['settings']['isHidden'] : false;
            if(!$isHidden) {
                $content = $instance->display($args, $data);

                $compId = null;
                $isWrapped = false;
                $backgroundColor = 'transparent';
                $title = 'No title';
                if (isset($args['settings'])) {
                    $backgroundColor = isset($args['settings']['bgColor']) ? $args['settings']['bgColor'] : 'transparent';
                    $compId = isset($args['settings']['compId']) ? 'id="'.$args['settings']['compId'].'"' : null;
                    $title = isset($args['settings']['compTitle']) ? $args['settings']['compTitle'] : 'No title';
                }
                $style = $backgroundColor == 'transparent' ? null : 'style="background-color: ' . $backgroundColor . ';"';

                $views[] = [
                    'title' => $title,
                    'html' => view()->first(['theme::template.section', 'omega::overt.section'])->with([
                        'compId' => $compId,
                        'style' => $style,
                        'plugin' => $component->plugin_form,
                        'isWrapped' => $isWrapped,
                        'content' => $content,
                    ])->render(),
                ];
            }
        }
        return $views;
    }

    private function renderComponent() {

        foreach($this->components as $component)
        {
            $plugin = Plugin::getPlugin($component->plugin_form->plugin->name);

            $controllerClass = $plugin->overtController();

            $instance = app()->make($controllerClass);;

            $instance->component_id = $component->id;

            // register css and js of the component
            OmegaUtils::addDependencies($instance->registerDependencies());

            $data = Type::GetValues($component->plugin_form->id, $component->id, $this->id);

            $args = $component->param;


            $defaultComponentView = new ComponentView(
                $component->plugin_form->name, 'default', '*', 'theme::template.' . $component->plugin_form->name . '.default', 'Theme Default'
            );

            // force using an other view defined in the settings of the component
            if(isset($args['settings']['pluginTemplate']) && !empty($args['settings']['pluginTemplate'])){
                $ct = theme_decode_components_template($args['settings']['pluginTemplate']);
                if(isset($ct)) {
                    $instance->forceView($ct->getViewName(), $ct->getNewView());
                }
            }
            else if(view()->exists($defaultComponentView->getNewView())) {
                $instance->forceView($defaultComponentView->getViewName(), $defaultComponentView->getNewView());
            }

            $isHidden = isset($args['settings']['isHidden']) ? $args['settings']['isHidden'] : false;
            if(!$isHidden) {

                $content = $instance->display($args, $data);

                if($content instanceof RedirectResponse){
                    $this->needRedirect = true;
                    $this->redirectTo = $content;
                    return;
                }

                $compId = null;
                $isWrapped = true;
                $backgroundColor = 'transparent';
                if (isset($args['settings'])) {
                    $isWrapped = isset($args['settings']['isWrapped']) ? $args['settings']['isWrapped'] : true;
                    $backgroundColor = isset($args['settings']['bgColor']) ? $args['settings']['bgColor'] : 'transparent';
                    $compId = isset($args['settings']['compId']) ? 'id="'.$args['settings']['compId'].'"' : null;
                }
                $style = $backgroundColor == 'transparent' ? null : 'style="background-color: ' . $backgroundColor . ';"';

                $this->content .= view()->first(['theme::template.section', 'omega::overt.section'])->with([
                    'compId' => $compId,
                    'plugin' => $component->plugin_form,
                    'style' => $style,
                    'isWrapped' => $isWrapped,
                    'content' => $content,
                ])->render();
            }
        }
    }

    public function needRedirect() {
        return $this->needRedirect;
    }

    public function getRedirect() {
        return $this->redirectTo;
    }

    /**
     * Get the id of the parent page.
     * Return null when no parent page.
     * @return integer|null
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Get the id of the author of the page
     * @return integer
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * Get the id of the menu configured for this page
     * Return null when no menu configured
     * @return integer|null
     */
    public function getMenuId()
    {
        return $this->menu_id;
    }

    /**
     * Get the slug of the page
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get title of the page
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get sub-title of the page
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Should the title be shown on the page
     * @return boolean
     */
    public function getShowTitle()
    {
        return $this->show_title;
    }

    /**
     * Should the sub-title be shown on the page
     * @return boolean
     */
    public function getShowSubtitle()
    {
        return $this->show_subtitle;
    }

    /**
     * Get the keywords of this page
     * @return string|null
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Get the content of the page
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    public static function RenderSpecialContent($content)
    {
        $p = new self();
        return $p->renderMacroFromContent($p->renderPhpFromContent($content));
    }

    public function getUrl(){
        return url('/' . Entity::LocaleSlug() . '/' . $this->slug);
    }
}