@php
    $textHintId = uniqid('collapse-');
@endphp
<div class="px-3 mb-3 small">
    <b-button v-b-toggle.{!! $textHintId !!} variant="link" class="btn btn-light btn-sm text-dark d-block ml-auto mr-0" style="transform: translateY(-10px);">{!! $title !!}</b-button>
    <b-collapse id="{!! $textHintId !!}" class="mt-2 px-2">
        <p class="text-muted">{!! $body !!}</p>
        <hr>
    </b-collapse>
</div>
