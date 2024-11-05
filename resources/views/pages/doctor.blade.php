@extends('layouts.web-template')

@section('content')
<div class="container position-relative py-4 my-5 bg-light border-top border-primary rounded" id="doctors">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Connect with Leading Healthcare Experts</h2>
            <p class="text-secondary">Over 200 experienced medical practitioners are ready to assist you via video consultation and appointments</p>
        </div>

        <!-- Doctor Cards -->
        <div class="row">
            @foreach($doctors as $doctor)
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="text-center p-3">
                            <img src="{{ $doctor->profile_image }}" alt="{{ $doctor->name }}'s Profile Image" class="img-fluid border border-primary rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-1 fw-semibold">Dr. {{ $doctor->name }}</h5>
                            <p class="card-text text-primary mb-3">{{ $doctor->department->name }}</p>
                            <form action="{{ route('appointments.time.slots.select') }}" method="POST">
                                @csrf
                                <input type="hidden" name="department_id" value="{{ $doctor->department->id }}">
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                <button type="submit" class="btn btn-primary btn-sm px-4">Book Appointment</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Back Button -->
        <div class="text-center mt-4">
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Back</a>
        </div>
</div>
@endsection
