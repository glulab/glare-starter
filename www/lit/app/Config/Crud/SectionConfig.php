<?php

namespace Lit\Config\Crud;

use App\Models\Section;
use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudIndex;
use Illuminate\Support\Str;
use Ignite\Crud\Config\CrudConfig;
use Facades\Lit\Support\Config\LitConfigShow;
use Lit\Http\Controllers\Crud\SectionController;
use Facades\Lit\Support\Helpers\LitSectionHelper;
use Facades\Lit\Support\Config\LitConfigIndexTable;

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

            LitConfigIndexTable::base($this, $table, '' /*'{images.0.conversion_urls.thumb}'*/, ['id', 'title']);

            $table->col('TYP')->value('{type}')->sortBy('type')->center();
            $table->col('LOKACJA')->value('{location}')->sortBy('location')->center();

            LitConfigIndexTable::position($this, $table, true);

            LitConfigIndexTable::toggles($this, $table);

           $table->actions(array_replace_recursive(LitConfigIndexTable::sectionPositionActions()));

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

            $form->select('type')->title('Typ')->options(LitSectionHelper::typeSelectOptions())->hint('Wybierz typ sekcji')->creationRules(['required'])->updateRules(['nullable'])->width(1/4);
            $form->select('location')->title('Lokacja')->options(LitSectionHelper::locationSelectOptions())->hint('Wybierz lokację sekcji')->creationRules(['required'])->updateRules(['nullable'])->width(1/4);
            $form->input('position')->title('Pozycja')->hint('Podczas tworzenia pozostaw puste')->width(1/4);
            $form->boolean('active')->title('Aktywna')->hint('Aktywna')->width(1/4);

        })->title('OPCJE');

        LitConfigShow::sectionContent($page);

        LitConfigShow::images($page);
    }
}
