<?php

namespace Glare\Support\Site;

class Site
{
    public function hasService($service)
    {
        $configKey = 'site.services.';
        return !is_null(config($configKey . $service));
    }

    public function service($service)
    {
        $configKey = 'site.services.';
        return config($configKey . $service);
    }

    public function hasOption($option)
    {
        $configKey = 'site.options.';
        return !is_null(config($configKey . $option));
    }

    public function getService($option)
    {
        $configKey = 'site.options.';
        return config($configKey . $option);
    }

    public function shared($key = null)
    {
        if (is_null($key)) {
            return app('site-shared');
        }
        return app('site-shared')[$key];
    }

    public function contactFormHasSubjects()
    {
        $site = app('site-shared')['site'];

        if (empty(config('site.services.contact-form'))) {
            return false;
        }

        if (empty(config('site.options.contact-form-has-subject'))) {
            return false;
        }

        if (empty($site->contact_form_subjects)) {
            return false;
        }

        if ($site->contact_form_subjects->count() === 0) {
            return false;
        }

        return true;
    }
}
