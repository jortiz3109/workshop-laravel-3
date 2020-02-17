@extends('layouts.admin')
@section('admin-content')
    <div class="card card-default">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ __('Index of products') }}</h5>
            @include('layouts.__search', ['route' => route('admin.products.index')])
        </div>
        <table class="table table-striped table-borderless">
            <thead>
                <tr>
                    <th scope="col">{{ __('Code') }}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Price') }}</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <div class="table-responsive">
                @forelse($products as $product)
                    <tr>
                        <td class="text-monospace">
                            {{ $product->code }}
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->priceFormatted() }}</td>
                        <td class="text-right">
                            <b-button-toolbar class="float-right">
                                <b-button-group size="sm">
                                    <b-button href="{{ route('admin.products.show', $product) }}" variant="link" data-balloon-pos="up" aria-label="{{ __('View') }}">
                                        <i aria-hidden="true" class="fas fa-fw fa-eye"></i>
                                    </b-button>
                                    <b-button href="{{ route('admin.products.edit', $product) }}" variant="link" data-balloon-pos="up" aria-label="{{ __('Edit') }}">
                                        <i aria-hidden="true" class="fas fa-fw fa-edit"></i>
                                    </b-button>
                                    <p-delete-button class="text-danger" variant="link" size="sm" action="{{ route('admin.products.destroy', $product) }}">
                                        <i aria-hidden="true" class="fas fa-fw fa-trash"></i>
                                    </p-delete-button>
                                </b-button-group>
                            </b-button-toolbar>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-3">
                            <p class="alert alert-secondary text-center">
                                {{ __('No products were found') }}
                            </p>
                        </td>
                    </tr>
                @endforelse
            </div>
            </tbody>
        </table>
    </div>
    @include('layouts.__paginator', ['paginator' => $products])
@endsection
@push('admin-left-top')
    <b-button variant="secondary" class="text-left" href="{{ route('admin.products.create') }}" block>
        <i class="fas fa-fw fa-plus"></i> {{ __('Create') }}
    </b-button>
    <hr>
@endpush
@include('layouts.__delete_modal')
