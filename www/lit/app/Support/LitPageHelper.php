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
            'contact' => '<span class="badge badge-secondary">' . __('routes.contact') . '</span>',
            'offer' => '<span class="badge badge-secondary">' . __('routes.offer') . '</span>',
            'realizations' => '<span class="badge badge-secondary">' . __('routes.realizations') . '</span>',
        ];
    }
    public function routeSelectOptions()
    {
        return [
            null => '-',
            'contact' => __('routes.contact'),
            'offer' => __('routes.offer'),
            'realizations' => __('routes.realizations'),
        ];
    }
}
