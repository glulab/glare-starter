<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Service providers.
     *
     * @var array
     */
    protected $providers = [
        // \App\Litstack\LitstackServiceProvider::class,
    ];

    /**
     * Aliases.
     *
     * @var array
     */
    protected $aliases = [
        //
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->alias();
        $this->providers();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \Illuminate\Database\Eloquent\Relations\Relation::morphMap([
        //     'post' => \App\Models\Post::class,
        //     'page' => \App\Models\Page::class,
        // ]);
    }

    /**
     * Register aliases.
     *
     * @return void
     */
    protected function alias()
    {
        $loader = AliasLoader::getInstance();

        foreach ($this->aliases as $alias => $class) {
            $loader->alias($alias, $class);
        }
    }

    /**
     * Register providers.
     *
     * @return void
     */
    protected function providers()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}
