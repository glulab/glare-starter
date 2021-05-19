@php
    $logos = [
        'default' => 'images/logo.png',
        'sticky' => 'images/logo/sticky/logo.png',
        'home' => 'images/logo/home/logo.png',
        'home-sticky' => 'images/logo/home-sticky/logo.png',
    ];

    if ($layout['is_home']) :
        $logoClass = 'is-home';
        $logoUrl = is_file(public_path($logos['home'])) ? asset($logos['home']) : asset($logos['default']);
        $stickyLogoUrl = is_file(public_path($logos['home-sticky'])) ? asset($logos['home-sticky']) : (is_file(public_path($logos['sticky'])) ? asset($logos['sticky']) : asset($logos['default']));
    else :
        $logoClass = 'is-default';
        $logoUrl = asset($logos['default']);
        $stickyLogoUrl = is_file(public_path($logos['sticky'])) ? asset($logos['sticky']) : asset($logos['default']);
    endif;

@endphp

<a class="navbar-brand {!! $logoClass !!}" href="{{ url('/') }}">
    <img src="{!! $logoUrl !!}" alt="{!! $settings->site_name !!}">
</a>
<a class="navbar-brand {!! $logoClass !!} is-sticky" href="{{ url('/') }}">
    <img src="{!! $stickyLogoUrl !!}" alt="{!! $settings->site_name !!}">
</a>
