@extends('layouts.admin')

@section('subtitle', 'Department')

@section('content_body')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Department Details</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <p>{{ $department->name }}</p>
            </div>
            <div class="form-group">
                <label for="code">Code</label>
                <p>{{ $department->code }}</p>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <p>{{ $department->description }}</p>
            </div>
            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{route ('departments.index')}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@stop
