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

        $page->title('Ustawienia: Treści');

        $page->info('Formularz Kontaktowy');
        $page->card(function ($form) {
            $form->input('contact_form_title')->title('Formularz Kontaktowy: Tytuł');
            $form->textarea('contact_form_text')->title('Formularz Kontaktowy: Treść');
        });

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
