<?php

namespace App\Support\ViewParsers;

class ThemeViewParser
{
    public function __construct()
    {
        //
    }

    public function parse($input)
    {
        $output = preg_replace_callback_array(
            [
                // <p>[cta-contact]</p>
                '~\[contact-button(\.\.(.+?))?(\.\.class:([a-zA-Z0-9-_. ]+))?\]~i' => function ($match) {
                    $label = !empty($match[2]) ? $match[2] : ucwords(__('contact'));
                    $class = !empty($match[4]) ? $match[4] : 'mb-3';
                    $out = '<button type="button" class="'.$class.'">' . $label . '</button>';
                    return $out;
                },
            ],
            $input
        );

        return $output;
    }

}
