<?php

namespace Lit\Config\Crud;

use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\Config\CrudConfig;
use Illuminate\Support\Str;

use App\Models\Page;
use Lit\Http\Controllers\Crud\PageController;

class PageSystemConfig extends CrudConfig
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
        return 'system-pages';
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

        $page->title('Systemowe');

        $page->table(function ($table) {

            $table->col('ID')->value('{id}')->sortBy('id')->right()->small();
            $table->image('FOTO')->src('{images.0.conversion_urls.thumb}')->maxWidth('50px')->maxHeight('50px');
            $table->col('TYTUŁ')->value('{title}')->sortBy('title')->center();
            $table->col('URL')->value('{slug}')->sortBy('slug')->center()->class('small text-secondary');



            $table->toggle('sitemap')->label('SITEMAP')->routePrefix($this->routePrefix())->sortBy('sitemap');
            $table->toggle('active')->label('AKTYWNY')->routePrefix($this->routePrefix())->sortBy('active');








        })

        ->query(function($query) {
            $query->whereType('system');





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

        $page
            ->info('Strona systemowa')
            ->text('Edycja')
        ;

        $page->card(function($form) {


            // $form->input('position')->title('POZYCJA')->hint('Podczas tworzenia pozostaw puste')->width(1/3);
            $form->boolean('active')->title('AKTYWNA')->hint('Aktywna')->width(1/2);

        })->title('Opcje');

        $page->card(function($form) {

            $form->input('title')->title('TYTUŁ')->creationRules(['required'])->width(12);
            $form->input('slug')->title('URL')->width(12);

            $form->textarea('description')->title('OPIS')->width(12);
            $form->wysiwyg('text')->title('TREŚĆ')->width(12);

        })->title('Zawartość');

        $page->card(function($form) {

            $form->image('images')->title('FOTO')/*->expand()*//*->firstBig()*/->maxFiles(150);

        })->title('Foto');

        $page->card(function($form) {

            $form->input('meta_title')->title('SEO TYTUŁ')->hint('Tytuł SEO pod wyszukiwarki.')->width(12);
            $form->textarea('meta_description')->title('SEO OPIS')->hint('Opis SEO pod wyszukiwarki.')->width(12);

        })->title('SEO');

        $page->card(function($form) {

            $form->boolean('sitemap')->title('SITEMAP')->hint('Sitemap')->width(1/5);
            $form->select('sitemap_changefreq')->title('CZĘSTOTLIWOŚĆ')->options(\Facades\Lit\Support\LitSitemapHelper::changefreq())->hint('Wybierz częstotliwość modyfikacji')->width(2/5);
            $form->select('sitemap_priority')->title('PRIORYTET')->options(\Facades\Lit\Support\LitSitemapHelper::priority())->hint('Wybierz priorytet')->width(2/5);

        })->title('Sitemap');
    }
}
