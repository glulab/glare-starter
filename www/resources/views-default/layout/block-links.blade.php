@if(!empty($site->links) && $site->links->filter->active->count() > 0)
    <x-site.links :links="$site->links" :class="'block-links '.($class ?? '')" :dir="$dir ?? 'icons'"/>
@endif
