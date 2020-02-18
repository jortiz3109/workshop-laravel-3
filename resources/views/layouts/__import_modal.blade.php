@push('modals')
<p-import-modal
    message="{{ $imporModalMessage ?? __('Import items from a file') }}"
    ok-text="{{ $importModalOkText ?? __('Import') }}"
    cancel-text="{{ $importModalCancelText ?? __('Cancel') }}"
    action="{{ $action }}"
    @error('import_file')
    error="{{ $message }}"
    @enderror
></p-import-modal>
@endpush
