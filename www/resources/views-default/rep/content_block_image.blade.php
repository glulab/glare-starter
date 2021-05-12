@php
    $image = $rep->image;
@endphp
<div class="content-block content-block-image">
    <div class="image">
        {!! $image()->attributes(['class' => 'img']) !!}
    </div>
</div>
