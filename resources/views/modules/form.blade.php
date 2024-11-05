@extends('layouts.admin')

@section('subtitle', '')
@section('content_header_title', '')

@section('content_body')
    <div class="card mx-auto" style="max-width:800px;">
        <div class="card-header">
            <h3 class="card-title">{{ isset($module) ? 'Edit Module' : 'Create New Module' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($module) ? route('modules.update', $module->id) : route('modules.store') }}" method="POST">
                @csrf
                @if(isset($module))
                    @method('PUT')
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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title" class="text-secondary">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $module->title ?? '') }}" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="slug" class="text-secondary">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $module->slug ?? '') }}">
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit and Back Buttons -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ isset($module) ? 'Update' : 'Create' }}</button>
                    <a href="{{ route('modules.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@stop
