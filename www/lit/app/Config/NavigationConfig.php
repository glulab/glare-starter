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

        $settings = [];
        $settings[] = $nav->title(__lit('navigation.settings'));
        $settings[] = $nav->preset('form.settings.settings')->title('Ustawienia')->icon(fa('cog'));
        $settings[] = $nav->preset('form.settings.site')->title('Ustawienia Strony')->icon(fa('cog'));
        if (config('site.services.settings-context')) :
            $settings[] = $nav->preset('form.settings.context')->title('Ustawienia: Specyficzne')->icon(fa('cog'));
        endif;
        $settings[] = $nav->preset('crud.page_system')->title('Strony Systemowe')->icon(fa('file-code'));

        $nav->section($settings);
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

        $home = [];
        if (config('site.services.home-video')) :
            $home[] = $nav->preset('form.home.home_video')->title('Video')->icon(fa('video'));
        endif;
        if (config('site.services.home-banner')) :
            $home[] = $nav->preset('form.home.home_banner')->title('Banner')->icon(fa('image'));
        endif;
        if (config('site.services.home-slider')) :
            $home[] = $nav->preset('form.home.home_slider')->title('Slider')->icon(fa('images'));
        endif;
        $home[] = $nav->preset('form.home.home_photo_links')->title('Przyciski')->icon(fa('fas', 'link'));
        if (config('site.services.gallery')) :
            $home[] = $nav->preset('form.home.home_gallery')->title('Galeria')->icon(fa('far', 'images'));
        endif;
        $home[] = $nav->preset('crud.section')->title('Sekcje')->icon(fa('file'));
        $home[] = $nav->preset('form.home.home_content')->title('Dodatki')->icon(fa('file'));
        $home[] = $nav->preset('form.home.home_seo')->title('Seo')->icon(fa('fab', 'searchengin'));

        $pages = [];
        if (config('site.services.offer-page')) :
            $pages[] = $nav->preset('crud.page_offer')->title('Strony Ofertowe')->icon(fa('file-alt'));
        endif;
        $pages[] = $nav->preset('crud.page')->title('Strony')->icon(fa('file-alt'));
        // $pages[] = $nav->preset('crud.page_default')->title('Strony')->icon(fa('file-alt'));
        // $pages[] = $nav->preset('crud.page_extended')->title('Strony Rzoszerzone')->icon(fa('file-alt'));

        $nav->section(
            array_merge(
               [
                    // $nav->title('Strony'),

                    $nav->group([
                        'title' => 'Strona Główna',
                        'icon'  => fa('home'),
                    ], $home),
                ],
                $pages,
            )
        );

        // ============================================================================================================

        if (config('site.services.offer-controller')) :
            $nav->section([
                // $nav->title('Offer'),
                $nav->preset('crud.offer')->title('Oferta')->icon(fa('file-alt')),
            ]);
        endif;

        // ============================================================================================================

        $blog = [];
        $blog[] = $nav->preset('crud.category')->title('Kategorie')->icon(fa('far', 'object-group'));
        $blog[] = $nav->preset('crud.page_post')->title('Posty')->icon(fa('far', 'file'));
        // $blog[] = $nav->preset('crud.post')->title('Posty')->icon(fa('far', 'file'));

        if (config('site.services.blog')) :
        $nav->section([
            // $nav->title('Blog'),

            $nav->group([
                'title' => 'Blog',
                'icon'  => fa('fab', 'blogger-b'),
            ], $blog),

        ]);
        endif;

        // ============================================================================================================

        $media = [];
        if (config('site.services.gallery')) :
            $media[] = $nav->preset('crud.gallery')->title('Galeria')->icon(fa('far', 'images'));
        endif;
        $nav->section([
            // $nav->title('Media'),

            $nav->group([
                'title' => 'Media',
                'icon'  => fa('fas', 'photo-video'),
            ], $media),
        ]);

        // ============================================================================================================

        $menuTypes = [];
        $menuTypes[] = $nav->preset('form.menu.menu_main')->title('Menu Główne')->icon(fa('bars'));
        if (config('site.services.menu-lang')) :
            $menuTypes[] = $nav->preset('form.menu.menu_lang')->title('Menu Języki')->icon(fa('bars'));
        endif;
        if (config('site.services.menu-footer')) :
            $menuTypes[] = $nav->preset('form.menu.menu_footer')->title('Menu Stopka')->icon(fa('bars'));
        endif;
        if (config('site.services.menu-system')) :
            $menuTypes[] = $nav->preset('form.menu.menu_system')->title('Menu System')->icon(fa('bars'));
        endif;
        // $menuTypes[] = $nav->preset('form.menu.menu_offer')->title('Menu Ofertowe')->icon(fa('bars'));

        $nav->section([
            // $nav->title('Menu'),

            $nav->group([
                'title' => 'Menu',
                'icon'  => fa('bars'),
            ], $menuTypes),

        ]);
    }
}
