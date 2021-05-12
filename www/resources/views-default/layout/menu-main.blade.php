@php
    if (empty($menu_main)) {return;}
@endphp

@php
    if (!function_exists('filterMenuCollection')) :
    function filterMenuCollection($menuCollection)
    {
        return $menuCollection->filter(function ($value, $key) {
            return $value->state !== 'inactive';
        });
    }
    endif;
@endphp

@php
    $menuMain = filterMenuCollection($menu_main->menu_main);
@endphp

@if(isset($menuMain) && $menuMain->count() > 0)
<ul class="navbar-nav navbar-main {!! !empty($class) ? $class : '' !!}">
@foreach($menuMain as $keyLevel1 => $item1)
    {{-- @if ((bool) $item1->active === false) @continue @endif --}}

    {{-- check if level1 is active --}}
    @php($active1 = false)
    @if (strval(url()->current()) === strval($item1->url?:$item1->route))
        @php($active1 = true)
    @endif

    @php($menuItem1Children = filterMenuCollection($item1->children))

    {{-- check if a child of level1 is active --}}
    @if ($menuItem1Children->count() > 0)
        @foreach($menuItem1Children as $childOf1)
            @if(strval(url()->current()) === strval($childOf1->url?:$childOf1->route))
                @php($active1 = true)
                @break
            @endif
        @endforeach
    @endif

    @if ($menuItem1Children->count() > 0)
        <li class="nav-item {!! $active1?'active':'' !!} dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{!! $item1->id !!}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {!! $item1->title !!}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown{!! $item1->id !!}">

            @foreach($menuItem1Children as $keyLevel2 => $item2)

                {{-- check if level2 is active --}}
                @php($active2 = false)
                @if (strval(url()->current()) === strval($item2->url?:$item2->route))
                    @php($active2 = true)
                @endif

                <a class="dropdown-item {!! $active2?'active':'' !!}" {!! isset($item2->target[0]) ? 'target="'.$item2->target[0].'"' : '' !!} href="{!! LitMenu::href($item2, false) !!}">{!! $item2->title !!}</a>
            @endforeach

            </div>
        </li>
    @else
        <li class="nav-item {!! $active1?'active':'' !!}">
            <a class="nav-link" {!! isset($item1->target[0]) ? 'target="'.$item1->target[0].'"' : '' !!} href="{!! LitMenu::href($item1, false) !!}">{!! $item1->title !!}</a>
        </li>
    @endif

@endforeach
</ul>
@endif
