<?php

namespace Lit\Support;

class LitPageHelper extends LitHelper
{
    public function __construct()
    {

    }

    public function routeSelectOptionsDecorated()
    {
        return [
            null => '-',
            'contact' => '<span class="badge badge-secondary">' . __('site/routes.contact') . '</span>',
            'offer' => '<span class="badge badge-secondary">' . __('site/routes.offer') . '</span>',
            'realizations' => '<span class="badge badge-secondary">' . __('site/routes.realizations') . '</span>',
        ];
    }
    public function routeSelectOptions()
    {
        return [
            null => '-',
            'contact' => __('site/routes.contact'),
            'offer' => __('site/routes.offer'),
            'realizations' => __('site/routes.realizations'),
        ];
    }
}
