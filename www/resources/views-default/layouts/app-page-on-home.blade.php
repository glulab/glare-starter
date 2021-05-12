<div class="page">

    <div class="container-fluid px-0">
        @yield('full-width')
    </div>

    <div class="container">
        @yield('top')
    </div>

    @hasSection('side')
        <div class="container">
            <div class="row">
                <div class="content-has-side order-1 order-lg-1 col-12 col-xl-8 mb-5">
                    @yield('content')
                </div>
                <div class="side order-2 order-lg-2 col-12 col-xl-4 pl-xl-5 mb-5">
                    @yield('side')
                </div>
            </div>
        </div>
    @else
        <div class="container">
            @yield('content')
        </div>
    @endif

    <div class="container">
        @yield('bottom')
    </div>

    {{-- <x-site.contact-form container-class="container"/> --}}

</div>
