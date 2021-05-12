<?php

namespace Lit\Config\Form\Site;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Site\HomeBannerController;

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
        return "site/home-banner";
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
            // $form->input('title')->title('Tytuł');
            // $form->input('text')->title('Tekst')->placeholder('Treść')->hint('Treść');
            $form->textarea('text')->title('Tekst')->placeholder('Treść')->hint('Treść');
            $form->image('image')->title('Obraz')/*->crop(1920 / 588)*/->hint('Obraz.')->maxFiles(1)->expand();
            // $form->input('label')->title('Przycisk')->type('text')->placeholder('Tekst na przycisku')->hint('Tekst na przycisku');
            $form->input('link')->title('Link')->type('text')->placeholder('Adres url')->hint('Wprowadź adres url')->prepend('<i class="fas fa-link"></i>')->append('link')->width(12);
            // $form->markdown(\Illuminate\Support\Facades\File::get(fjord_path('resources/docs/form-loader-example.md')));
        });
    }
}
