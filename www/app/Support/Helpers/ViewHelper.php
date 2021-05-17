<?php

namespace App\Support\Helpers;

use Glare\Support\Helpers\ViewHelper as GlareViewHelper;

class ViewHelper extends GlareViewHelper {

    public function parse($text)
    {
        $text = \App::make(\App\Support\ViewParsers\ThemeViewParser::class)->parse($text);

        $text = parent::parse($text);

        return $text;
    }

    public function parseImages($text, $images = null)
    {
        // $text = \App::make(\App\Support\ViewParsers\ThemeImagesViewParser::class)->parse($text, $images);

        $text = parent::parseImages($text, $images);

        return $text;
    }

    public function parseComponents($text, $model)
    {
        // $text = \App::make(\App\Support\ViewParsers\ThemeComponentsViewParser::class, ['model' => $model])->parse($text);

        $text = parent::parseComponents($text, $model);

        return $text;
    }
}
