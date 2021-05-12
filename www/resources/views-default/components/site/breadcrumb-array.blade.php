<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach ($breadcrumb as $kBreadcrumb => $vBreadcrumb)
            <li class="breadcrumb-item {!! $vBreadcrumb['active'] ? 'active' : '' !!}" {!! $vBreadcrumb['active'] ? 'aria-current="page"' : '' !!}>
                <a href="{!! $vBreadcrumb['href'] !!}">{!! $vBreadcrumb['label'] !!}</a>
            </li>
        @endforeach
    </ol>
</nav>
