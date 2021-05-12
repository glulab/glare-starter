<a class="navbar-brand is-default" href="{{ url('/') }}">
    <img src="{!! asset('images/logo.png') !!}" alt="{!! $settings->site_name !!}">
</a>

@if ($layout['is_home'] && is_file(public_path('images/logo-home.png')))
    <a class="navbar-brand is-home" href="{{ url('/') }}">
        <img src="{!! asset('images/logo-home.png') !!}" alt="{!! $settings->site_name !!}">
    </a>
@endif
