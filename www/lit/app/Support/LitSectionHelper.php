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
            'home' => __('model-section.types.home'),
        ];
    }

    public function locationSelectOptions()
    {
        return [
            'top' => __('model-section.locations.top'),
            'main' => __('model-section.locations.main'),
            'column' => __('model-section.locations.column'),
            'bottom' => __('model-section.locations.bottom'),
        ];
    }
}
