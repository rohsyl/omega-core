<?php

namespace rohsyl\OmegaCore\Utils\Facades\Common;

use Illuminate\Support\Facades\Facade;
use rohsyl\OmegaCore\Models\Config;
use rohsyl\OmegaCore\Models\User;

/**
 * @method static mixed get(string $key)
 * @method static void load(array $configKeys)
 * @method static void updateIfExists(Config $config)
 * @method static void loadUserPermissionsInSession(User $user)
 *
 * @see \Omega\Utils\Entity\OmegaConfig
 */
class OmegaConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'omega:config';
    }
}