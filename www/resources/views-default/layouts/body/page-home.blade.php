<div class="page">

    @hasSection('top-fluid')
    <div class="top-fluid container-fluid px-0">
        @yield('top-fluid')
    </div>
    @endif

    @hasSection('top')
    <div class="top container">
        @yield('top')
    </div>
    @endif

    @hasSection('side')
        <div class="container">
            <div class="row">
                <div class="content content-has-side order-1 order-lg-1 col-12 col-xl-8 mb-5">
                    @yield('content')
                </div>
                <div class="side order-2 order-lg-2 col-12 col-xl-4 pl-xl-5 mb-5">
                    @yield('side')
                </div>
            </div>
        </div>
    @else
        @hasSection('content-fluid')
        <div class="content-fluid container-fluid px-0">
            @yield('content-fluid')
        </div>
        @endif
        @hasSection('content')
        <div class="content container">
            @yield('content')
        </div>
        @endif
    @endif

    @hasSection('bottom')
    <div class="bottom container">
        @yield('bottom')
    </div>
    @endif

    @hasSection('bottom-fluid')
    <div class="bottom-fluid container-fluid px-0">
        @yield('bottom-fluid')
    </div>
    @endif

</div>
