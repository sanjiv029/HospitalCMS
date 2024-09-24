@extends('layouts.admin')

@section('subtitle', '')
@section('content_header_title', '')

@section('content_body')
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-header">
            <h3 class="card-title">{{ isset($user) ? 'Edit User' : 'Create New User' }}</h3>
        </div>
        <div class="card-body" >
            <!-- Form Container to decrease width -->
            <div class="container"> <!-- max-width to control width -->
                <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
                    @csrf
                    @if(isset($user))
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

                    <!-- Name and Email Fields (Two in One Row) -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $user->name ?? '') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $user->email ?? '') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Password and Confirm Password Fields (Only for Creating New User) -->
                    @if(!isset($user))
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="passwordInput" class="form-control @error('password') is-invalid @enderror" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="confirmPasswordInput" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-eye" id="toggleConfirmPassword" style="cursor: pointer;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    @endif

                    <!-- Submit and Back Buttons -->
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary btn-block">{{ isset($user) ? 'Update' : 'Create' }}</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('components.eye_icon')
@endsection
