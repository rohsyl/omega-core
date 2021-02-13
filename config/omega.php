<?php

return [

    /**
     * Configure the cache system of omega
     */
    'cache' => [
        'global' => [
            /**
             * The config table of omega is accessed a lot during the bootstraping
             * of Omega.
             * Here you can define which config entry (by the key) will be loaded
             * and stored globally before the bootstraping.
             */
            'config' => [
                /**
                 * These config entrie will be pre-loaded in the public part
                 */
                'public' => [
                    'om_site_title' , 'om_site_slogan', 'om_home_page_id',
                    'om_lang', 'om_default_front_langauge', 'om_enable_front_langauge',
                    'om_theme_name', 'om_web_adress',
                    'om_seo_description', 'om_seo_keyword',
                ],
                /**
                 * These config entries will be pre-loaded in the admin part
                 */
                'admin' => [
                    'om_lang', 'om_default_front_langauge', 'om_enable_front_langauge',
                ],
            ],
        ],
        'session' => [

        ],
    ],

    /**
     * Member part
     */
    'member' => [
        /**
         * Keep it disabled until it's implemented
         */
        'enabled' => false,

        'password' => [
            'salt' => 'Jb0=nuxa)2'
        ],
    ],

    /**
     * These string must not be used as page slug
     * You can put here some static string
     * or even database table column.
     * Exemple :
     * $[table_name].[column_name]
     */
    'reserved_slug' => [
        'admin', 'module', '$langs.slug'
    ]
];
