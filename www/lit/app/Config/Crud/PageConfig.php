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

class PageConfig extends CrudConfig
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
        return 'pages';
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

        $page->title('Strony');

        $page->table(function ($table) {

            LitConfigIndexTable::pageBase($this, $table, '{backimage.conversion_urls.thumb}');

            LitConfigIndexTable::pageRoute($this, $table);

            LitConfigIndexTable::relationGalleries($this, $table, '{galleries.#.title}');

            LitConfigIndexTable::pageToggles($this, $table);








        })

        ->query(function($query) {
            $query->whereType('page');
            $query->with(['galleries' => function ($wq) {
                $wq->select(['galleries.id', 'galleries.title']);
            }]);




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

        $page->view('lit::forms.hide-near-items');

        LitConfigShow::preview($page);

        $page
            ->info('Strona')
            ->text('Edycja')
        ;

        $page->card(function($form) {

            $form->select('route')->title('Funkcja')->options(LitPageHelper::routeSelectOptions())->hint('Wybierz funkcję strony lub pozostaw puste jeżeli to zwykła strona')->width(1/2);
            // $form->input('position')->title('Pozycja')->hint('Podczas tworzenia pozostaw puste')->width(1/3);
            $form->boolean('active')->title('Aktywna')->hint('Aktywna')->width(1/2);

        })->title('OPCJE');

        LitConfigShow::pageDescription($page);

        LitConfigShow::pageContent($page);

        LitConfigShow::images($page);

        LitConfigShow::blockPhotoLinks($page);

        LitConfigShow::relationGalleries($page);

        LitConfigShow::banners($page);

        LitConfigShow::seo($page);

        LitConfigShow::sitemap($page);
    }
}
