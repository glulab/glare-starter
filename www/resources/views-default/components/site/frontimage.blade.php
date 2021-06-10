<div class="frontimage">
    @if (!is_callable($image))
        <img src="{!! $image !!}" class="frontimage-img" alt="">
    @else
        {!! $image()->attributes(['class' => 'frontimage-img'])->lazy() !!}
    @endif
</div>
