<?php

namespace Lit\Config\Form\Site;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Site\HomePhotoLinksController;

class HomePhotoLinksConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = HomePhotoLinksController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "site/home-photo-links";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'HomePhotoLinks',
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

        $page->title('Home: Przyciski');

        $page->info('Przyciski');
        $page->card(function ($form) {

            $form->block('photo_links')
                ->title('Przyciski')
                ->repeatables(
                    function ($repeatables) {
                        $repeatables->add(\Lit\Repeatables\PhotoLinkRepeatable::class)->button(__('Add'));
                    }
                );
        });
    }
}
