@extends('layouts.admin')
@section('subtitle', "Menus")
@section('content_header_title', "Menus")
@stack('css')
@section('content_body')
    <div class="card mx-auto">
        <div class="card-header d-flex justify-content-left align-items-left flex-wrap">
            <a class="btn btn-primary mb-3 mr-4" href="{{ route('menus.create') }}">Create</a>
            <a class="btn btn-primary mb-3" href="{{ route('dynamic.menus.showMenu') }}">Dynamic Menu</a>
        </div>
        {{-- Success Message --}}
        @if(session('success'))
        <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
        <div id="error-message" class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table(['class' => 'table table-striped table-bordered']) }}
            </div>
        </div>
    </div>
@stop

@push('js')
    {{ $dataTable->scripts() }}
@endpush
