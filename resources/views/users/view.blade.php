@extends('layouts.admin')

@section('subtitle', 'User Details')

@section('content_body')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User Details</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <p>{{ $user->name }}</p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <p>{{ $user->email }}</p>
            </div>
            <div class="form-group">
                <label for="created_at">Created At</label>
                <p>{{ $user->created_at }}</p>
            </div>
            <div class="form-group">
                <label for="updated_at">Updated At</label>
                <p>{{ $user->updated_at }}</p>
            </div>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{route ('users.index')}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@stop
