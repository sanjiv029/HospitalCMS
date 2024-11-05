@extends('layouts.web-template')

@section('content')
<div class="container mt-5">
    <h5 class="ms-2 text-dark">Step 4: Fill Out the Form</h5>
    <p class="text-dark">Enter basic details required for the appointment.</p>
    <form action="{{ route('appointments.store.info') }}" method="POST" class="shadow p-4 rounded bg-light">
        @csrf
        <input type="hidden" name="doctor_id" value="{{ $doctor_id }}">
        <input type="hidden" name="department_id" value="{{ $department_id }}">
        <input type="hidden" name="doctor_schedule_id" value="{{ $doctor_schedule_id }}">
        <input type="hidden" name="time_slot" value="{{ $time_slot }}">
        <input type="hidden" name="day" value="{{ $day }}">

        <div class="error">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="Enter patient's fullname">
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" name="age" class="form-control" required placeholder="Enter patient's age">
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone</label>
                    <input type="text" name="phone_number" class="form-control" required placeholder="Enter phone number" pattern="^(98|97|96)\d{8}$|^(01)\d{6,8}$" title="Phone must start with 98, 97, 96 (mobile) or 01 (landline).">
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" required placeholder="Enter address">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="Enter email address">
                </div>

                <div class="form-group">
                    <label for="medical_history">Medical History</label>
                    <textarea name="medical_history" class="form-control" rows="3" placeholder="Enter medical history (optional)"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-3 ">
                <a href="{{ route('appointments.book') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>
    </form>
</div>
@endsection
