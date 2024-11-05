@extends('layouts.admin')

@section('subtitle', '')
@section('content_header_title', '')

@section('content_body')
    <div class="card mx-auto" style="max-width:800px;">
        <div class="card-header">
            <h3 class="card-title">{{ isset($page) ? 'Edit Page' : 'Create New Page' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($page) ? route('pages.update', $page->id) : route('pages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($page))
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
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $page->title ?? '') }}" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="slug" class="text-secondary">Slug <span class="text-danger">*</span></label>
                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $page->slug ?? '') }}" required>
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="date" class="text-secondary">Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $page->date ?? '') }}" required>
                            @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content" class="text-secondary">Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="5" required>{{ old('content', $page->content ?? '') }}</textarea>
                            @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="img" class="text-secondary">Image</label>
                            <input type="file" name="img" id="img" class="form-control @error('img') is-invalid @enderror" accept="image/*">
                            @if(isset($page) && $page->img)
                                <small>Current Image: <a href="{{ asset('storage/' . $page->img) }}" target="_blank">View</a></small>
                            @endif
                            @error('img') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit and Back Buttons -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ isset($page) ? 'Update' : 'Create' }}</button>
                    <a href="{{ route('pages.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@stop
