<ul class="photos {!! $class !!} is-{!! ($size ? $size : 'original') !!}" id="{!! uniqid('photos-') !!}" data-count="{!! count($images) !!}" {!! $attrs !!}>
@foreach ($images as $img)

    {{-- // check if there is thumb --}}
    @if (!is_file($img->getPath($thumb)) || $img->hasGeneratedConversion($thumb) === false)
    <li class="photo" data-src="{!! $img->getUrl($size) !!}">
    @else
    <li class="photo" data-src="{!! $img->getUrl($size) !!}" data-thumb="{!! $img->getUrl($thumb) !!}">
    @endif

        @if(!empty($img->slug))
            <a class="photo-frame photo-link" href="{!! route('gallery.show', ['slug' => $img->slug]) !!}">
        @else
            <div class="photo-frame">
        @endif

            @php
                // attributes array
                $attributes = [];
                $attributes['class']= 'photo-img';
                $attributes['alt'] = $img->title ?: $img->alt;
                if (!empty($img->title)) {
                    $attributes['title'] = $img->title;
                }
                // attributes string
                $attributesString = '';
                foreach ($attributes as $key => $value) {
                    if (!empty($attributesString)) {
                        $attributesString .= ' ';
                    }
                    $attributesString .= $key.'="'.$value.'"';
                }
            @endphp

            {{-- check if there is miniature --}}
            @if (is_file($img->getPath($miniature)) && $img->hasGeneratedConversion($miniature) === true)
                <img src="{!! $img->getUrl($miniature) !!}" {!! $attributesString !!}>
            @else
                {!! $img($size)->attributes($attributes)->lazy() !!}
            @endif

            @if (!empty($img->title))
                <div class="photo-title">{!! $img->title !!}</div>
            @endif
        @if(!empty($img->slug))
            </a>
        @else
            </div>
        @endif
    </li>
@endforeach
</ul>
