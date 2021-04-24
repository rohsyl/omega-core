<?php


namespace rohsyl\OmegaCore\Utils\Overt\Page;


use Illuminate\Http\RedirectResponse;
use rohsyl\OmegaCore\Utils\Common\Facades\OmegaUtils;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\Type;

trait OvertPageTrait
{


    private $needRedirect = false;
    private $redirectTo = null;
    private $_content = null;


    public function render()
    {
        $this->renderComponent();

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

    public static function RenderSpecialContent($content)
    {
        $p = new Page();
        return $p->renderMacroFromContent($p->renderPhpFromContent($content));
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

        $components = $this->moduleRepository->getAllComponentsByPage($this->id);


        $views = array();
        foreach($components as $component)
        {

            $instance = Plugin::FInstance($component->plugin->name);

            $instance->idComponent = $component->id;

            // register css and js of the component
            OmegaUtils::addDependencies($instance->registerDependencies());

            $data = Type::GetValues($component->plugin->id, $component->id, $this->id);

            $args = json_decode($component->param, true);


            $defaultComponentView = new ComponentView(
                $component->plugin->name,
                'default',
                '*',
                Path::Combine($component->plugin->name, 'default'),
                'Theme Default'
            );
            $defaultComponentView->setThemeName(\Omega\Facades\Entity::Site()->template_name);

            // force using an other view defined in the settings of the component
            if(isset($args['settings']['pluginTemplate']) && $args['settings']['pluginTemplate'] != 'null'){
                $ct = theme_decode_components_template($args['settings']['pluginTemplate']);
                $instance->forceView($ct->getViewName(), $ct->buildPath());
            }
            else if(file_exists($defaultComponentView->buildPath())) {
                $instance->forceView($defaultComponentView->getViewName(), $defaultComponentView->buildPath());
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
                    'html' => view()->first(['theme::template.section', 'public.section'])->with([
                        'compId' => $compId,
                        'style' => $style,
                        'plugin' => $component->plugin,
                        'isWrapped' => $isWrapped,
                        'content' => $content,
                    ])->render(),
                ];
            }
        }
        return $views;
    }

    private function renderComponent() {

        $components = $this->components;

        foreach($components as $component)
        {
            $plugin = Plugin::getPlugin($component->plugin_form->plugin->name);

            $controllerClass = $plugin->overtController();

            $instance = app()->make($controllerClass);;

            $instance->component_id = $component->id;

            // register css and js of the component
            OmegaUtils::addDependencies($instance->registerDependencies());

            $data = Type::GetValues($component->plugin_form->id, $component->id, $this->id);

            $args = $component->param;


            /*$defaultComponentView = new ComponentView(
                $component->plugin->name,
                'default',
                '*',
                Path::Combine($component->plugin->name, 'default'),
                'Theme Default'
            );
            $defaultComponentView->setThemeName(\Omega\Facades\Entity::Site()->template_name);

            // force using an other view defined in the settings of the component
            if(isset($args['settings']['pluginTemplate']) && $args['settings']['pluginTemplate'] != 'null'){
                $ct = theme_decode_components_template($args['settings']['pluginTemplate']);
                $instance->forceView($ct->getViewName(), $ct->buildPath());
            }
            else if(file_exists($defaultComponentView->buildPath())) {
                $instance->forceView($defaultComponentView->getViewName(), $defaultComponentView->buildPath());
            }*/

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
}