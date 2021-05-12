@if(isset($menu_lang) && $menu_lang->menu_lang->count() > 0)
<ul class="navbar-nav ml-0 mr-auto menu-lang {!! $class ?? '' !!}">
@foreach($menu_lang->menu_lang as $keyLevel1 => $item1)
    {{-- check if level1 is active --}}
    @php($active1 = false)
    @if (app()->isLocale($item1->lang))
        @php($active1 = true)
    @endif
    <li class="nav-item lang-{!! $item1->lang !!} {!! $active1?'active':'inactive' !!}" data-lang="{!! $item1->lang !!}"><a class="nav-link" {!! isset($item1->target[0]) ? 'target="'.$item1->target[0].'"' : '' !!} href="{!! LitMenu::href($item1, $item1->lang) !!}">{!! $item1->title !!}</a></li>
@endforeach
</ul>
@endif

