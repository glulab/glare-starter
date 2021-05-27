<?php

namespace Lit\Config\Crud;

use App\Models\Page;
use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudIndex;
use Illuminate\Support\Str;
use Ignite\Crud\Config\CrudConfig;
use Lit\Http\Controllers\Crud\PageController;
use Facades\Lit\Support\Config\LitConfigShow;
use Facades\Lit\Support\Helpers\LitPageHelper;
use Facades\Lit\Support\Config\LitConfigIndexTable;

class PagePostConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = Page::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = PageController::class;

    /**
     * Model singular and plural name.
     *
     * @param Page|null page
     * @return array
     */
    public function names(Page $page = null)
    {
        return [
            'singular' => ucfirst(__lit('models.page')),
            'plural' => ucfirst(__lit('models.pages')),
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'post-pages';
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

        $page->title('Posty');

        $page->table(function ($table) {

            LitConfigIndexTable::pageBase($this, $table, '{backimage.conversion_urls.thumb}');

            LitConfigIndexTable::relationCategories($this, $table, '{categories.#.title}');
            LitConfigIndexTable::relationGroups($this, $table, '{groups.#.name}');

            LitConfigIndexTable::position($this, $table, true);

            LitConfigIndexTable::pageToggles($this, $table);

            $table->actions(array_replace_recursive(LitConfigIndexTable::pagePositionActions()));
        })

        ->query(function($query) {
            $query->whereType('post');

            $query->with('categories');
            // $query->with('groups.products');
            $query->withCount('categories');
            $query->withCount('groups');
        })

        ->sortByDefault('position.asc')

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

        $page->view('lit::forms.hide-near-items');

        LitConfigShow::preview($page);

        $page
            ->info('Post')
            ->text('Edycja')
        ;

        $page->card(function($form) {


            $form->input('position')->title('Pozycja')->hint('Podczas tworzenia pozostaw puste')->width(1/3);
            $form->boolean('active')->title('Aktywna')->hint('Aktywna')->width(1/3);

        })->title('OPCJE');

        LitConfigShow::pageDescription($page);

        LitConfigShow::pageContent($page);

        LitConfigShow::images($page);

        LitConfigShow::blockPhotoLinks($page);

        LitConfigShow::relationGalleries($page);

        LitConfigShow::banners($page);

        LitConfigShow::seo($page);

        LitConfigShow::sitemap($page);

        LitConfigShow::relationCategories($page, 'post');
    }
}
