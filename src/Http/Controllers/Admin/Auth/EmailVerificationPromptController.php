<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Auth;

use Illuminate\Routing\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::DASHBOARD)
            : view('omega::admin.auth.verify-email');
    }
}