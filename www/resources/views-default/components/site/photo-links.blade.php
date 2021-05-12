@if(!empty($items) && $items->count() > 0)
<div class="{!! $containerClass ?? '' !!}">
    <ul class="photo-links  {!! $class !!}">
    @foreach ($items->all() as $key => $item)
        @php
            if (empty($item->active)) {
                continue;
            }
            $href = !empty($item->url) ? $item->url : optional($item->route)->resolve();
        @endphp
        <li class="photo-link photo-link-{!! $key !!}">
            <a class="photo-link-button btn btn-link" href="{!! $href !!}">
                <div class="photo-link-image"><img class="photo-link-img" src="{!! $item->image->original_url ?? '' !!}" alt="{!! $item->label !!}"></div>
                <div class="photo-link-label">{!! str_replace(['|', ' | '], '<br>', ($item->label)) !!}</div>
            </a>
        </li>
    @endforeach
    </ul>
</div>
@endif
