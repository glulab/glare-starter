<div class="js-site-info-bottom-cookie d-none alert alert-dark alert-dismissible fade show fixed-bottom mb-0 px-4" role="alert">
    <div class="d-flex flex-column">
    <div>
        <div class="d-flex justify-content-between mb-2">
            <div class="h5">{!! $title !!}</div>
            <button type="button" class="close btn btn-link" data-dismiss="alert" aria-label="{!! $accept !!}"><i class="far fa-window-close"></i></button>
        </div>
        <div class="mb-1 text-justify">{!! $text !!}</div>
    </div>
    <button type="button" class="btn btn-primary js-accept w-auto" data-dismiss="alert" aria-label="{!! $accept !!}">{!! $accept !!}</button>
    </div>
</div>

@push('scripts')
    <script>

        function acceptInfoBottomCookie() {

            $('.js-site-info-bottom-cookie').removeClass('d-none');

            $('.js-site-info-bottom-cookie').on('click', '.js-accept', function () {
                window.axios.post('/site/info-bottom-cookie-accept')
                .then(function (response) {
                    console.log('response');
                    console.log(response.status);
                    console.log(response.data.status);
                })
                .catch(function (error) {
                    console.log('error');
                    console.log(error);
                })
                .then(function () {
                    console.log('always');
                });
            });
        };

        onJqueryLoad(['acceptInfoBottomCookie']);

    </script>
@endpush
