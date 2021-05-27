@php
    $logos = [
        'default' => 'images/logo.png',
        'sticky' => 'images/logo/sticky/logo.png',
        'home' => 'images/logo/home/logo.png',
        'home-sticky' => 'images/logo/home-sticky/logo.png',
    ];

    $logoUrl = asset($logos['default']);
    $stickyLogoUrl = is_file(public_path($logos['sticky'])) ? asset($logos['sticky']) : asset($logos['default']);

    if ($layout['is_home']) :
        $homeLogoUrl = is_file(public_path($logos['home'])) ? asset($logos['home']) : asset($logos['default']);
        $homeStickyLogoUrl = is_file(public_path($logos['home-sticky'])) ? asset($logos['home-sticky']) : (is_file(public_path($logos['sticky'])) ? asset($logos['sticky']) : asset($logos['default']));
    endif;

@endphp

@if($layout['is_home'])
    <a class="navbar-brand is-home is-mobile" href="{{ url('/') }}">
        <img src="{!! $logoUrl !!}" alt="{!! $settings->site_name !!}">
    </a>
    <a class="navbar-brand is-home is-desktop" href="{{ url('/') }}">
        <img src="{!! $homeLogoUrl !!}" alt="{!! $settings->site_name !!}">
    </a>
    <a class="navbar-brand is-home is-sticky" href="{{ url('/') }}">
        <img src="{!! $homeStickyLogoUrl !!}" alt="{!! $settings->site_name !!}">
    </a>
@else
    <a class="navbar-brand is-default" href="{{ url('/') }}">
        <img src="{!! $logoUrl !!}" alt="{!! $settings->site_name !!}">
    </a>
    <a class="navbar-brand is-default is-sticky" href="{{ url('/') }}">
        <img src="{!! $stickyLogoUrl !!}" alt="{!! $settings->site_name !!}">
    </a>
@endif

