<?php

namespace Lit\Config;

use Ignite\Application\Navigation\Config;
use Ignite\Application\Navigation\Navigation;

class NavigationConfig extends Config
{
    /**
     * Topbar navigation entries.
     *
     * @param  \Ignite\Application\Navigation\Navigation $nav
     * @return void
     */
    public function topbar(Navigation $nav)
    {
        $nav->section([
            $nav->preset('profile'),
        ]);

        $nav->section([
            $nav->title(__lit('navigation.user_administration')),

            $nav->preset('user.user')->icon(fa('users')),
            $nav->preset('permissions'),
        ]);

        $nav->section([
            $nav->title(__lit('navigation.settings')),

            $nav->preset('form.settings.settings')->title('Ustawienia')->icon(fa('cog')),

            $nav->preset('form.settings.site')->title('Ustawienia: Treści')->icon(fa('cog')),

            $nav->preset('form.settings.context')->title('Ustawienia: Specyficzne')->icon(fa('cog')),
        ]);
    }

    /**
     * Main navigation entries.
     *
     * @param  \Ignite\Application\Navigation\Navigation $nav
     * @return void
     */
    public function main(Navigation $nav)
    {
        // $nav->section([
        //     $nav->title('Models'),

        //     //
        // ]);

        // $nav->section([
        //     // $nav->title('Treść'),

        //     $nav->preset('form.site.site')->title('Ogólne')->icon(fa('globe')),
        // ]);

        $nav->section([
            // $nav->title('Strony'),

            $nav->group([
                'title' => 'Strona Główna',
                'icon'  => fa('home'),
            ], [
                $nav->preset('form.site.home_seo')->title('Seo')->icon(fa('fab', 'searchengin')),
                $nav->preset('form.site.home_banner')->title('Banner')->icon(fa('image')),
                // $nav->preset('form.site.home_slider')->title('Slider')->icon(fa('images')),
                $nav->preset('form.site.home_video')->title('Video')->icon(fa('video')),
                $nav->preset('form.site.home_photo_links')->title('Przyciski')->icon(fa('fas', 'link')),
                $nav->preset('form.site.home_content')->title('Dodatki')->icon(fa('file')),
                $nav->preset('crud.section')->title('Sekcje')->icon(fa('file')),
            ]),

            $nav->preset('crud.page_system')->title('Systemowe')->icon(fa('file-code')),
            // $nav->preset('crud.page')->title('Strony')->icon(fa('file-alt')),
            $nav->preset('crud.page_default')->title('Strony')->icon(fa('file-alt')),
            $nav->preset('crud.page_extended')->title('Strony Rzoszerzone')->icon(fa('file-alt')),
        ]);

        if (\Glare\Glare::hasService(\Glare\Glare::SERVICE_OFFER_PAGE)) :
            $nav->section([
                // $nav->title('Offer'),
                $nav->preset('crud.page_offer')->title('Oferta')->icon(fa('file-alt')),
            ]);
        endif;

        if (\Glare\Glare::hasService(\Glare\Glare::SERVICE_OFFER_CONTROLLER)) :
            $nav->section([
                // $nav->title('Offer'),
                $nav->preset('crud.offer')->title('Oferta')->icon(fa('file-alt')),
            ]);
        endif;

        if (\Glare\Glare::hasService(\Glare\Glare::SERVICE_BLOG)) :
        $nav->section([
            // $nav->title('Blog'),

            $nav->group([
                'title' => 'Blog',
                'icon'  => fa('fab', 'blogger-b'),
            ], [
                $nav->preset('crud.category')->title('Kategorie')->icon(fa('far', 'object-group')),
                $nav->preset('crud.page_post')->title('Posty')->icon(fa('far', 'file')),
                // $nav->preset('crud.post')->title('Posty')->icon(fa('far', 'file')),
            ]),

        ]);
        endif;

        $menuTypes = [
            $nav->preset('form.menu.menu_main')->title('Menu Główne')->icon(fa('bars')),
            $nav->preset('form.menu.menu_lang')->title('Menu Języki')->icon(fa('bars')),
            $nav->preset('form.menu.menu_footer')->title('Menu Stopka')->icon(fa('bars')),
            $nav->preset('form.menu.menu_system')->title('Menu System')->icon(fa('bars')),
            // $nav->preset('form.menu.menu_offer')->title('Menu Ofertowe')->icon(fa('bars'));
        ];

        $nav->section([
            // $nav->title('Menu'),

            $nav->group([
                'title' => 'Menu',
                'icon'  => fa('bars'),
            ], $menuTypes),

        ]);


        $nav->section([
            // $nav->title('Podgląd'),

            $nav->group([
                'title' => 'Inne',
                'icon'  => fa('fas',  'circle'),
            ], [
                $nav->preset('form.context.topic')->title('Tematy zapytania')->icon(fa('far', 'question-circle')),
            ]),

            $nav->group([
                'title' => 'Podgląd Importu',
                'icon'  => fa('fas',  'file-import'),
            ], [
                $nav->preset('crud.group')->title('Grupy')->icon(fa('object-group')),
                $nav->preset('crud.product')->title('Produkty')->icon(fa('object-group')),
            ]),

        ]);
    }
}
