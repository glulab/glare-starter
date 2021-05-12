<?php

namespace Lit\Config\Crud;

use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\Config\CrudConfig;
use Illuminate\Support\Str;

use App\Models\Page;
use Lit\Http\Controllers\Crud\PageController;

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

            $table->col('ID')->value('{id}')->sortBy('id')->right()->small();
            $table->image('FOTO')->src('{images.0.conversion_urls.thumb}')->maxWidth('50px')->maxHeight('50px');
            $table->col('TYTUŁ')->value('{title}')->sortBy('title')->center();
            $table->col('URL')->value('{slug}')->sortBy('slug')->center()->class('small text-secondary');
            $table->col('FUNKCJA')->value('route', \Facades\Lit\Support\LitPageHelper::routeSelectOptionsDecorated())->sortBy('route')->center()->class('small');


            $table->toggle('sitemap')->label('SITEMAP')->routePrefix($this->routePrefix())->sortBy('sitemap');
            $table->toggle('active')->label('AKTYWNY')->routePrefix($this->routePrefix())->sortBy('active');








        })

        ->query(function($query) {
            $query->whereType('page');





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
            ->info('Strona')
            ->text('Edycja')
        ;

        $page->card(function($form) {

            $form->select('route')->title('FUNKCJA')->options(\Facades\Lit\Support\LitPageHelper::routeSelectOptions())->hint('Wybierz funkcję strony lub pozostaw puste jeżeli to zwykła strona')->width(1/2);
            // $form->input('position')->title('POZYCJA')->hint('Podczas tworzenia pozostaw puste')->width(1/3);
            $form->boolean('active')->title('Aktywna')->hint('Aktywna')->width(1/2);

        })->title('Opcje');

        $page->card(function($form) {

            $form->input('title')->title('TYTUŁ')->creationRules(['required'])->width(12);
            $form->input('slug')->title('URL')->width(12);

            $form->textarea('description')->title('OPIS')->width(12);
            $form->wysiwyg('text')->title('TREŚĆ')->width(12)
                ->hint('<br>
                    KODY WYWOŁANIA: (Wklej jako zwykły tekst Ctrl + Shift + V)<br><br>
                    [HR] - pozioma linia<br>
                    <br>
                    BLOKI:<br>
                    [BLOCK]<br>
                    To jest treść paragrafu [H2]to jest ukryty nagłówek h2[/H2].<br>
                    [/BLOCK]<br>
                    <br>
                    KOLUMNY:<br>
                    [COL.1]<br>
                    Kolumna nr 1<br>
                    [COL.2]<br>
                    Kolumna nr 2<br>
                    [/COL]<br>
                    <br>
                    KOLUMNY:<br>
                    [COL.LEFT]<br>
                    Kolumna lewa<br>
                    [COL.RIGHT]<br>
                    Kolumna prawa<br>
                    [/COL]<br>
                    <br>
                    KOLUMNY BOOTSTRAP (SUMA = 12):<br>
                    [COL.START.2]<br>
                    Kolumna szerokość: 2<br>
                    [COL.NEXT.5]<br>
                    Kolumna szerokość: 5<br>
                    [COL.NEXT.5]<br>
                    Kolumna szerokość: 5<br>
                    [/COL]<br>
                    <br>
                    ')
            ;

        })->title('Zawartość');

        $page->card(function($form) {

            $form->image('images')->title('ZDJĘCIA')/*->expand()*//*->firstBig()*/->maxFiles(150)
                ->hint('<br>
                    KODY WYWOŁANIA: (Wklej jako zwykły tekst Ctrl + Shift + V)<br><br>
                    [GALLERY] - galeria<br>
                    [IMAGES] - wszystkie zdjęcia<br>
                    [IMAGE.1] lub [IMG.1] - zdjęcie nr 1<br>
                    [IMAGE.2] lub [IMG.2] - zdjęcie nr 2<br>
                    [IMAGE.1..L..1/3] - zdjęcie nr 1 lewa krawędź 1/3 szerokości<br>
                    [IMAGE.2..C..1/2] - zdjęcie nr 2 centrowany 1/2 szerokości<br>
                    [IMAGE.3..R..1/3] - zdjęcie nr 3 prawa krawędź 1/3 szerokości<br>
                    [IMAGE.1..1/3][IMAGE.2..1/3][IMAGE.3..1/3] - trzy zdjęcia w rzędzie metoda 1<br>
                    [IMAGES..3][IMG.1][IMG.2][IMG.3][/IMAGES] -  trzy zdjęcia w rzędzie metoda 2<br>
                ')
            ;

        })->title('Zdjęcia');

        $page->card(function ($form) {

            $form->block('photo_links')
                ->title('Przyciski')
                ->repeatables(
                    function ($repeatables) {
                        $repeatables->add(\Lit\Repeatables\PhotoLinkRepeatable::class)->button(__('Add'));
                    }
                )->hint('<br>KODY WYWOŁANIA: (Wklej jako zwykły tekst Ctrl + Shift + V)<br><br>[BUTTONS]');

        })->title('Przyciski');

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
