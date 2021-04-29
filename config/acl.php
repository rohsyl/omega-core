<?php
return [

    'defaults' => [
        'acls' => 'users',
    ],

    'models' => [
        \rohsyl\OmegaCore\Models\User::class => 'users',

        \rohsyl\OmegaCore\Models\Member::class => 'members',
        \rohsyl\OmegaCore\Models\MemberGroup::class => 'members'
    ],

    'cache' => [
        'enable' => false,
        'key' => 'laravel-acl_',
        'store' => '',
        'expiration_time' => 432000
    ],
];
