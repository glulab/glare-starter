<?php

namespace Lit\Config\Form\Site;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Site\HomeVideoController;

class HomeVideoConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = HomeVideoController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "site/home-video";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'HomeVideo',
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
            $form->file('video_mobile')->title('Video Mobile')->accept('video/mp4')->maxFiles(1);// ->accept(['video/*', 'image/*']); // maxFiles(1) must be 1 to work properly
            $form->file('video_desktop')->title('Video Desktop')->accept('video/mp4')->maxFiles(1);// ->accept(['video/*', 'image/*']); // maxFiles(1) must be 1 to work properly
            // $form->image('image')->title('Obraz')->hint('Obraz.')->maxFiles(1)->expand();
            // $form->input('label')->title('Przycisk')->type('text')->placeholder('Tekst na przycisku')->hint('Tekst na przycisku');
            // $form->input('link')->title('Link')->type('text')->placeholder('Adres url')->hint('Wprowadź adres url')->prepend('<i class="fas fa-link"></i>')->append('link')->width(12);
            // $form->markdown(\Illuminate\Support\Facades\File::get(fjord_path('resources/docs/form-loader-example.md')));
        });
    }
}
