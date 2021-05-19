<div class="footer pt-5 pb-3 ">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 mb-4 footer-menu-main">
                @include('layout.menu-main', ['class' => 'in-footer'])
            </div>
            <div class="col-12 col-md-3 mb-4 footer-menu">
                @include('layout.menu-offer', ['class' => 'in-footer'])
                @include('layout.menu-footer', ['class' => 'in-footer'])
                @include('layout.menu-lang', ['class' => 'in-footer'])
            </div>
            <div class="col-12 col-md-3 mb-4 footer-contact-links">
                @include('layout.block-links', ['class' => 'in-footer'])
                {{-- @include('layout.block-contact-links', ['class' => 'in-footer']) --}}
            </div>
            <div class="col-12 col-md-3 mb-4 footer-contact">
                @include('layout.footer-contact')
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
