@php
    $iconsDir = $dir ?? 'icons';
@endphp

@if(!empty($settings->contact_links) && $settings->contact_links->count() > 0)
<ul class="block-contact-links {!! $class ?? '' !!}">
    @foreach ($settings->contact_links->all() as $key => $link)
        @if(empty($link->active))
            @continue
        @endif
        @php
            if(!empty(trim($link->name))) :
            $fp = null;
            $iconFilePath1 = "images/{$iconsDir}/{$link->name}.png";
            $iconFilePath2 = "images/{$iconsDir}/{$link->name}";
            if (is_file(public_path($iconFilePath1))) {
                $fp = $iconFilePath1;
            }
            if (is_file(public_path($iconFilePath2))) {
                $fp = $iconFilePath2;
            }
            endif;
        @endphp
        <li class="nav-item block-contact-links-item name-{!! $link->name ?? 'empty' !!}">
            <a class="nav-link block-contact-links-link" target="_blank" href="{!! $link['url'] !!}">
                @if(!empty($fp))
                    <img class="block-contact-links-image" src="{!! asset($fp) !!}" alt="{!! (string) $link->label !!}">
                @else
                    <i class="{!! $link['class'] !!}"></i>
                @endif
                @if(!empty($link['label']))
                    <span class="block-contact-links-label">{!! $link['label'] !!}</span>
                @endif
            </a>
        </li>
    @endforeach
</ul>
@endif
