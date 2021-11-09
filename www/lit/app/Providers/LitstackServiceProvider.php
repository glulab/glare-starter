<?php

namespace Lit\Providers;

use Illuminate\Support\ServiceProvider;

class LitstackServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(lit_resource_path('views'), 'lit');

        
        // \Ignite\Support\Facades\FormForm::registerField('file', FileField::class);
        
        $this->app->afterResolving('lit.form', function ($form) {
            $form->registerField('zipImage', \Lit\Fields\ZipImageField::class);
            app()->make(\Ignite\Crud\Api\ApiRepositories::class)->register('zipimage', \Lit\Repositories\ZipImageRepository::class);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
