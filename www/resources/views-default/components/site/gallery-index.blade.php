<div class="galleries">
    <div class="gallery">
        <div class="gallery-label">
            @if(!empty($gallery->title))<div class="gallery-title">{!! $gallery->title !!}</div>@endif
            @if(!empty($gallery->description))<div class="gallery-description">{!! $gallery->description !!}</div>@endif
        </div>
        <x-site.photos :images="$gallery->imagesCollection" :class="$class ?? ''" :attrs="$attrs" :size="$size ?? ''" :miniature="$miniature" :thumb="$thumb"/>
    </div>
</div>
