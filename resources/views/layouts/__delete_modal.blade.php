@push('modals')
<p-delete-modal
    message="{{ __('This action cannot be undone!') }}"
    ok-text="{{ __('Delete') }}"
    cancel-text="{{ __('Cancel') }}"
></p-delete-modal>
@endpush
