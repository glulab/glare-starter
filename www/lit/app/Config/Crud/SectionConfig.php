<?php

namespace Lit\Config\Crud;

use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\Config\CrudConfig;
use Illuminate\Support\Str;

use App\Models\Section;
use Lit\Http\Controllers\Crud\SectionController;

class SectionConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = Section::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = SectionController::class;

    /**
     * Model singular and plural name.
     *
     * @param Section|null section
     * @return array
     */
    public function names(Section $section = null)
    {
        return [
            'singular' => ucfirst(__lit('models.section')),
            'plural' => ucfirst(__lit('models.sections')),
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'sections';
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

        $page->title('Sekcje');

        $page->table(function ($table) {

            $table->col('ID')->value('{id}')->sortBy('id')->right()->small();
            // $table->image('FOTO')->src('{images.0.conversion_urls.thumb}')->maxWidth('50px')->maxHeight('50px');
            $table->col('TYTUŁ')->value('{title}')->sortBy('title')->center();
            $table->col('TYP')->value('{type}')->sortBy('type')->center();
            $table->col('LOKACJA')->value('{location}')->sortBy('location')->center();
            $table->col('POZYCJA')->value('{position}')->sortBy('position')->center();

            $table->toggle('active')->label('AKTYWNY')->routePrefix($this->routePrefix())->sortBy('active');

           $table->actions([
               '↑ PIERWSZY' => \Lit\Actions\Section\MoveUpFirst::class,
               '↑ 10' => \Lit\Actions\Section\MoveUpTen::class,
               '↑' => \Lit\Actions\Section\MoveUpOne::class,
               '↓' => \Lit\Actions\Section\MoveDownOne::class,
               '↓ 10' => \Lit\Actions\Section\MoveDownTen::class,
               '↓ OSTATNI' => \Lit\Actions\Section\MoveDownLast::class,
           ]);

        })

        ->query(function($query) {
            $query->whereType('home');
            $query->orderBy('type');
            $query->orderBy('location', 'desc');
            $query->orderBy('position');
        })

        // ->sortByDefault('position.asc')

        // ->sortBy([
        //     'id.desc' => __lit('crud.sort_new_to_old'),
        //     'id.asc' => __lit('crud.sort_old_to_new'),
        // ])

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
            ->info('Sekcja')
            ->text('Edycja')
        ;

        $page->card(function($form) {

            $form->select('type')->title('TYP')->options(\Facades\Lit\Support\LitSectionHelper::typeSelectOptions())->hint('Wybierz typ sekcji')->creationRules(['required'])->updateRules(['nullable'])->width(1/4);
            $form->select('location')->title('Lokacja')->options(\Facades\Lit\Support\LitSectionHelper::locationSelectOptions())->hint('Wybierz lokację sekcji')->creationRules(['required'])->updateRules(['nullable'])->width(1/4);
            $form->input('position')->title('POZYCJA')->hint('Podczas tworzenia pozostaw puste')->width(1/4);
            $form->boolean('active')->title('Aktywna')->hint('Aktywna')->width(1/4);

        })->title('Opcje');

        $page->card(function($form) {

            $form->input('title')->title('TYTUŁ')->width(12);
            $form->wysiwyg('text')->title('TREŚĆ')->width(12);

        })->title('Zawartość');

        $page->card(function($form) {

            $form->image('images')->title('FOTO')->firstBig()->maxFiles(150);

        })->title('Foto');
    }
}
