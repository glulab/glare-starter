@if(isset($menu_system) && $menu_system->menu_system->count() > 0)
<ul class="navbar-nav menu-system {!! $class ?? '' !!}">
@foreach($menu_system->menu_system as $keyLevel1 => $item1)
    <li class="nav-item"><a class="nav-link" {!! isset($item1->target[0]) ? 'target="'.$item1->target[0].'"' : '' !!} href="{!! LitMenu::href($item1, false) !!}">{!! $item1->title !!}</a></li>
@endforeach
</ul>
@endif

