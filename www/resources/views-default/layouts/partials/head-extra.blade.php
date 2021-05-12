@if(optional(\LitSettings::get('header_extras'))->count())
@php($d = str_replace('www.', '', \LitSettings::get('site_domain')))
@foreach (\LitSettings::get('header_extras') as $headerExtra)
    @if ($headerExtra->type === 'header_extra')
        <!-- Header Extra:  {!! $headerExtra->header_extra_name !!} -->
        @if (!empty($headerExtra->header_extra_domain))
            <!-- Header Extra Domain:  {!! (string) $headerExtra->header_extra_domain !!} -->
            @if ($headerExtra->header_extra_domain != $d)
                <!-- Header Extra Domain Not Matched -->
                @continue
            @endif
        @endif

        {!! $headerExtra->header_extra_body !!}

    @endif
@endforeach
@endif
