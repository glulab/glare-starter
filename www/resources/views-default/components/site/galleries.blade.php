@if(!empty($galleries) && count($galleries) > 0)
<div class="galleries">
    @foreach ($galleries as $gallery)
        <x-site.gallery :gallery="$gallery" :class="$class" :attrs="$attrs" :size="$size" :miniature="$miniature" :thumb="$thumb"/>
    @endforeach
</div>
@endif
