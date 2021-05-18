<?php

return [

    'site' => 'site',

    'lang' => env('SITE_LANG', 'pl'),
    'langs' => env('SITE_LANGS', ['pl', 'de', 'en']),

    'mysql56' => false,

    'remote-footer' => [
        'enabled' => env('SITE_REMOTE_FOOTER_ENABLED', false),
        'cache' => env('SITE_REMOTE_FOOTER_CACHE', true),
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
    ],

    'config' => [
        'site-routes' => [
            'page' => [
                'db-table' => 'pages',
                'types-translations' => 'site/models/page',
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

        'select-options' => [
            'page-routes' => [
                'contact',
                'gallery',
                // 'offer',
            ],
            'section-locations' => [
                'top',
                'main',
                // 'column',
                'bottom',
            ],
            'section-types' => [
                'home',
            ],
        ],

        'ratios' => [ // 0 to turn off
            'home-banner' => env('SITE_CONFIG_RATIOS_HOME_BANNER_WIDTH', 0) / env('SITE_CONFIG_RATIOS_HOME_BANNER_HEIGHT', 1),
            'home-slider' => env('SITE_CONFIG_RATIOS_HOME_SLIDER_WIDTH', 0) / env('SITE_CONFIG_RATIOS_HOME_SLIDER_HEIGHT', 1),
            'page-banner' => env('SITE_CONFIG_RATIOS_PAGE_BANNER_WIDTH', 0) / env('SITE_CONFIG_RATIOS_PAGE_BANNER_HEIGHT', 1),
            'photo-link' => env('SITE_CONFIG_RATIOS_PHOTO_LINK_WIDTH', 0) / env('SITE_CONFIG_RATIOS_PHOTO_LINK_HEIGHT', 1),
        ],
    ],

    'services' => [
        'catalog' => false,
        'gallery' => true,
        'offer-controller' => false,
        'offer-page' => true,

        'settings-theme' => false,

        'contact-form' => true,

        'home-video' => false,
        'home-banner' => true,
        'home-slider' => false,

        'menu-lang' => true,
        'menu-system' => false,
        'menu-footer' => false,
    ],

    'options' => [
        'home-video-has-responsive-sources' => false,
        'home-video-has-title' => false,
        'home-video-has-button' => true,

        'home-banner-has-title' => false,
        'home-banner-has-button' => true,

        'home-slider-has-button' => true,

        'photo-link-has-title' => true,
        'photo-link-has-text' => true,
        'photo-link-has-button' => true,

        'contact-form-has-split-fullname' => false,

        'link-has-class' => false,
        'link-has-itemprop' => false,
        'link-has-icon' => true,
        'link-has-filename' => false,

        'contact-link-has-class' => true,
        'contact-link-has-itemprop' => true,
        'contact-link-has-icon' => false,
        'contact-link-has-filename' => true,

        'map-has-embed-code' => false,
        'map-has-url' => true,
    ],
];
