<?php

namespace Lit\Config\Form\Menu;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Menu\MenuMainController;

class MenuMainConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = MenuMainController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "menu/menu-main";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'MenuMain',
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
        $page->title('Menu Główne');

        $page->info('Menu Główne');
        $page->card(function($form) {

            $form->list('menu_main')->title('Menu Główne')->maxDepth(2)->previewTitle('{title} {state}')->form(function ($form) {
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

                $form->select('state')
                    ->title('STAN')
                    ->options([
                        '' => 'WŁĄCZONE',
                        'inactive' => 'WYŁĄCZONE',
                    ])
                    ->placeholder('WŁĄCZONE')
                    ->hint('stan pozycji menu.');
            });
        });
    }
}
