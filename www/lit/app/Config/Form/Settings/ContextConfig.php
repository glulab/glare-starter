<?php

namespace Lit\Config\Form\Settings;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Settings\ContextController;

class ContextConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = ContextController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return "settings/context";
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'Context',
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

            $form->input('pagination')->title('Paginacja')->type('number')->hint('Paginacja.');
            // $form->input('context_setting')->title('Context Setting')->hint('Context Setting Hint.');
            // $form->markdown(\Illuminate\Support\Facades\File::get(lit_resource_path('docs/form-loader-example.md')));
        });

    }
}
