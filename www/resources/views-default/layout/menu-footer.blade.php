@if(isset($menu_footer) && $menu_footer->menu_footer->count() > 0)
<ul class="navbar-nav menu-footer {!! $class ?? '' !!}">
@foreach($menu_footer->menu_footer as $keyLevel1 => $item1)
    <li class="nav-item"><a class="nav-link" {!! isset($item1->target[0]) ? 'target="'.$item1->target[0].'"' : '' !!} href="{!! LitMenu::href($item1, false) !!}">{!! $item1->title !!}</a></li>
@endforeach
</ul>
@endif

