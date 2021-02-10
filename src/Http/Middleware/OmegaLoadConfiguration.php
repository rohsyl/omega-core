<?php

namespace rohsyl\OmegaCore\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use rohsyl\OmegaCore\Utils\Common\Facades\OmegaConfig;

class OmegaLoadConfiguration
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $adminOrPublic = $request->is('admin/*') ? 'admin' : 'public';
        $configKeys = config('omega.cache.global.config.'.$adminOrPublic);

        OmegaConfig::load($configKeys);

        return $next($request);
    }
}
