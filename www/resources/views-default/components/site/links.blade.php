<ul class="{!! $class !!}">
    @foreach ($links->all() as $key => $link)
        @if(empty($link->active))
            @continue
        @endif
        @php
            if(!empty(trim($link->name))) :
            $fp = null;
            $iconFilePath1 = "images/{$dir}/{$link->name}.png";
            $iconFilePath2 = "images/{$dir}/{$link->name}";
            if (is_file(public_path($iconFilePath1))) {
                $fp = $iconFilePath1;
            }
            if (is_file(public_path($iconFilePath2))) {
                $fp = $iconFilePath2;
            }
            endif;
        @endphp
        <li class="nav-item name-{!! $link->name ?? 'empty' !!}">
            <a class="nav-link" target="_blank" href="{!! $link['url'] !!}">
                @if(!empty($fp))
                    <img class="item-img item-key" src="{!! asset($fp) !!}" alt="{!! (string) $link->label !!}">
                @else
                    <i class="item-icon item-key {!! $link['class'] !!}"></i>
                @endif
                @if(!empty($link['label']))
                    <span class="item-value">{!! $link['label'] !!}</span>
                @endif
            </a>
        </li>
    @endforeach
</ul>
