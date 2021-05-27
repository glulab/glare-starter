@if (!empty($prefix))
    <div class="{!! $class !!}-prefixed has-prefix">
        <div class="{!! $class !!}-prefix is-prefix">{!! $prefix !!}</div>
        <{!! $tag !!} class="{!! $class !!}">{!! $text !!}</{!! $tag !!}>
    </div>
@else
    <{!! $tag !!} class="{!! $class !!}">{!! $text !!}</{!! $tag !!}>
@endif
