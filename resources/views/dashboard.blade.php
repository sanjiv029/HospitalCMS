@extends('layouts.admin')
@section('subtitle', 'Dashboard')

@section('content')
<div class="container mt-4">
    <h3>Welcome to Admin Dashboard</h3>
    <div class="text-end">
        <a href="{{ route('welcome') }}" class="text-dark">Go to Home Page</a>
    </div>
</div>
@endsection
