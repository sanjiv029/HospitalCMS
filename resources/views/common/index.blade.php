@extends('layouts.admin')
@section('subtitle', $resourceName)
@section('content_header_title', $resourceName)

@section('content_body')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href=" {{ route($resourceRoute .'.create') }}">Create</a>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@stop

@push('js')
    @vite('resources/js/app.js')
    {{ $dataTable->scripts() }}
@endpush
