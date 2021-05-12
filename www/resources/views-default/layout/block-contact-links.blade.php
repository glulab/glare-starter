{{-- @if(!empty($site->contact_links) && $site->contact_links->filter->active->count() > 0) --}}
    <x-site.contact-links :links="$site->contact_links" :class="'block-contact-links '.($class ?? '')" :dir="$dir ?? 'icons/contact'"/>
{{-- @else --}}
    {{-- @include('layout.block-contact-basic', ['class' => $class . ' d-flex align-content-center']) --}}
{{-- @endif --}}
