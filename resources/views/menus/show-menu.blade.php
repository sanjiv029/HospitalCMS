@extends('layouts.admin')

@section('subtitle', '')
@section('content_header_title', 'Dynamic Menu')

@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style>
    .menu-container {
        max-width: 500px; /* Set a max width for the menu */
        background-color: #f8f9fa; /* Light background color */
        border: 1px solid #dee2e6; /* Border for separation */
        padding: 15px; /* Padding for the container */
        border-radius: .35rem;
    }
    .menu-item {
        padding: 10px;
        border-radius: .25rem;
        transition: background-color 0.3s;
        position: relative; /* For absolute positioning of child menus */
    }
    .menu-item:hover {
        background-color: #e2e6ea; /* Highlight on hover */
    }
    .child-menu {
        margin-left: 20px; /* Indent child menus */
        border-left: 1px solid #ccc; /* Line connecting to parent */
        padding-left: 10px; /* Space between line and text */
    }
    .action-buttons {
        position: absolute; /* Position buttons at the right */
        right: 10px;
        top: 10px;
    }
    .menu-link {
        text-decoration: none;
        color: inherit; /* Inherit color from parent */
    }
</style>
@endpush

@section('content_body')
<div class="container mt-4">
    <div class="card shadow-lg mx-auto">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3 px-4" style="border-radius: .35rem;">
           <h3>Menu Management</h3>

            <a class="btn btn-light text-dark" href="{{ route('menus.create') }}" style="text-decoration: none; font-weight: 500; padding: 8px 12px; border-radius: .35rem;">
                <i class="fas fa-plus mr-2" style="color: #007bff;"></i> Add New Menu
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
        <div id="success-message" class="alert alert-success alert-dismissible fade show my-3" role="alert">
            <strong><i class="fas fa-check-circle"></i> Success!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
        <div id="error-message" class="alert alert-danger alert-dismissible fade show my-3" role="alert">
            <strong><i class="fas fa-exclamation-triangle"></i> Error!</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card-body">
            <div class="menu-container">
                @include('menus.partials.menu-item', ['menus' => $menus])
            </div>
        </div>
    </div>
    <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back</a>
</div>

@push('js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@endpush
@endsection
