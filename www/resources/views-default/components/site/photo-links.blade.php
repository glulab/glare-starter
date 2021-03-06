@if(!empty($items) && $items->count() > 0)
<div class="{!! $containerClass ?? '' !!}">
    <ul class="photo-links  {!! $class !!}">
    @php
        $hasImage = config('site.options.photo-link-has-image');
    @endphp
    @foreach ($items->all() as $key => $item)
        @php
            if (empty($item->active)) {
                continue;
            }

            $hasMedia = $item->hasMedia('image');

            if ($hasImage && !$hasMedia) {
                continue;
            }

            $image = null;
            if ($hasImage) {
                $image = $item->getFirstMedia('image');
            }

            $attrs = [];
            $attrs['class'] = 'photo-link-img';
            $attrs['alt'] = !empty($item->title) ? $item->title : ($item->label ? $item->label : '');

            if (!empty($image)) {
                if ($image->hasCustomProperty('crop.width')) {
                    $attrs['width'] = $image->getCustomProperty('crop.width');
                } elseif ($image->hasCustomProperty('original_dimensions.width')) {
                    $attrs['width'] = $image->getCustomProperty('original_dimensions.width');
                }
                if ($image->hasCustomProperty('crop.height')) {
                    $attrs['height'] = $image->getCustomProperty('crop.height');
                } elseif ($image->hasCustomProperty('original_dimensions.height')) {
                    $attrs['height'] = $image->getCustomProperty('original_dimensions.height');
                }
            }
        @endphp
        <li class="photo-link photo-link-{!! $key !!}">
            @if(!config('site.options.photo-link-has-button'))
                <a class="photo-link-link" href="{!! $item->href !!}">
            @endif
            @if($hasImage && !empty($image))
                <div class="photo-link-image">{!! $image()->attributes($attrs)->lazy() !!}</div>
            @endif
            @if(config('site.options.photo-link-has-title') && !empty($item->title))
                <div class="photo-link-title">{!! nl2br(trim($item->title)) !!}</div>
            @endif
            @if(config('site.options.photo-link-has-text') && !empty($item->text))
                <div class="photo-link-text">{!! trim($item->text) !!}</div>
            @endif
            @if(config('site.options.photo-link-has-button') && !empty($item->label))
                <a class="photo-link-button btn btn-custom" href="{!! $item->href !!}">{!! nl2br(trim($item->label)) !!}</a>
            @endif
            @if(!config('site.options.photo-link-has-button'))
                </a>
            @endif
        </li>
    @endforeach
    </ul>
</div>
@endif
