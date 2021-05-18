@push('modals')
<!-- Modal -->
<div class="modal fade" id="SiteInfoModal" tabindex="-1" aria-labelledby="SiteInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title h5" id="SiteInfoModalLabel">{!! $title !!}</div>
                <button type="button" class="close btn btn-link" data-dismiss="modal" aria-label="Zamknij"><i class="far fa-window-close"></i></button>
            </div>
            <div class="modal-body text-justify">
                <x-site.format-text :text="$text"/>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal"><i class="far fa-window-close"></i></button>
            </div> --}}
        </div>
    </div>
</div>
@endpush

@push('scripts')
    <script>

        function showSiteInfoModal() {

            $('#SiteInfoModal').modal('show');
        };

        onJqueryLoad(['showSiteInfoModal']);

    </script>
@endpush
