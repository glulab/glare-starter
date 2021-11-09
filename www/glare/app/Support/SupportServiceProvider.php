<?php

namespace Glare\Support;

use Glare\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class SupportServiceProvider extends ServiceProvider
{
    /**
     * Providers.
     *
     * @var array
     */
    protected $providers = [
        Config\ConfigServiceProvider::class,
        Macros\MacrosServiceProvider::class,
        Locator\LocaleServiceProvider::class,
        View\ViewServiceProvider::class,
    ];

    /**
     * Aliases.
     *
     * @var array
     */
    protected $aliases = [
        'Site'       => \Facades\Glare\Support\Site\Site::class,
        'Locator'    => \Facades\Glare\Support\Locator\Locator::class,
        'Logger'     => \Facades\Glare\Support\Logger\Logger::class,
        'Helper'     => \Facades\Glare\Support\Helpers\Helper::class,
        'ViewHelper' => \Facades\Glare\Support\Helpers\ViewHelper::class,
        'DiskHelper' => \Facades\Glare\Support\Helpers\DiskHelper::class,
        'CollectionHelper' => \Facades\Glare\Support\Helpers\CollectionHelper::class,
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
        $this->middlewares();
    }

    /**
     * Register middlewares
     *
     * @return [type] [description]
     */
    public function middlewares()
    {
        // Glare/Boot is called earlier than Support/Boot so we need to share views in a global middleware
        // $this->app->make(\Illuminate\Contracts\Http\Kernel::class)->pushMiddleware(\Glare\Support\Middleware\ShareViews::class);
        $this->app->make(\Illuminate\Contracts\Http\Kernel::class)->appendMiddlewareToGroup('web', \Glare\Support\Middleware\ShareViews::class);
        // $this->app->make('router')->pushMiddlewareToGroup('web', \Glare\Support\Middleware\ShareViews::class);

        // $this->app['router']->prependMiddlewareToGroup('web', \Glare\Http\Middleware\Glare::class);
        // $this->app['router']->pushMiddlewareToGroup('web', \Glare\Http\Middleware\Glare::class);
        // $this->app['router']->aliasMiddleware('middleware.name', \Glare\Http\Middleware\Glare::class);
        // dd($this->app['router']->getMiddleware());
    }
}
