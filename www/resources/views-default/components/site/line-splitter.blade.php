<div class="line-splitter lines {!! $class !!}">
    @foreach ($lines as $key => $line)
        <div class="line is-{!! $key+1 !!}">{!! $line !!}</div>
    @endforeach
</div>
