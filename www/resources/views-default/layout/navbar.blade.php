<nav class="navbar navbar-expand-xl navbar-light {{-- bg-white --}} shadow-sm">
    <div class="container">

        @include('layout.navbar-brand')

        @include('layout.menu-lang')

        @include('layout.block-contact-links', ['class' => 'in-header navbar-nav d-none d-lg-flex ml-0 mr-auto'])

        @include('layout.block-links', ['class' => 'in-header navbar-nav d-none d-xl-flex'])

        {{-- @include('layout.navbar-top') --}}
        {{-- @include('layout.navbar-top') --}}

        <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#menu-main" aria-controls="menu-main" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- <div class="navbar-holder"> --}}

            {{-- @include('layout.menu-top') --}}

            <div class="collapse navbar-collapse" id="menu-main">

                <!-- Left Side Of Navbar -->
                @include('layout.menu-main')

                @include('layout.block-links', ['class' => 'in-header navbar-nav d-flex d-xl-none'])

                @include('layout.block-contact-links', ['class' => 'in-header navbar-nav d-flex d-lg-none'])

                {{-- @include('layout.menu-top') --}}

                <!-- Right Side Of Navbar -->
                @include('layout.menu-right')

            </div>

        {{-- </div> --}}

    </div>
</nav>
