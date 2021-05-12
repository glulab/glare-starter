<?php

namespace Lit\Config\Form\Menu;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Menu\MenuFooterController;

class MenuFooterConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = MenuFooterController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "menu/menu-footer";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'MenuFooter',
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
        $page->title('Menu Stopka');

        $page->info('Menu Stopka');
        $page->card(function($form) {

            $form->list('menu_footer')->title('Menu Stopka')->maxDepth(2)->previewTitle('{title}')->form(function ($form) {
                $form->input('title')->title('TYTUŁ')->hint('tytuł pozycji menu');

                $form->route('route')->collection('site-routes')->title('WYBIERZ STRONĘ')->hint('wybierz stronę w systemie');

                $form->input('url')->title('ADRES URL')->hint('lub wpisz adres url');

                $form->checkboxes('target')
                    ->title('NOWE OKNO')
                    ->options([
                        '_blank' => 'Nowe okno',
                    ])
                    ->hint('- działa tylko na adresy w tej samej domenie.<br>- adresy z domen zewnętrznych automatycznie otwierane sa w nowym oknie.')
                    ->stacked()
                ;

                // $form->boolean('active')->title('Aktywny');
            });
        });
    }
}
