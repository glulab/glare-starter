<?php

namespace Lit\Config\Crud;

use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\Config\CrudConfig;
use Illuminate\Support\Str;

use App\Models\Page;
use Lit\Http\Controllers\Crud\PageController;

class PageOfferConfig extends CrudConfig
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
        return 'offer-pages';
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

        $page->title('Oferty');

        $page->table(function ($table) {

            $table->col('ID')->value('{id}')->sortBy('id')->right()->small();
            // $table->image('FOTO')->src('{groups.0.products.0.pictures.0.conversion_urls.thumb}')->maxWidth('50px')->maxHeight('50px');
            $table->col('TYTUŁ')->value('{title}')->sortBy('title')->center();
            $table->col('URL')->value('{slug}')->sortBy('slug')->center()->class('small text-secondary');
            $table->view('lit::columns.page.options');
            $table->col('GRUPA')->value(\Facades\Lit\Support\LitPageHelper::badgeLight('{groups.#.name}'))/*->sortBy('groups_count')*/->center()->class('small'); // $table->col('GRUPY')->value('{groups_count}')->sortBy('groups_count')->center(); // $table->col('GRUPY')->value('{groups_count}')->sortBy('groups_count')->center(); // $table->col('GRUPA')->value('{groups.0.name}'); // $table->relation('groups.0', GroupConfig::class)->value('{groups.0.name}')->sortBy('groups.0.name');
            $table->field('POZYCJA')->input('position'); // $table->col('POZYCJA')->value('{position}')->sortBy('position')->center();
            $table->toggle('sitemap')->label('SITEMAP')->routePrefix($this->routePrefix())->sortBy('sitemap');
            $table->toggle('active')->label('AKTYWNY')->routePrefix($this->routePrefix())->sortBy('active');
            $table->actions([
                '↑ PIERWSZY' => \Lit\Actions\Page\MoveUpFirst::class,
                '↑ 10' => \Lit\Actions\Page\MoveUpTen::class,
                '↑' => \Lit\Actions\Page\MoveUpOne::class,
                '↓' => \Lit\Actions\Page\MoveDownOne::class,
                '↓ 10' => \Lit\Actions\Page\MoveDownTen::class,
                '↓ OSTATNI' => \Lit\Actions\Page\MoveDownLast::class,
            ]);
        })

        ->query(function($query) {
            $query->whereType('offer');

            $query->with('groups');
            // $query->with('groups.products');
            // $query->withCount('groups');

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

        $page
            ->info('Oferta')
            ->text('Edycja')
        ;

        $page->card(function($form) {

            $form->checkboxes('options')->title('WIDOCZNOŚĆ')->options(['show-on-home' => 'Strona: Główna', 'show-on-offer' => 'Strona: Oferta', ])->hint('Wybierz strony na których oferta będzie linkowana')->stacked()->width(4);
            $form->input('position')->title('POZYCJA')->hint('Podczas tworzenia pozostaw puste')->width(3);
            $form->boolean('active')->title('AKTYWNA')->hint('Aktywna')->width(2);

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

        $page->card(function($form) {

            $form->relation('groups')
                ->title('Grupy')
                ->query(function($query) {
                    $query->with('products');
                })
                ->filter(function($query) {
                    $query->where(function ($q) {
                        $q->where('id_parent', 9);
                        $q->orWhere('id_parent', 3);
                    });
                })
                ->preview(function ($table) {
                    $table->col('{id}');
                    $table->image()->src('{products.0.pictures.0.conversion_urls.thumb}')->maxWidth('50px')->maxHeight('50px');
                    $table->col('{name}');
                })
            ;

        })->title('Relacje: Grupy Ofertowe');
    }
}
