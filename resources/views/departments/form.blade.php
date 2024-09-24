@extends('layouts.admin')

@section('subtitle', '')
@section('content_header_title', '')

@section('content_body')
    <div class="card mx-auto" style="max-width:800px;">
        <div class="card-header">
            <h3 class="card-title">{{ isset($department) ? 'Edit Department' : 'Create New Department' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($department) ? route('departments.update', $department->id) : route('departments.store') }}" method="POST">
                @csrf
                @if(isset($department))
                    @method('PUT')
                @endif

                <!-- Common Error Message -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Name and Code Fields (Two in One Row) -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Department Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $department->name ?? '') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="code">Department Code</label>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror"
                                   value="{{ old('code', $department->code ?? '') }}" required>
                            @error('code')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Description Field (Full Row) -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Department Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description', $department->description ?? '') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit and Back Buttons -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ isset($department) ? 'Update' : 'Create' }}</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@stop
