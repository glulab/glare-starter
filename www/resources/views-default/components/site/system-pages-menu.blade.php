@if($systemPages->count() > 0)
    <ul class="system-pages-menu">
    @foreach ($systemPages as $systemPage)

        <li>
            <a href="{!! $systemPage->url !!}">{!! $systemPage->title !!}</a>
        </li>

    @endforeach
    </ul>
@endif
