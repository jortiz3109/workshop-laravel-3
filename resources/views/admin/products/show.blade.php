@extends('layouts.admin')
@section('admin-content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $product->name }}</h5>
            <b-button-toolbar key-nav aria-label="{{ __('Products toolbar') }}">
                <b-button-group class="ml-1">
                    <b-button href="{{ route('admin.products.edit', $product) }}" variant="success" size="sm">
                        <i class="fas fa-fw fa-edit"></i> {{ __('Edit') }}
                    </b-button>
                    <p-delete-button variant="danger" size="sm" action="{{ route('admin.products.destroy', $product) }}">
                        <i class="fas fa-fw fa-trash"></i> {{ __('Delete') }}
                    </p-delete-button>
                </b-button-group>
            </b-button-toolbar>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-md-3">{{ __('fields.name.label') }}</dt>
                <dd class="col-md-3">{{ $product->name }}</dd>
                <dt class="col-md-3">{{ __('fields.code.label') }}</dt>
                <dd class="col-md-3">{{ $product->code }}</dd>
                <dt class="col-md-3">{{ __('fields.price.label') }}</dt>
                <dd class="col-md-3">{{ $product->priceFormatted() }}</dd>
                <dt class="col-md-12">{{ __('fields.description.label') }}</dt>
                <dd class="col-md-12">{{ $product->description }}</dd>
            </dl>
        </div>
    </div>
@endsection
@push('admin-left-top')
    <b-button variant="secondary" class="text-left" href="{{ route('admin.products.index') }}" block>
        <i class="fas fa-fw fa-arrow-left"></i> {{ __('Back') }}
    </b-button>
    <b-button variant="secondary" class="text-left" href="{{ route('admin.products.create') }}" block>
        <i class="fas fa-fw fa-plus"></i> {{ __('Create') }}
    </b-button>
    <hr>
@endpush
@include('layouts.__delete_modal')
