<div class="mt-3 d-flex justify-content-between">
    <div class="flex-grow-0">
        {{ $paginator->appends(request()->only(['search', 'sort']))->links() }}
    </div>
    <div class="flex-grow-0">
        <b-dropdown size="sm" text="{{ request()->get('sort', config('app.sort_direction')) }}" right dropup no-caret lazy>
            @foreach($sortOptions as $option)
                <b-dropdown-item href="{{ route(
                    request()->route()->getName(),
                    array_merge(request()->only(['search']), ['sort' => $option])
                    ) }}">
                    {{ $option }}
                </b-dropdown-item>
            @endforeach
        </b-dropdown>
    </div>
</div>
