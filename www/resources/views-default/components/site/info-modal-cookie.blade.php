@push('modals')
<!-- Modal -->
<div class="modal fade" id="SiteInfoModalCookie" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="SiteInfoModalCookieLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title h5" id="SiteInfoModalCookieLabel">{!! $title !!}</div>
                <button type="button" class="close btn btn-link" data-dismiss="modal" aria-label="{!! $accept !!}"><i class="far fa-window-close"></i></button>
            </div>
            <div class="modal-body text-justify">
                <x-site.format-text :text="$text"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary js-accept" data-dismiss="modal" aria-label="Rozumiem">{!! $accept !!}</button>
            </div>
        </div>
    </div>
</div>
@endpush

@push('scripts')
    <script>

        function showSiteInfoModalCookie() {

            $('#SiteInfoModalCookie').modal('show');

            $('#SiteInfoModalCookie').on('click', '.js-accept', function () {
                window.axios.post('/site/info-modal-cookie-accept')
                .then(function (response) {
                    console.log('response');
                    console.log(response.status);
                    console.log(response.data.status);
                    // $('#SiteInfoModalCookie').modal('hide');
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

        onJqueryLoad(['showSiteInfoModalCookie']);

    </script>
@endpush
