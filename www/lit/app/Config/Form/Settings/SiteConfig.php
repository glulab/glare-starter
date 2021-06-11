<?php

namespace Lit\Config\Form\Settings;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Settings\SiteController;

class SiteConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = SiteController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "settings/site";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'Site',
        ];
    }

    /**
     * Setup form page.
     *
     * @param \Lit\Crud\CrudShow $page
     * @return void
     */
    public function show(CrudShow $page)
    {
        $page->expand();

        $page->title('Ustawienia Strony');

        $page->card(function($form) {

            $form->image('banner')->title('Strony: Banner domyślny')->maxFiles(1)->crop(config('site.config.ratios.page-banner'))->expand()->hint('Strony: Banner domyślny');

        })->title('Banner');


        if (config('site.options.map-has-embed-code') || config('site.options.map-has-url')) :
        $page->info('Mapa');
        $page->card(function ($form) {
            if (config('site.options.map-has-embed-code')) :
                $form->textarea('map_iframe_src')->title('Mapa: kod iframe')->hint('Udostęppnij -> Umieszczanie mapy -> Kopiuj HTML.');
            endif;
            if (config('site.options.map-has-url')) :
                $form->input('map_url')->title('Mapa: adres url')->hint('Udostępnij -> Wysyłanie linku -> Link do udostępnienia: Kopiuj link.');
            endif;
        });
        endif;

        $page->info('Linki kontaktowe');
        $page->card(function ($form) {
            $form->block('contact_links')->title('Linki Kontaktowe')->hint('Po stworzeniu każdej pozycji naciśnij: Zapisz')->repeatables(function ($repeatables) {
                $repeatables->add(\Lit\Repeatables\ContactLinkRepeatable::class)->button(__lit('base.item_add', ['item' => ''])); // ->view('lit.blocks.contact_links', ['key' => 'class']);
            });
            /*
            {!! Helper::getFromCollection($site->contact_links, 'twitter', 'class', 'url') !!}
            {!! $site->contact_links->count() !!}
            {!! $site->contact_links->all() !!}
            {!! $site->contact_links->pluck('url', 'class')->get('twitter') !!}
            {!! $site->contact_links->pluck('url', 'class')->all() !!}
             */
        });

        $page->info('Linki');
        $page->card(function ($form) {
            $form->block('links')->title('Linki')->hint('Po stworzeniu każdej pozycji naciśnij: Zapisz')->repeatables(function ($repeatables) {
                $repeatables->add(\Lit\Repeatables\LinkRepeatable::class)->button(__lit('base.item_add', ['item' => ''])); // ->view('lit.blocks.links', ['key' => 'class']);
            });
            /*
            {!! Helper::getFromCollection($site->links, 'twitter', 'class', 'url') !!}
            {!! $site->links->count() !!}
            {!! $site->links->all() !!}
            {!! $site->links->pluck('url', 'class')->get('twitter') !!}
            {!! $site->links->pluck('url', 'class')->all() !!}
             */
        });

        if (config('site.services.contact-form')) :
        $page->info('Formularz Kontaktowy');
        $page->card(function ($form) {
            $form->input('contact_form_title')->title('Formularz Kontaktowy: Tytuł');
            $form->textarea('contact_form_text')->title('Formularz Kontaktowy: Treść');
            if(config('site.options.contact-form-has-subject')) :
              $form->block('contact_form_subjects')->title('Tematy')->hint('Po stworzeniu każdej pozycji naciśnij: Zapisz')->repeatables(function ($repeatables) {
                  $repeatables->add(\Lit\Repeatables\ContactFormSubjectRepeatable::class)->button(__lit('base.item_add', ['item' => '']));
              });
            endif;
        });
        endif;

        $page->info('Informacja na dole strony (cookie)');
        $page->card(function ($form) {
            $form->boolean('info_bottom_cookie_active')->title('Info Dolne: Aktywne')->hint('Stan aktywności wyskakującej informacji.')->width(1/3);
            $form->input('info_bottom_cookie_title')->title('Info Dolne: Tytuł');
            $form->textarea('info_bottom_cookie_text')->title('Info Dolne: Treść');
            $form->input('info_bottom_cookie_accept')->title('Info Dolne: Przycisk');
        });

        $page->info('Info Modalne (cookie)');
        $page->card(function ($form) {
            $form->boolean('info_modal_cookie_active')->title('Info Modalne: Aktywne')->hint('Stan aktywności wyskakującego okna.')->width(1/3);
            $form->input('info_modal_cookie_title')->title('Info Modalne: Tytuł');
            $form->textarea('info_modal_cookie_text')->title('Info Modalne: Treść');
            $form->input('info_modal_cookie_accept')->title('Info Modalne: Przycisk');
        });

        $page->info('Info Modalne na stronie głównej');
        $page->card(function ($form) {
            $form->boolean('info_modal_active')->title('Info Modalne: Aktywne')->hint('Stan aktywności wyskakującego okna.')->width(1/3);
            $form->input('info_modal_title')->title('Info Modalne: Tytuł');
            $form->textarea('info_modal_text')->title('Info Modalne: Treść');
        });
    }
}
