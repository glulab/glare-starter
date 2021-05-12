<?php

namespace Lit\Config\Form\Home;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Home\HomeContentController;

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
        return "home/home-content";
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

        $page->info('');
        $page->card(function ($form) {
            // $form->title('title')->title('Tekst')->placeholder('Treść')->hint('Treść');
            $form->textarea('text')->title('Tekst')->placeholder('Treść')->hint('Treść');

            $form->block('facts')
                ->title('Fakty')
                ->repeatables(function($repeatables) {

                    // Add as many repeatables as you want.
                    $repeatables->add('fact', function($form, $preview) {
                        // The block preview.
                        $preview->col('{title}');
                        $preview->col('{text}');

                        // Containing as many form fields as you want.
                        $form->input('title')->title('Tytuł')->hint('Tytuł');
                        $form->textarea('text')->title('Tekst')->placeholder('Treść')->hint('Treść');
                    })->button(__('Add'));;
                });
        });

        // $page->info('');
        // $page->card(function ($form) {
        //     $form->textarea('text')->title('Tekst')->placeholder('Treść')->hint('Treść');
        // });
    }
}
