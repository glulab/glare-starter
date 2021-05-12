<?php

namespace Lit\Config\Form\Home;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Home\HomeGalleryController;

class HomeGalleryConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = HomeGalleryController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "home/home-gallery";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'HomeGallery',
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

        $page->title('Home: Galeria');

        $page->info('Galeria');
        $page->card(function ($form) {
            $form->manyRelation('galleries')
                ->title('Galerie')
                ->model(\App\Models\Gallery::class)
                ->preview(function ($table) {
                    $table->col('{id}');
                    $table->image()->src('{images.0.conversion_urls.thumb}')->maxWidth('50px')->maxHeight('50px');
                    $table->col('{title}');
                    $table->col('{pivot.position}');
                })
                ->sortable();
        });
    }
}
