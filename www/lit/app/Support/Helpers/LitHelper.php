<?php

namespace Lit\Support\Helpers;

class LitHelper
{
    public function __construct()
    {

    }

    public function badges($template, $badgeClass = 'secondary', $iterate = 10)
    {
        if (strpos($template, '#') === false) {
            return '<span class="badge badge-' .$badgeClass. ' text-wrap mb-1">'.$template.'</span>';
        }

        $t = [];
        for ($i = 0; $i < $iterate; $i++) {
            $t[] = '<span class="badge badge-' .$badgeClass. ' text-wrap mb-1">'.str_replace('#', $i, $template).'</span>';
        }

        return implode(' ', $t);
    }

    public function showPreview()
    {
        $segments = request()->segments();
        if (empty($segments[2])) {
            return url('/');
        }

        $page = \App\Models\Page::find($segments[2]);
        if (is_null($page)) {
            return url('/');
        }

        return $page->urlByType;
    }

    public function iconsSelectOptions($dirname = 'icons', $exclude = ['test'])
    {
        $a = ['' => '-'];
        $iconsPath = public_path('images/' . $dirname . '/*');
        $icons = collect(glob($iconsPath));
        if (empty($icons)) {
            return [];
        }
        $icons = $icons->mapWithKeys(function ($item) {
            $filename = pathinfo($item, PATHINFO_FILENAME);
            return [$filename => $filename];
        });
        $icons = $icons->filter(function ($item) use ($exclude) {
            if (in_array($item, $exclude)) {
                return false;
            }
            return true;
        });

        return array_merge($a, $icons->all());
    }

    public function itempropContactLinkSelectOptions()
    {
        $a = ['' => '-'];

        $place = ['telephone', 'email', 'url'];

        $raw = array_merge([], $place);

        $translated = [];
        foreach ($raw as $item) {
            $translated[$item] = __('itemprops.' . $item);
        }

        $translated = array_merge($a, $translated);
        return $translated;
    }
}
