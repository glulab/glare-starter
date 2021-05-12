<?php

namespace Lit\Config\Form\Menu;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Menu\MenuOfferController;

class MenuOfferConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = MenuOfferController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "menu/menu-offer";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'MenuOffer',
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
        $page->title('Menu Oferta');

        $page->info('Menu Oferta');
        $page->card(function($form) {

            $form->list('menu_offer')->title('Menu Oferta')->maxDepth(3)->previewTitle('{title}')->form(function ($form) {
                $form->input('title')->title('Tytuł');

                $form->select('option1')->title('Opcja 2')->options([
                    'all' => 'wszystkie',
                    'value1' => 'Wartość1',
                    'value2' => 'Wartość2',
                ])->hint('Wybierz Opcję 1.');

                $form->select('option2')->title('Opcja 2')->options([
                    'all' => 'wszystkie',
                    'value1' => 'Wartość1',
                    'value2' => 'Wartość2',
                ])->hint('Wybierz Opcję 2.');

                // $form->select('category_id')->title('Kategoria')
                //     ->options(
                //         \App\Models\Category::whereActive(true)->get()->mapWithKeys(function($item, $key){
                //             return [$item->id => $item->title];
                //         })->toArray()
                //     )
                //     ->hint('Wybierz Kategorię.');

                // $form->boolean('active')->title('Aktywny');

            });
        });
    }
}
