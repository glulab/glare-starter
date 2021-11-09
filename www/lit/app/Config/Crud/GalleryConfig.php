<?php

namespace Lit\Config\Crud;

use App\Models\Gallery;
use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudIndex;
use Illuminate\Support\Str;
use Ignite\Crud\Config\CrudConfig;
use Facades\Lit\Support\Config\LitConfigShow;
use Lit\Http\Controllers\Crud\GalleryController;
use Facades\Lit\Support\Config\LitConfigIndexTable;

class GalleryConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = Gallery::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = GalleryController::class;

    /**
     * Model singular and plural name.
     *
     * @param Gallery|null gallery
     * @return array
     */
    public function names(Gallery $gallery = null)
    {
        return [
            'singular' => ucfirst(__lit('models.gallery')),
            'plural' => ucfirst(__lit('models.galleries')),
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'galleries';
    }

    /**
     * Build index page.
     *
     * @param \Ignite\Crud\CrudIndex $page
     * @return void
     */
    public function index(CrudIndex $page)
    {
        $page->expand();

        $page->title('Galerie');

        $page->table(function ($table) {

            // LitConfigIndexTable::default($this, $table, '{images.0.conversion_urls.thumb}', ['id', 'title', /*'slug',*/ 'active']);
            
            LitConfigIndexTable::base($this, $table, '{images.0.conversion_urls.thumb}', ['id', 'title', /*'slug',*/ /* 'active' */]);
            LitConfigIndexTable::toggles($this, $table, ['show', 'active']);

        })
        ->sortByDefault('id.desc')
        ->sortBy([
            'id.desc' => __lit('crud.sort_new_to_old'),
            'id.asc' => __lit('crud.sort_old_to_new'),
        ])
        ->search('title')
        ->perPage(30)
        ;
    }

    /**
     * Setup show page.
     *
     * @param \Ignite\Crud\CrudShow $page
     * @return void
     */
    public function show(CrudShow $page)
    {
        $page->expand();

        $page
            ->info('Strona')
            ->text('Edycja')
        ;

        $page->card(function ($form) {

            $form->boolean('active')->title('Aktywna')->hint('Aktywna')->width(1/2);

        })->title('OPCJE');

        $page->card(function ($form) {

            $form->input('title')->title('Tytuł')->creationRules(['required'])->width(12);
            $form->input('slug')->title('Adres URL')->width(12);
            $form->textarea('description')->title('Opis')->width(12);

        })->title('ZAWARTOŚĆ');

        LitConfigShow::galleryImages($page, $name = 'images', $maxFiles = 1000, $ratio = null, $hint = null, $help = false, $zipUpload = true);
    }
}
