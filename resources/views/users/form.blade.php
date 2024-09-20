@extends('layouts.admin')

@section('subtitle', '')
@section('content_header_title', '')

@section('content_body')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ isset($user) ? 'Edit User' : 'Create New User' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif
                {{-- Error message --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                 </ul>
                  </div>
                  @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
                </div>

                @if(!isset($user))
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Update' : 'Create' }}</button>
               <a href="{{route ('users.index')}}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@stop
