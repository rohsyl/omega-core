<?php


namespace rohsyl\OmegaCore\Modules\Member;


class MemberManager
{
    private $loginRedirectUrl = null;
    private $logoutRedirectUrl = null;

    private $templateModel = null;

    /**
     * @return string
     */
    public function getLoginRedirectUrl(): string
    {
        return $this->loginRedirectUrl ?? config('omega.member.login_redirect_url', route('overt.module.member.profile'));
    }

    /**
     * @return string
     */
    public function getLogoutRedirectUrl(): string
    {
        return $this->logoutRedirectUrl ?? config('omega.member.logout_redirect_url', route('overt.module.member.login'));
    }

    /**
     * @return null
     */
    public function getTemplateModel()
    {
        return $this->templateModel ?? config('omega.member.template_model', 'member.blade.php');
    }

    /**
     * @param null $loginRedirectUrl
     */
    public function setLoginRedirectUrl(string $loginRedirectUrl): void
    {
        $this->loginRedirectUrl = $loginRedirectUrl;
    }

    /**
     * @param null $logoutRedirectUrl
     */
    public function setLogoutRedirectUrl(string $logoutRedirectUrl): void
    {
        $this->logoutRedirectUrl = $logoutRedirectUrl;
    }

    /**
     * @param null $templateModel
     */
    public function setTemplateModel(string $templateModel): void
    {
        $this->templateModel = $templateModel;
    }
}