<?php

namespace rohsyl\OmegaCore\Http\Middleware;

use Closure;
use rohsyl\OmegaCore\Utils\Common\Facades\OmegaUtils;

class OmegaNotInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if omega is not installed, redirect to installation
        if(!OmegaUtils::isInstalled()){
            return redirect(route('omega.install.index'));
        }

        return $next($request);
    }
}
