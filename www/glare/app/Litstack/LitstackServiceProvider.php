<?php

namespace Glare\Litstack;

use Glare\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\AliasLoader;

class LitstackServiceProvider extends ServiceProvider
{
    /**
     * Providers.
     *
     * @var array
     */
    protected $providers = [
        \Glare\Litstack\Macros\MacrosServiceProvider::class,
        \Glare\Litstack\Routes\RouteServiceProvider::class,
        \Glare\Litstack\View\ViewServiceProvider::class,
    ];

    /**
     * Aliases.
     *
     * @var array
     */
    protected $aliases = [
        'LitSettings'     => \Facades\Glare\Litstack\Settings\Settings::class,
        'LitMenu'     => \Facades\Glare\Litstack\Menu\Menu::class,
    ];

    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $this->alias(true);
        $this->providers();
    }

    /**
     * Boot application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addViewLocationsAndNamespaces();

        $this->doPublishes();

        // \Ignite\Support\Facades\Lang::addPath(base_path() . '/vendor/litstack/lang/src');

        $this->middlewares();
    }

    /**
     * Register middlewares
     *
     * @return [type] [description]
     */
    public function middlewares()
    {
        // Glare/Boot is called earlier than Litstack/Boot so we need to share views in a global middleware
        // $this->app->make(\Illuminate\Contracts\Http\Kernel::class)->pushMiddleware(\Glare\Litstack\Middleware\ShareViews::class);
        $this->app->make(\Illuminate\Contracts\Http\Kernel::class)->appendMiddlewareToGroup('web', \Glare\Litstack\Middleware\ShareViews::class);
        // $this->app->make('router')->pushMiddlewareToGroup('web', \Glare\Litstack\Middleware\ShareViews::class);
    }

    /**
     * [addViewLocationsAndNamespaces description]
     *
     * * @return [type] [description]
     */
    public function addViewLocationsAndNamespaces()
    {
        \View::getFinder()->prependNamespace('litstack', resource_path('views-default/vendor/litstack'));
        \View::getFinder()->prependNamespace('litstack', resource_path('views/vendor/litstack'));
    }

    /**
     * [doPublishes description]
     *
     * @return [type] [description]
     */
    public function doPublishes()
    {
        // lit lang
        // $this->publishes([__DIR__ . '/../../publish-lit/lit/resources/lang' => base_path('lit/resources/lang')], 'glare:lit:lang');

        // litstack views override
        // $this->publishes([__DIR__ . '/../../publish-litstack/resources/views/vendor' => resource_path('views/vendor')], 'glare:litstack-views');
    }
}
