<?php

namespace Lit\Support;

class LitCategoryHelper extends LitHelper
{
    public function __construct()
    {

    }

    public static function typeSelectOptions()
    {
        return [
            // null => '-',
            'post' => '<span class="badge badge-secondary">' . __('site/models/category.types.post') . '</span>',
        ];
    }
}
