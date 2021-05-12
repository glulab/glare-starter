<div class="page">

    <div class="container">

        @yield('top')

        @hasSection('side')
            <div class="row">
                <div class="order-1 order-lg-2 col-12 col-lg-9 col-xl-10 mb-3">
                    @yield('content')
                </div>
                <div class="order-2 order-lg-1 col-12 col-lg-3 col-xl-2 mb-3">
                    @yield('side')
                </div>
            </div>
        @else
            @yield('content')
        @endif

        @yield('bottom')

        {{-- <x-site.contact-form/> --}}

    </div>

</div>
