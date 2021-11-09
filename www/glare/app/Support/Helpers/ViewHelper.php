<?php

namespace Glare\Support\Helpers;

class ViewHelper {

    public function formatText($text, $nl2br = true)
    {
        $text = $this->parse($text);
        return $this->format($text, $nl2br);
    }

    public function formatPage($text, $images, $nl2br = false)
    {
        $text = $this->parse($text);
        $text = $this->parseImages($text, $images);

        return $this->format($text, $nl2br);
    }

    public function formatModel($model, $nl2br = false, $fields = ['textField' => 'text', 'imagesField' => 'images'])
    {
        $text = $model->{$fields['textField']};
        $images = $model->{$fields['imagesField']};

        $text = $this->parse($text);
        $text = $this->parseImages($text, $images);
        $text = $this->parseComponents($text, $model);

        return $this->format($text, $nl2br);
    }

    public function format($text, $nl2br = true)
    {
        $text = str_replace(' ,', ',', $text);
        $text = str_replace(' .', '.', $text);
        $text = str_replace(' !', '!', $text);
        $text = str_replace(['( ', ' )'], ['(', ')'], $text);
        $text = str_replace(
            [
                ' a ', ' i ', ' o ', ' u ', ' w ', ' z ',
            ],
            [
                ' a&nbsp;', ' i&nbsp;', ' o&nbsp;', ' u&nbsp;', ' w&nbsp;', ' z&nbsp;',
            ],
            $text
        );

        if ($nl2br) {
            $text = nl2br($text);
        }

        return $text;
    }

    public function parse($text)
    {
        $text = \App::make(\Glare\Support\ViewParsers\ColumnsWithNamesViewParser::class)->parse($text);
        $text = \App::make(\Glare\Support\ViewParsers\ColumnsNumberedViewParser::class)->parse($text);
        $text = \App::make(\Glare\Support\ViewParsers\ColumnsBootstrapViewParser::class)->parse($text);
        $text = \App::make(\Glare\Support\ViewParsers\BlocksViewParser::class)->parse($text);
        $text = \App::make(\Glare\Support\ViewParsers\TagsViewParser::class)->parse($text);
        $text = \App::make(\Glare\Support\ViewParsers\HeadersViewParser::class)->parse($text);
        $text = \App::make(\Glare\Support\ViewParsers\SettingsViewParser::class)->parse($text);
        $text = \App::make(\Glare\Support\ViewParsers\PagesViewParser::class)->parse($text);
        return $text;
    }

    public function parseImages($text, $images = null)
    {
        $text = \App::make(\Glare\Support\ViewParsers\ImageGalleryViewParser::class)->parse($text, $images);
        $text = \App::make(\Glare\Support\ViewParsers\ImageBlocksViewParser::class)->parse($text, $images);
        $text = \App::make(\Glare\Support\ViewParsers\ImagesViewParser::class)->parse($text, $images);
        return $text;
    }

    public function parseComponents($text, $model)
    {
        $text = \App::make(\Glare\Support\ViewParsers\ComponentPhotoLinksViewParser::class, ['model' => $model])->parse($text);
        $text = \App::make(\Glare\Support\ViewParsers\ComponentGalleriesViewParser::class, ['model' => $model])->parse($text);
        return $text;
    }

    public function splitToLines($object, $inputField = 'text', $outputField = 'lines', $splitter = '|')
    {
        if (empty($object)) {
            return $object;
        }

        if (!isset($object->$inputField)) {
            $object->lines = [];
        } else {
            $lines = explode($splitter, $object->$inputField);
            foreach($lines as $k => $line) {
                $lines[$k] = trim($line);
            }
            $object->lines = $lines;
        }

        return $object;
    }

    public function img($path, $attrs = [], $fullPath = null, $secure = null)
    {
        $atts = [];
        foreach ($attrs as $atr => $val) {
            $atts[] = $atr . '="' . $val . '"';
        }

        $is = getimagesize(is_null($fullPath) ? public_path($path) : $fullPath);

        $attributes = implode(' ', $atts);

        $o = '<img src="' . app('url')->asset($path, $secure) . '" ' . $is[3] . ' ' . $attributes . '>';

        return $o;
    }
}
