<?php

namespace Lit\Config\Form\Site;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Site\HomeSliderController;

class HomeSliderConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = HomeSliderController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "site/home-slider";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'HomeSlider',
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
        $page->title('Slider');

        $page->info('Slider');
        $page->card(function ($form) {

            $form->block('slider')
                ->title('Slider')
                ->repeatables(
                    function ($repeatables) {

                        // Add as many repeatables as you want.
                        $repeatables->add(
                            'slide',
                            function ($form, $preview) {
                                // The block preview.
                                $preview->col('{title}');
                                $preview->col('<img src="{image.conversion_urls.thumb}">');
                                $preview->view('lit::columns.is-active');

                                $form->boolean('active')->title('Aktywny')->hint('Aktywny')->width(1/3);
                                $form->input('title')->title('Tytuł')->placeholder('Tytuł')->hint('Tytuł');
                                $form->textarea('text')->title('Tekst')->placeholder('Treść')->hint('Treść');
                                $form->image('image')->title('Obraz')->crop(1612 / 600)->hint('Obraz.')->maxFiles(1)->expand();
                                // $form->input('label')->title('Przycisk')->type('text')->placeholder('Tekst na przycisku')->hint('Tekst na przycisku');
                                $form->input('link')->title('Link')->type('text')->placeholder('Adres url')->hint('Wprowadź adres url')->prepend('<i class="fas fa-link"></i>')->append('link')->width(12);
                            }
                        )->button(__('Add'));
                    }
                );
            /*
            {!! $homeSlider->slider->pluck('url')->all() !!}
             */
        });

    }
}
