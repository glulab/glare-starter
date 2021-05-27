<?php

namespace Glare\Litstack\View;

use Illuminate\Support\Facades\Request;
use Illuminate\Contracts\Foundation\Application;

class ShareViews
{

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function run()
    {
        // settngs, site
        $sharedViewValues = [];
        $sharedViewValues['settings'] = \Ignite\Support\Facades\Form::load('settings', 'settings');
        $sharedViewValues['site'] = \Ignite\Support\Facades\Form::load('settings', 'site');
        $sharedViewValues['theme'] = \Ignite\Support\Facades\Form::load('settings', 'theme');
        $sharedViewValues['context'] = \Ignite\Support\Facades\Form::load('settings', 'context');
        // TODO: Share app views
        \Illuminate\Support\Facades\View::share($sharedViewValues);

        // bind app('site-shared')
        $this->app->singleton('site-shared', function ($app) use ($sharedViewValues) {
            return $sharedViewValues;
        });
    }
}
