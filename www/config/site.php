<?php

return [

    'site' => 'site',

    'lang' => env('SITE_LANG', 'pl'),
    'langs' => env('SITE_LANGS', ['pl', 'de', 'en']),

    'mysql56' => false,

    'remote-footer' => [
        'enabled' => env('SITE_REMOTE_FOOTER_ENABLED', false),
        'cache' => env('SITE_REMOTE_FOOTER_CACHE', false),
        'api' => env('SITE_REMOTE_FOOTER_API'),
        'basedir' => storage_path('app/public/remote-footer'),
        'filename' => 'footer.inc',
        'body-default' => env('SITE_REMOTE_FOOTER_DEFAULT'),
        'http-timeout' => 60,
    ],

    'config-overrides' => [

        // 'app' => [
        //     'timezone' => 'Europe/Warsaw',
        //     'locale' => 'pl',
        //     'faker_locale' => 'pl_PL',
        //     'aliases' => [
        //         //'Str' => Illuminate\Support\Str::class,
        //     ],
        // ],

        'filesystems' => [
            'disks' => [

                'media' => [
                    'driver' => 'local',
                    'root' => storage_path('app/public/media'),
                    'url' => env('APP_URL').'/storage/media',
                    'visibility' => 'public',
                ],

            ],
        ],
    ],

    'models-with-position' => [
        \App\Models\Page::class,
        \App\Models\Section::class,
    ],

    'sitemap-generators' => [
        \Glare\Support\Sitemap\HomeSitemap::class,
        \Glare\Support\Sitemap\PageSitemap::class,
        \App\Support\Sitemap\ProductSitemap::class,
    ],

    'litstack' => [
        'site-routes' => [

            'page' => [
                'db-table' => 'pages',
                'types-translations' => 'model-page',
                'types' => [
                    'page' => [
                        'type' => 'page', // field in model db
                        'route' => 'page.show',
                    ],
                    'extended' => [
                        'type' => 'extended', // field in model db
                        'route' => 'page.show',
                    ],
                    'offer' => [
                        'type' => 'offer',
                        'route' => 'offer.show',
                    ],
                    'post' => [
                        'type' => 'post',
                        'route' => 'page.show',
                    ],
                    'system' => [
                        'type' => 'system',
                        'route' => 'page.show',
                    ]
                ]
            ],
        ],
    ],

];
