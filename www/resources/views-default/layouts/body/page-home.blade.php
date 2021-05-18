<div class="page">

    @hasSection('top-fluid')
    <div class="container-fluid px-0">
        @yield('top-fluid')
    </div>
    @endif

    @hasSection('top')
    <div class="container">
        @yield('top')
    </div>
    @endif

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
        @hasSection('content-fluid')
        <div class="container-fluid px-0">
            @yield('content-fluid')
        </div>
        @endif
        @hasSection('content')
        <div class="container">
            @yield('content')
        </div>
        @endif
    @endif

    @hasSection('bottom-fluid')
    <div class="container">
        @yield('bottom-fluid')
    </div>
    @endif

    @hasSection('bottom')
    <div class="container">
        @yield('bottom')
    </div>
    @endif


</div>
