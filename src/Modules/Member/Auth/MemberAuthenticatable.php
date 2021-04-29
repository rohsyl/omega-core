<?php


namespace rohsyl\OmegaCore\Modules\Member\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;
use rohsyl\LaravelAcl\Traits\UserAcl;

class MemberAuthenticatable extends Authenticatable
{
    use UserAcl;
}