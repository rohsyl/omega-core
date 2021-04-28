<?php


namespace rohsyl\OmegaCore\Modules\Member;


class MemberManager
{
    private $loginRedirectUrl = null;
    private $logoutRedirectUrl = null;

    /**
     * @return string
     */
    public function getLoginRedirectUrl(): string
    {
        return $this->loginRedirectUrl ?? config('omega.member.loginRedirectUrl', route('overt.module.member.profile'));
    }

    /**
     * @return string
     */
    public function getLogoutRedirectUrl(): string
    {
        return $this->logoutRedirectUrl ?? config('omega.member.logoutRedirectUrl', route('overt.module.member.login'));
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
}