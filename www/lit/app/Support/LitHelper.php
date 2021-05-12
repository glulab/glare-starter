<?php

namespace Lit\Support;

class LitHelper
{
    public function __construct()
    {

    }

    public function badgeLight($template, $iterate = 10)
    {
        if (strpos($template, '#') === false) {
            return '<span class="badge badge-light text-wrap mb-1">'.$template.'</span>';
        }

        $t = [];
        for ($i = 0; $i < $iterate; $i++) {
            $t[] = '<span class="badge badge-light text-wrap mb-1">'.str_replace('#', $i, $template).'</span>';
        }

        return implode(' ', $t);
    }
}
