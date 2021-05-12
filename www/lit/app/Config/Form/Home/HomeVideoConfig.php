<?php

namespace Lit\Config\Form\Home;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Home\HomeVideoController;

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
        return "home/home-video";
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
            if (config('site.options.home-video-has-responsive-sources')) {
                $form->file('video_mobile')->title('Video Mobile')->accept('video/mp4')->hint('opcjonalnie')->maxFiles(1);// ->accept(['video/*', 'image/*']); // maxFiles(1) must be 1 to work properly
                $form->file('video_desktop')->title('Video Desktop')->accept('video/mp4')->hint('opcjonalnie')->maxFiles(1);// ->accept(['video/*', 'image/*']); // maxFiles(1) must be 1 to work properly
            } else {
                $form->file('video')->title('Video')->accept('video/mp4')->maxFiles(1);// ->accept(['video/*', 'image/*']); // maxFiles(1) must be 1 to work properly
            }
            if (config('site.options.home-video-has-title')) {
                $form->input('title')->title('Tytuł')->placeholder('Tytuł')->hint('Tytuł');
            }
            $form->textarea('text')->title('Tekst')->placeholder('Treść')->hint('Treść');
            if (config('site.options.home-video-has-button')) {
                $form->input('label')->title('Przycisk')->type('text')->placeholder('Tekst na przycisku')->hint('Tekst na przycisku');
                $form->route('route')->collection('site-routes')->title('Wybierz stronę')->hint('wybierz stronę w systemie');
                $form->input('url')->type('text')->title('Adres URL')->placeholder('Adres url')->hint('lub wpisz adres url')->prepend('<i class="fas fa-link"></i>')->append('link')->width(12);
            }
        });
    }
}
