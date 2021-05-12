<ul class="{!! $class !!}">
    @foreach ($entries as $kEntry => $entry)
        <li class="nav-item site-{!! $kEntry !!}">
            <a class="nav-link" itemprop="{!! $kEntry !!}" href="tel:{!! $entry['href'] !!}">
                @if($entry['keyType'] === 'img')<img class="item-key" src="{!! $entry['file'] !!}" alt="">@else<span class="item-key">{!! __('keys.'.$kEntry) !!}:</span>@endif&nbsp;<span class="item-value">{!! $entry['value'] !!}</span>
            </a>
        </li>
    @endforeach
</ul>
