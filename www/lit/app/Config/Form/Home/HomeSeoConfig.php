<?php

namespace Lit\Config\Form\Home;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Home\HomeSeoController;

class HomeSeoConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = HomeSeoController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "home/home-seo";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'HomeSeo',
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
        $page->card(function ($form) {
            $form->input('meta_title')->title('SEO TYTUŁ')->hint('Tytuł SEO pod wyszukiwarki.')->width(12);
            $form->textarea('meta_description')->title('SEO OPIS')->hint('Opis SEO pod wyszukiwarki.')->width(12);
        })->title('SEO');

        $page->card(function ($form) {
            $form->image('seo_image')->title('SEO Obrazek')->hint('Obrazek pod SEO. [1200 x 630]')->maxFiles(1)->expand();
        })->title('SEO Obrazek');
    }
}
