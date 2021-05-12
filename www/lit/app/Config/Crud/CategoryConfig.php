<?php

namespace Lit\Config\Crud;

use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\Config\CrudConfig;
use Illuminate\Support\Str;

use App\Models\Category;
use Lit\Http\Controllers\Crud\CategoryController;

class CategoryConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = Category::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = CategoryController::class;

    /**
     * Model singular and plural name.
     *
     * @param Category|null category
     * @return array
     */
    public function names(Category $category = null)
    {
        return [
            'singular' => ucfirst(__lit('models.categories')),
            'plural' => ucfirst(__lit('models.category')),
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'categories';
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

        $page->title('Kategorie');

        $page->table(function ($table) {

            $table->col('ID')->value('{id}')->sortBy('id')->right()->small();
            $table->image('FOTO')->src('{images.0.conversion_urls.thumb}')->maxWidth('50px')->maxHeight('50px');
            $table->col('TYTUŁ')->value('{title}')->sortBy('title')->center();
            $table->col('URL')->value('{slug}')->sortBy('slug')->center()->class('small text-secondary');
            $table->col('POSTY')->value('{pages_count}')->sortBy('pages_count')->center();
            $table->col('TYP')->value('type', \Facades\Lit\Support\LitCategoryHelper::typeSelectOptions())->sortBy('type')->center()->class('small');
            $table->toggle('active')->label('AKTYWNY')->routePrefix($this->routePrefix())->sortBy('active');

        })

        ->query(function($query) {
            $query->withCount('pages');
        })

        ->sortByDefault('id.desc')

        ->sortBy([
            'id.desc' => __lit('crud.sort_new_to_old'),
            'id.asc' => __lit('crud.sort_old_to_new'),
        ])

        ->search('title')
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
            ->info('Kategoria')
            ->text('Edycja')
        ;

        $page->card(function($form) {

            $form->select('type')->title('TYP')->options(Category::typeSelectOptions())->hint('Wybierz typ katregorii')->width(1/2);
            $form->boolean('active')->title('Aktywna')->hint('Aktywna')->width(1/2);

        })->title('Opcje');

        $page->card(function($form) {

            $form->input('title')->title('TYTUŁ')->width(12);
            $form->input('slug')->title('URL')->width(12);

            $form->textarea('description')->title('OPIS')->width(12);
            $form->wysiwyg('text')->title('TREŚĆ')->width(12);

        })->title('Zawartość');

        $page->card(function($form) {

            $form->image('images')->title('FOTO')->firstBig()->maxFiles(150);

        })->title('Foto');

        $page->card(function($form) {

            $form->input('meta_title')->title('SEO TYTUŁ')->hint('Tytuł SEO pod wyszukiwarki.')->width(12);
            $form->textarea('meta_description')->title('SEO OPIS')->hint('Opis SEO pod wyszukiwarki.')->width(12);

        })->title('SEO');

        $page->card(function($form) {

            $form->relation('pages')
                ->title('Posty')
                ->filter(function($query) {
                    $query->whereType('post');
                })
                ->preview(function ($table) {
                    $table->col('{id}');
                    $table->col('{title}');
                })
            ;

        })->title('Relacje');
    }
}
