<form action="{{ $route }}" method="get" class="ml-3">
    <div class="input-group input-group-sm">
        <input type="search" name="search" id="search" value="{{ Request::get('search') }}" placeholder="{{ __('fields.search.placeholder') }}" class="form-control form-control-sm">
        <div class="input-group-append">
            <button class="input-group-text" type="submit">
                <i aria-hidden="true" class="fas fa-fw fa-search"></i>
            </button>
        </div>
    </div>
</form>
