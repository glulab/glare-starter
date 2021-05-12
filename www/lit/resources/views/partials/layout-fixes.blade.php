@push('lit-scripts')
    <script>
        function layoutFixes() {

            var $litTopBarChild = $('nav.lit-topbar > div:first-child');
            $litTopBarChild.addClass('d-flex justify-content-start');

            var $litBrand = $litTopBarChild.find('.lit-brand');
            $litBrand.addClass('text-light');
            $litBrand.css({
                'transform': 'translateY(-5px)'
            });
            $litBrand.html('<i class="fas fa-laptop"></i>');

            var $homeLink = $('<a href="{!! config('app.url') !!}" target="_blank" class="mx-3 text-light"><i class="fas fa-home"></i></a>');
            $homeLink.appendTo($litTopBarChild);

        };

        onJqueryLoad(['layoutFixes']);

    </script>
@endpush
