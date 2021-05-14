@php
    $hasFilename = config('site.options.link-has-filename', false);
    $hasIcon = config('site.options.link-has-icon', false);
    $hasItemprop = config('site.options.link-has-itemprop', false);
@endphp
<ul class="{!! $class !!}">
    @foreach ($links->all() as $key => $link)
        @if(empty($link->active))
            @continue
        @endif
        @php
            $fp = null;
            $linkClass = \Str::slug($link->name) . (!empty($link->class) ? ' ' . $link->class : '');
            $filename = trim($link->filename);
            if($hasFilename && !empty($filename)) :
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
            if ($hasItemprop && !empty($link->itemprop)) {
                $attrs['itemprop'] = $link->itemprop;
            }
            $attrs = \Helper::attributesToString($attrs);
        @endphp
        <li class="nav-item name-{!! $linkClass ?? '' !!}">
            <a class="nav-link" href="{!! str_replace([' '], '', $link->url) !!}">
                @if($hasFilename && !empty($fp))
                    <img class="item-img item-key" src="{!! asset($fp) !!}" alt="{!! (string) $link->label !!}">
                @elseif($hasIcon && !empty($link->icon))
                    {!! str_replace('class="', 'class="item-key ', $link->icon) !!}
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
