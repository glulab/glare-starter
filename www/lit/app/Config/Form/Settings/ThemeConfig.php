<?php

namespace Lit\Config\Form\Settings;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Settings\ThemeController;

class ThemeConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = ThemeController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "settings/theme";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'Theme',
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
        $page->expand();

        $page->title('Ustawienia: Specyficzne');

        $page->info('Ustawienia Strony');
        $page->card(function ($form) {
            
            // $form->input('theme_setting')->title('Theme Setting')->hint('Theme Setting Hint.');
            
        });

    }
}
