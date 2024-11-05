@extends('layouts.admin')

@section('subtitle', 'Edit Appointment')

@php
    use Carbon\Carbon;
@endphp

@section('content_body')
    <div class="container my-4">
        <div class="card shadow">
            <div class="card-header bg-warning text-white">
                <h3 class="card-title mb-0">Edit Appointment</h3>
            </div>

            <form action="{{ route('appointment.update', $appointment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <h4 class="text-secondary mb-3">Patient Information</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"><strong>Name</strong></label>
                                <input type="text" class="form-control" id="name" value="{{ $patient->name }}" disabled>
                            </div>
                            <div class="form-group mt-3">
                                <label for="phone_number"><strong>Phone Number</strong></label>
                                <input type="text" class="form-control" id="phone_number" value="{{ $patient->phone_number }}" disabled>
                            </div>
                            <div class="form-group mt-3">
                                <label for="email"><strong>Email</strong></label>
                                <input type="email" class="form-control" id="email" value="{{ $patient->email }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender"><strong>Gender</strong></label>
                                <input type="text" class="form-control" id="gender" value="{{ ucfirst($patient->gender) }}" disabled>
                            </div>
                            <div class="form-group mt-3">
                                <label for="age"><strong>Age</strong></label>
                                <input type="text" class="form-control" id="age" value="{{ $patient->age }}" disabled>
                            </div>
                            <div class="form-group mt-3">
                                <label for="address"><strong>Address</strong></label>
                                <input type="text" class="form-control" id="address" value="{{ $patient->address }}" disabled>
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-5 text-secondary">Appointment Details</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="doctor_id"><strong>Doctor</strong></label>
                                <select name="doctor_id" id="doctor_id" class="form-control">
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="department_id"><strong>Department</strong></label>
                                <select name="department_id" id="department_id" class="form-control">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ $appointment->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="day"><strong>Day</strong></label>
                                <input type="text" class="form-control" id="day" name="day" value="{{ $appointment->day }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="time_slot"><strong>Time Slot</strong></label>
                                @php
                                    $startTime = Carbon::parse($appointment->time_slot);
                                    $endTime = $startTime->copy()->addMinutes(30);
                                @endphp
                                <input type="text" class="form-control" id="time_slot" name="time_slot" value="{{ $startTime->format('g:i A') }} - {{ $endTime->format('g:i A') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="status"><strong>Status</strong></label>
                                <select name="status" id="status" class="form-control">
                                    <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $appointment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="declined" {{ $appointment->status == 'declined' ? 'selected' : '' }}>Declined</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2"><i class="bi bi-save"></i> Save Changes</button>
                        <a href="{{ route('appointment.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
