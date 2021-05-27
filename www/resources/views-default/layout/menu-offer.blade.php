@php
    if (!config('site.services.menu-offer')) return;
@endphp
@if(isset($menu_offer) && $menu_offer->menu_offer->count() > 0)
    @if(View::exists('components.menu-offer'))
    <x-dynamic-component component="menu-offer" :menu-items="$menu_offer->menu_offer"/>
    @else
    <ul class="navbar-nav menu-offer {!! $class ?? '' !!}">
    @foreach($menu_offer->menu_offer as $keyLevel1 => $item1)
        <li class="nav-item"><a class="nav-link" {!! isset($item1->target[0]) ? 'target="'.$item1->target[0].'"' : '' !!} href="{!! LitMenu::href($item1, false) !!}">{!! $item1->title !!}</a></li>
    @endforeach
    </ul>
    @endif
@endif

