@if(session()->has('success'))
    <p-alert variant="success" dismiss="0">
        <p>{{ session('success') }}</p>
    </p-alert>
@endif

@if(session()->has('info'))
    <p-alert variant="info" dismiss="0">
        <p>{{ session('info') }}</p>
    </p-alert>
@endif

@if ($errors->any())
    <p-alert variant="danger" dismiss="0">
        <p>{{ __('Errors were found while processing your request') }}</p>
    </p-alert>
@endif
