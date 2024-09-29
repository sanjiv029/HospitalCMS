@extends('layouts.admin')
@section('subtitle', $resourceName)
@section('content_header_title', $resourceName)
@stack('css')
@section('content_body')
    <div class="card mx-auto">
        <div class="card-header d-flex justify-content-left align-items-left flex-wrap">
            <a class="btn btn-primary mb-3" href="{{ route($resourceRoute .'.create') }}">Create</a>
        </div>
        {{-- Success Message --}}
        @if(session('success'))
            <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #e2f7e1; color: #155724;">
                  <strong>Success!</strong> {{ session('success') }}
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
