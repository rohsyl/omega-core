<?php

namespace rohsyl\OmegaCore\Http\Middleware;

use Closure;
use rohsyl\OmegaCore\Utils\Common\Facades\OmegaUtils;

class OmegaIsInstalled
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
        // if omega is installed, return a 404
        if(OmegaUtils::isInstalled()){
            return abort(404);
        }

        return $next($request);
    }
}
