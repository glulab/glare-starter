<?php

namespace Lit\Config\Form\Home;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Home\HomeBannerController;

class HomeBannerConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = HomeBannerController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "home/home-banner";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'HomeBanner',
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
        $page->card(function($form) {
            $form->boolean('active')->title('Aktywny')->hint('Aktywny')->width(1/3);
            $form->image('image')->title('Obraz')->crop(config('site.config.ratios.home-banner'))->hint('Obraz.')->maxFiles(1)->expand();
            if (config('site.options.home-banner-has-title')) {
                $form->input('title')->title('Tytuł')->placeholder('Tytuł')->hint('Tytuł');
            }
            $form->textarea('text')->title('Tekst')->placeholder('Treść')->hint('Treść');
            if (config('site.options.home-banner-has-button')) {
                $form->input('label')->title('Przycisk')->type('text')->placeholder('Tekst na przycisku')->hint('Tekst na przycisku');
                $form->route('route')->collection('site-routes')->title('Wybierz stronę')->hint('wybierz stronę w systemie');
                $form->input('url')->type('text')->title('Adres URL')->placeholder('Adres url')->hint('lub wpisz adres url')->prepend('<i class="fas fa-link"></i>')->append('link')->width(12);
            }
        });
    }
}
