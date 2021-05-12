@if (config('site.options.map-has-embed-code') && !empty($site->map_iframe_src))
<div class="{!! $containerClass ?? '' !!}">
    <div class="map">
        <div class="embed-responsive embed-responsive-21by9">
          <iframe class="embed-responsive-item" src="{{ $site->map_iframe_src }}" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>
@endif
