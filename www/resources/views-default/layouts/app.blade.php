<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(!empty($seoTitle)){!! $seoTitle !!}@elseif(!empty($settings->site_name)){{ $settings->site_name }}@else{{ config('app.name') }}@endif</title>
    @if(!empty($seoDescription))<meta name="description" content="{!! $seoDescription !!}">@endif

    <meta property="og:title" content="@if(!empty($seoTitle)){!! $seoTitle !!}@elseif(!empty($settings->site_name)){{ $settings->site_name }}@else{{ config('app.name') }}@endif">
    @if(!empty($seoDescription))<meta property="og:description" content="{!! $seoDescription !!}">@endif
    <meta property="og:url" content="@if(!empty($seoUrl)){!! $seoUrl !!}@else{!! request()->fullUrl() !!}@endif" />
    @if(!empty($seoImage))<meta property="og:image" content="{!! $seoImage !!}">@endif
    <meta property="og:type" content="@if(!empty($seoType)){!! $seoType !!}@else{{ 'website' }}@endif" />
    <meta property="og:locale" content="{!! app()->getLocale() !!}" />

    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{!! route('home') !!}">
    <meta property="twitter:url" content="@if(!empty($seoUrl)){!! $seoUrl !!}@else{!! request()->fullUrl() !!}@endif">
    <meta name="twitter:title" content="@if(!empty($seoTitle)){!! $seoTitle !!}@elseif(!empty($settings->site_name)){{ $settings->site_name }}@else{{ config('app.name') }}@endif">
    @if(!empty($seoDescription))<meta name="twitter:description" content="{!! $seoDescription !!}">@endif
    @if(!empty($seoImage))<meta name="twitter:image" content="{!! $seoImage !!}">@endif

    <link rel="icon" href="{!! asset('favicon.ico') !!}" type="image/x-icon">

    @include('layouts.partials.head-meta')

    {{--  Scripts --}}
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    {{-- Fonts --}}
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
    @include('layouts.partials.head-extra')
</head>
<body class="{!! $layout['body_classes'] !!} page page-type-{!! $page->type ?? 'default' !!} page-action-{!! $page->action ?? 'default' !!} page-id-{!! $page->id ?? '0' !!} page-{!! !empty($page->active) ? 'active' : 'inactive' !!}">

    <div id="app">

        <header>
            @includeWhen($layout['is_home'], 'layouts.body.header-home')
            @includeUnless($layout['is_home'],'layouts.body.header')
            @yield('header')
        </header>

        <main class="main">

            @hasSection('code')
                <div class="container my-5 d-flex flex-column justify-content-center align-items-center">
                    <div>@yield('code', __('Oh no'))</div>
                    @hasSection('message')
                        <div>@yield('message')</div>
                    @endif
                    <div><a href="{{ url('/') }}">Przejdź do strony glównej</a></div>
                </div>
            @endif

            @if ($errors->any())
                <div class="container">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('status'))
                <div class="container">
                    <div class="alert alert-{!! session('status')['type'] ?? 'info' !!}">
                        {{ str_replace(['|', '  | '], '<br>', session('status')['message'] ?? session('status') ?? '') }}
                    </div>
                </div>
            @endif

            {{-- @hasSection('title')
                <div class="container">
                    <div class="title font-weight-bold pb-3">
                        @yield('title')
                    </div>
                </div>
            @endif --}}

            @yield('main-top')

            @includeWhen($layout['is_home'], 'layouts.body.page-home')
            @includeUnless($layout['is_home'],'layouts.body.page')

            @yield('main-bottom')

        </main>

        <footer>
            @include('layout.footer')
        </footer>

    </div>

    @hasSection('alert-bottom')
        <div class="alert alert-warning alert-dismissible fade show fixed-bottom mb-0" role="alert">
            @yield('alert-bottom')
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    <x-site.info-bottom-cookie :title="$site->info_bottom_cookie_title ?? ''" :text="$site->info_bottom_cookie_text ?? ''" :accept="$site->info_bottom_cookie_accept ?? ''" :active="$site->info_bottom_cookie_active ?? false"/>
    <x-site.info-modal-cookie :title="$site->info_modal_cookie_title ?? ''" :text="$site->info_modal_cookie_text ?? ''" :accept="$site->info_modal_cookie_accept ?? ''" :active="$site->info_modal_cookie_active ?? false"/>
    <x-site.info-modal :title="$site->info_modal_title ?? ''" :text="$site->info_modal_text ?? ''" :active="$site->info_modal_active ?? false"/>

    @stack('modals')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @include('layouts.partials.bottom-scripts')

    @stack('scripts')

</body>
</html>
