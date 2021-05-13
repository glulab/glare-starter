<?php

namespace Lit\Support;

class LitSectionHelper extends LitHelper
{
    public function __construct()
    {

    }

    public function typeSelectOptions()
    {
        return [
            'home' => __('site/models/section.types.home'),
        ];
    }

    public function locationSelectOptions()
    {
        return [
            'top' => __('site/models/section.locations.top'),
            'main' => __('site/models/section.locations.main'),
            'column' => __('site/models/section.locations.column'),
            'bottom' => __('site/models/section.locations.bottom'),
        ];
    }
}
