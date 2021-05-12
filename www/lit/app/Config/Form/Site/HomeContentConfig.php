<?php

namespace Lit\Config\Form\Site;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Site\HomeContentController;

class HomeContentConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = HomeContentController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "site/home-content";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'HomeContent',
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

        $page->title('Home: Dodatki');

        $page->info('Treść na filmie');
        $page->card(function ($form) {
            $form->textarea('text')->title('Tekst')->placeholder('Treść')->hint('Treść');
        });

        $page->info('Ostatnia realizacja');
        $page->card(function ($form) {

            $form->input('custom_title')->type('text')->title('Tytuł sekcji')->placeholder('Tytuł sekcji')->hint('Tytuł sekcji "Ostatnia realizacja"');

        });

        $page->info('Ostatnia realizacja - własna treść');
        $page->card(function ($form) {

            $form->boolean('custom_active')->title('Aktywne')->hint('Zastąp sekcję "Ostatnia realizacja" własnym obrazkiem i teścią')->width(1/3);
            $form->image('custom_item_image')->title('Obraz')->hint('Obraz.')->maxFiles(1)->expand();
            $form->input('custom_item_title')->title('Tytuł')->placeholder('Tytuł')->hint('Tytuł pod zdjęciem.');
            $form->textarea('custom_item_text')->title('Tekst')->placeholder('Tekst')->hint('Tekst pod zdjęciem');
            $form->input('custom_item_link')->type('text')->title('Link')->placeholder('Adres url')->hint('Wprowadź adres url')->prepend('<i class="fas fa-link"></i>')->append('link')->width(12);

        });
    }
}
