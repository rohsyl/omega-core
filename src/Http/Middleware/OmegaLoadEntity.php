<?php

namespace rohsyl\OmegaCore\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use rohsyl\OmegaCore\Utils\Common\Facades\OmegaUtils;
use rohsyl\OmegaCore\Utils\Overt\Facades\Entity;
use rohsyl\OmegaCore\Utils\Overt\Site\SiteManager;

class OmegaLoadEntity
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

        if(OmegaUtils::isInstalled()){
            Entity::setSite(new SiteManager());
        }

        return $next($request);
    }
}
