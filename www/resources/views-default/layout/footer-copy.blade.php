<x-site.copyrights/>
@if(!empty($settings->site_copyrights_info))
    <div>{!! nl2br($settings->site_copyrights_info) !!}</div>
@endif
{{-- <x-site.system-pages-menu/> --}}
 @include('layout.menu-system')
<x-site.developer-footer/>
