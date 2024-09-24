@extends('layouts.admin')

@section('subtitle', 'Doctor Details')

@section('content_body')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Doctor Details</h3>
        </div>
        <div class="card-body">
           {{--  <div class="text-center mb-4">
                <img src="{{ $doctor->profile_image ? asset('storage/' . $doctor->profile_image) : asset('default-profile.png') }}"
                     alt="Profile Picture"
                     class="rounded-circle"
                     style="width: 150px; height: 150px; object-fit: cover;">
            </div> --}}
            <div class="form-group">
                <label for="name">Name</label>
                <p>{{ $doctor->name }}</p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <p>{{ $doctor->email }}</p>
            </div>
            <div class="form-group">
                <label for="department">Department</label>
                <p>{{ $doctor->department->name }}</p>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <p>{{ $doctor->phone }}</p>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <p>
                    {{ $doctor->municipality->muni_name_en }}, {{ $doctor->district->district_english_name }},<br>
                    {{ $doctor->province->english_name }} Province
                </p>
            </div>

            <div class="form-group">
                <label for="date_of_birth_ad">Date Of Birth (A.D)</label>
                <p>{{ $doctor->date_of_birth_ad }}</p>
                <label for="date_of_birth_bs">Date Of Birth (B.S)</label>
                <p>{{ $doctor->date_of_birth_bs }}</p>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <p>{{ $doctor->status }}</p>
            </div>
            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{route('doctors.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@stop
