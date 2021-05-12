@php
    $hasFilename = config('site.options.contact-link-has-filename', false);
    $hasFaclass = config('site.options.contact-link-has-faclass', false);
@endphp
<ul class="{!! $class !!}">
    @foreach ($links->all() as $key => $link)
        @if(empty($link->active))
            @continue
        @endif
        @php
            $linkClass = \Str::slug($link->name);
            $filename = trim($link->filename);
            if($hasFilename && !empty($filename)) :
                $fp = null;
                $iconFilePath1 = "images/{$dir}/{$filename}.png";
                $iconFilePath2 = "images/{$dir}/{$filename}";
                if (is_file(public_path($iconFilePath1))) {
                    $fp = $iconFilePath1;
                }
                if (is_file(public_path($iconFilePath2))) {
                    $fp = $iconFilePath2;
                }
            endif;
            $attrs = [];
            if (!empty($link->itemprop)) {
                $attrs['itemprop'] = $link->itemprop;
            }
            $attrs = \Helper::attributesToString($attrs);
        @endphp
        <li class="nav-item name-{!! $linkClass ?? '' !!}">
            <a class="nav-link" href="{!! str_replace([' '], '', $link->url) !!}">
                @if($hasFilename && !empty($fp))
                    <img class="item-img item-key" src="{!! asset($fp) !!}" alt="{!! (string) $link->label !!}">
                @elseif($hasFaclass && !empty($link->faclass))
                    <i class="item-icon item-key {!! $link->faclass !!}"></i>
                @else
                    <span class="item-name item-key">{!! $link->name !!}:</span>
                @endif
                @if(!empty($link->text))
                    <span class="item-value" {!! $attrs !!}>{!! $link->text !!}</span>
                @endif
            </a>
        </li>
    @endforeach
</ul>
