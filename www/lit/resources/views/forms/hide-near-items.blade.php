@push('lit-styles')
    <style>
        #litstack .lit-near-items {
            display: none !important;
        }
    </style>
@endpush

@push('lit-scripts')
    <script>
        console.log( 'hide-near-items' );
    </script>
@endpush
