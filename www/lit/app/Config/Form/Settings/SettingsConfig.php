<?php

namespace Lit\Config\Form\Settings;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Settings\SettingsController;

class SettingsConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = SettingsController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "settings/settings";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'Settings',
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

        $page->title('Ustawienia');

        $page->info('Informacje o stronie');
        $page->card(function ($form) {
            $form->input('site_domain')->title('Domena strony');

            $form->input('site_name')->title('Nazwa strony');
            $form->textarea('site_description')->title('Opis strony');

            $form->textarea('site_info')->title('Info o stronie');
        });

        $page->info('Informacje kontaktowe');
        $page->card(function ($form) {
            $form->input('site_email')->title('E-mail');
            $form->input('site_phone')->title('Telefon');
            $form->input('site_phone_1')->title('Telefon Stacjonarny');
            $form->textarea('site_contact_info')->title('Dodatkowe informacje kontaktowe');
        });

        $page->info('Informacje adresowe');
        $page->card(function ($form) {
            $form->input('site_address_name')->title('Adres: Nazwa');
            $form->textarea('site_address_description')->title('Adres: Opis');
            $form->input('site_address_full')->title('Adres: Ulica, nr, miasto');
            $form->input('site_address_street')->title('Adres: Ulica i nr');
            $form->input('site_address_code')->title('Adres: Kod');
            $form->input('site_address_city')->title('Adres: Miasto');
            $form->input('site_address_region')->title('Adres: Województwo');
            $form->textarea('site_address_info')->title('Dodatkowe informacje adresowe');
        });

        $page->info('Informacje firmowe');
        $page->card(function ($form) {
            $form->input('bank_name')->title('Bank: Nazwa');
            $form->input('bank_account')->title('Bank: Numer konta');
            $form->input('tax_number')->title('NIP');
            $form->input('company_id')->title('REGON');
            $form->input('national_court_register')->title('KRS');
        });

        $page->info('Informacje copyrights');
        $page->card(function ($form) {
            $form->input('site_copyrights_name')->title('Copyrights: Nazwa');
            $form->textarea('site_copyrights_info')->title('Copyrights: informacje');
        });

        $page->info('Mapa');
        $page->card(function ($form) {
            $form->textarea('map_iframe_src')->title('Mapa: iframe src');
        });

        $page->info('Formularz Kontaktowy');
        $page->card(function ($form) {
            $form->input('contact_form_emails')->title('Adresy e-mail do formularza kontaktowego')->hint('Oddzielone przecinkami adresy e-mail, na które majš być sysyłane wiadomości z formularza kontaktowego.');
            $form->input('contact_form_subject')->title('Formularz Kontaktowy: Temat');
            $form->input('contact_form_success')->title('Formularz Kontaktowy: Wiadomość po wysłaniu');
            $form->input('contact_form_danger')->title('Formularz Kontaktowy: Wiadomość w przypadku problemów z wysłaniem');
            $form->input('contact_form_errors')->title('Formularz Kontaktowy: Wiadomość przy błędach');
            $form->textarea('contact_form_consent')->title('Warunek')->hint('Treść warunku do zaakceptowania.');
        });

        $page->info('<div class="d-flex justify-content-between"><div>Linki kontaktowe</div><div>[<a target="_blank" href="https://fontawesome.com/icons?d=gallery&m=free">fontawesome</a>]</div></div>');
        $page->card(function ($form) {
            $form->block('contact_links')->title('Linki Kontaktowe')->hint('Po stworzeniu każdej pozycji naciśnij: Zapisz')->repeatables(function ($repeatables) {
                $repeatables->add(\Lit\Repeatables\LinkRepeatable::class)->button(__('Add')); // ->view('lit.blocks.contact_links', ['key' => 'class']);
            });
            /*
            {!! Helper::getFromCollection($settings->contact_links, 'twitter', 'class', 'url') !!}
            {!! $settings->contact_links->count() !!}
            {!! $settings->contact_links->all() !!}
            {!! $settings->contact_links->pluck('url', 'class')->get('twitter') !!}
            {!! $settings->contact_links->pluck('url', 'class')->all() !!}
             */
        });

        $page->info('<div class="d-flex justify-content-between"><div>Linki</div><div>[<a target="_blank" href="https://fontawesome.com/icons?d=gallery&m=free">fontawesome</a>]</div></div>');
        $page->card(function ($form) {
            $form->block('links')->title('Linki')->hint('Po stworzeniu każdej pozycji naciśnij: Zapisz')->repeatables(function ($repeatables) {
                $repeatables->add(\Lit\Repeatables\LinkRepeatable::class)->button(__('Add')); // ->view('lit.blocks.links', ['key' => 'class']);
            });
            /*
            {!! Helper::getFromCollection($settings->links, 'twitter', 'class', 'url') !!}
            {!! $settings->links->count() !!}
            {!! $settings->links->all() !!}
            {!! $settings->links->pluck('url', 'class')->get('twitter') !!}
            {!! $settings->links->pluck('url', 'class')->all() !!}
             */
        });

        $page->info('Header Extra Meta: Extra Tagi Meta.');
        $page->card(function ($form) {
            $form->block('header_metas')->title('Header Meta')->hint('Po stworzeniu każdej pozycji naciśnij: Zapisz')->repeatables(function ($repeatables) {
                $repeatables->add(\Lit\Repeatables\HeaderMetaRepeatable::class)->button(__('Add'));
            });
        });

        $page->info('Header Extra Script: Extra Skrypty.');
        $page->card(function ($form) {
            $form->block('header_extras')->title('Header Extra')->hint('Po stworzeniu każdej pozycji naciśnij: Zapisz')->repeatables(function ($repeatables) {
                $repeatables->add(\Lit\Repeatables\HeaderExtraRepeatable::class)->button(__('Add'));
            });
        });
    }
}
