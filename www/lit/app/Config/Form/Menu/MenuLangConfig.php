<?php

namespace Lit\Config\Form\Menu;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Menu\MenuLangController;

class MenuLangConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = MenuLangController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "menu/menu-lang";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'MenuLang',
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
        $page->title('Menu Językowe');

        $page->info('Menu Językowe');
        $page->card(function($form) {

            $form->list('menu_lang')->title('Menu Językowe')->maxDepth(2)->previewTitle('{title}')->form(function ($form) {
                $form->input('title')->title('TYTUŁ')->hint('tytuł pozycji menu');

                $form->route('route')->collection('site-routes')->title('WYBIERZ STRONĘ')->hint('wybierz stronę w systemie');

                $form->input('url')->title('ADRES URL')->hint('lub wpisz adres url');

                $form->input('lang')->title('JĘZYK')->hint('język');

                // $form->checkboxes('target')
                //     ->title('NOWE OKNO')
                //     ->options([
                //         '_blank' => 'Nowe okno',
                //     ])
                //     ->hint('- działa tylko na adresy w tej samej domenie.<br>- adresy z domen zewnętrznych automatycznie otwierane sa w nowym oknie.')
                //     ->stacked()
                // ;

                // $form->boolean('active')->title('Aktywny');
            });
        });
    }
}
