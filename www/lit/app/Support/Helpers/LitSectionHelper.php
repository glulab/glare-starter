<?php

namespace Lit\Support\Helpers;

class LitSectionHelper extends LitHelper
{
    public function __construct()
    {

    }

    public function typeSelectOptions($decorate = null)
    {
        $collection = config('site.config.select-options.section-types');
        $translatePrefix = 'site/models/section.types';

        // $decorate = '<span class="badge badge-secondary">{option}</span>';
        $options = [
            null => '-',
        ];
        foreach ($collection as $option) {
            if (!is_null($decorate)) {
                $options[$option] = str_replace('{option}', __("$translatePrefix.$option"), $decorate);
            } else {
                $options[$option] = __("$translatePrefix.$option");
            }
        }
        return $options;
    }

    public function locationSelectOptions($decorate = null)
    {
        $collection = config('site.config.select-options.section-locations');
        $translatePrefix = 'site/models/section.locations';

        // $decorate = '<span class="badge badge-secondary">{option}</span>';
        $options = [
            null => '-',
        ];
        foreach ($collection as $option) {
            if (!is_null($decorate)) {
                $options[$option] = str_replace('{option}', __("$translatePrefix.$option"), $decorate);
            } else {
                $options[$option] = __("$translatePrefix.$option");
            }
        }
        return $options;
    }
}
