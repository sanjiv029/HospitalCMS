@extends('layouts.admin')

@section('subtitle', 'Appointment Details')

@php
    use Carbon\Carbon;
@endphp

@section('content_body')
    <div class="container my-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Patient Appointment Details</h3>
            </div>

            <div class="card-body">
                <h4 class="text-secondary mb-3">Patient Information</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $patient->name }}</p>
                        <p><strong>Phone Number:</strong> {{ $patient->phone_number }}</p>
                        <p><strong>Email:</strong> {{ $patient->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Gender:</strong> {{ ucfirst($patient->gender) }}</p>
                        <p><strong>Age:</strong> {{ $patient->age }}</p>
                        <p><strong>Address:</strong> {{ $patient->address }}</p>
                    </div>
                    <div class="col-12">
                        <p><strong>Medical History:</strong> {{ $patient->medical_history ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mt-5 text-secondary">Appointments</h4>
        @foreach($patient->appointments as $appointment)
            <div class="card my-3 border-light shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Doctor:</strong> {{ $appointment->doctor->name }}</p>
                            <p><strong>Department:</strong> {{ $appointment->department->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Day:</strong> {{ $appointment->day }}</p>
                            @php
                            // Parse the start time and add 30 minutes to get the end time
                            $startTime = Carbon::parse($appointment->time_slot);
                            $endTime = $startTime->copy()->addMinutes(30);
                            @endphp
                            <p><strong>Time Slot:</strong> {{ $startTime->format('g:i A') }} - {{ $endTime->format('g:i A') }}</p>
                            <p><strong>Status:</strong>
                                <span class="badge text-capitalize badge-{{ $appointment->status === 'approved' ? 'success' : ($appointment->status === 'declined' ? 'danger' : 'warning') }}">
                                    {{ $appointment->status ?? 'pending' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
         {{-- Action Buttons --}}
         <div class="mt-3 text-start">
            <a href="{{ route('appointment.index') }}" class="btn btn-secondary ms-2"><i class="bi bi-arrow-left-circle"></i> Back</a>
            <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-warning me-2"><i class="bi bi-pencil-fill"></i> Edit</a>
            <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
            </form>
        </div>
    </div>
@endsection
