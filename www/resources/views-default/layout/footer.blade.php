<div class="footer pt-5 pb-3 ">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 mb-4 footer-menu-main">
                @include('layout.footer-menu-main')
            </div>
            {{-- <div class="col-12 col-md-3 mb-4 footer-offer">
                @include('layout.footer-offer')
            </div> --}}
            <div class="col-12 col-md-3 mb-4 footer-menu">
                @include('layout.menu-footer')
            </div>
            <div class="col-12 col-md-3 mb-4 footer-contact-links">
                {{-- @include('layout.block-contact-links', ['class' => 'in-footer']) --}}
                {{-- @include('layout.block-links', ['class' => 'in-footer']) --}}
                @include('layout.block-links', ['class' => 'navbar-nav in-footer'])
            </div>
            <div class="col-12 col-md-3 mb-4 footer-contact">
                @include('layout.block-contact-full')
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col mb-4 footer-copy">
                    @include('layout.footer-copy')
                </div>
            </div>
        </div>
    </div>
</div>
