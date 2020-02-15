@extends('layouts.app')
@section('content')
    <div class="container-fluid row">
        <div class="col-2">
            @stack('admin-left-top')
            <b-list-group>
                <b-list-group-item
                    href="{{ route('admin.products.index') }}"
                    {{ App\Helpers\Nav::is('admin.products.index') ? 'active' : '' }}
                >
                    <i class="fas fa-fw fa-gift"></i> {{ __('Products') }}
                </b-list-group-item>
            </b-list-group>
            @stack('admin-left-bottom')
        </div>
        <div class="col-10">
            @include('layouts.__alert')
            @yield('admin-content')
        </div>
    </div>
@endsection
