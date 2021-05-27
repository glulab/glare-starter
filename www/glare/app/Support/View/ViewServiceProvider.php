<?php

namespace Glare\Support\View;

use Glare\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        // $this->app->make(ShareViews::class)->run(); --> in middleware
        $this->app->make(ComposeViews::class)->run();
    }
}
