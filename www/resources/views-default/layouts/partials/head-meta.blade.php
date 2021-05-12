<!-- additional meta -->
@if(optional(\LitSettings::get('header_metas'))->count())
@foreach (\LitSettings::get('header_metas') as $headerMeta)
    @if ($headerMeta->type === 'header_meta')
    <meta {!! $headerMeta->header_meta_type !!}="{!! $headerMeta->header_meta_name !!}" content="{!! $headerMeta->header_meta_content !!}">
    @endif
@endforeach
@endif
<!-- additional meta end -->
