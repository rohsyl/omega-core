<?php

namespace rohsyl\OmegaCore\Http\Controllers\Overt\Modules\Member\Auth;

use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Http\Requests\Overt\Modules\Member\Auth\LoginRequest;
use rohsyl\OmegaCore\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use rohsyl\OmegaCore\Utils\Overt\Facades\Page;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Page::get()
            ->withView('omega::overt.modules.member.auth._login')
            ->withPageMeta([
                'title' => __('Member'),
                'subtitle' => __('Login')
            ])
            ->render();
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended('/module/member/profile');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('member')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/module/member/login');
    }
}