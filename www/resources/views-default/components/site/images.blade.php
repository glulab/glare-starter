<ul class="images {!! $class !!} is-{!! ($size ? $size : 'original') !!}" id="{!! uniqid('images-') !!}" data-count="{!! count($images) !!}" {!! $attrs !!}>
@foreach ($images as $img)

    {{-- // check if there is thumb --}}
    @if (!is_file($img->getPath($thumb)) || $img->hasGeneratedConversion($thumb) === false)
    <li class="images-item" data-src="{!! $img->getUrl($size) !!}">
    @else
    <li class="images-item" data-src="{!! $img->getUrl($size) !!}" data-thumb="{!! $img->getUrl($thumb) !!}">
    @endif

        <div class="images-item-image">

            @php
                // attributes array
                $attributes = [];
                $attributes['class']= 'images-item-img';
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
                <div class="images-item-title">{!! $img->title !!}</div>
            @endif
        </div>
    </li>
@endforeach
</ul>
