@extends('layouts.web-template')

@section('content')
<div class="container">
    <!-- Step 2 Heading -->
    <div class="row mb-3">
        <div class="col-xl-8">
            <h4 class="text-info mb-2">
                Access healthcare services anytime from anywhere with us
                <br>
                Follow these simple five steps
            </h4>
        </div>
    </div>
    <!-- Steps -->
    <div class="row steps-section_list justify-content-center text-dark">
        <div class="col-sm-6 col-md-4 mb-4 col-lg steps-section_list_item">
            <div class="d-flex">
                <i class="fas fa-user-md fa-2x text-dark"></i>
            </div>
            <div class="mt-3">
                <h5 class="text-dark">Step 2: Select Doctor</h5>
                <p class="text-dark">Find a doctor of the specialty you need in your area.</p>
            </div>
        </div>
        <form action="{{ route('appointments.time.slots.select') }}" method="POST">
            @csrf
            <!-- Hidden input to store the selected department ID, if applicable -->
            <input type="hidden" name="department_id" value="{{ request()->get('department_id', '') }}">

            <!-- Search Bar -->
            <div class="row mt-4">
                <div class="col-12 text-end">
                    <input type="text" id="doctorSearch" class="form-control d-inline-block" placeholder="Search Doctor..." onkeyup="filterDoctors()" style="width: 200px;">
                </div>
            </div>

            <!-- Doctor Cards -->
            <div class="row mt-4" id="doctorContainer" style="background-color: #f8f9fa; border-top: 2px solid #dcdcdc; padding: 20px;">
                @if($doctors->isEmpty())
                    <div class="col-12">
                        <p class="text-muted text-center">No doctor available</p>
                    </div>
                @else
                    @foreach ($doctors as $doctor)
                    <div class="col-6 col-md-4 col-lg-3 mb-4 mt-4 doctor-card" data-doctor="{{ strtolower($doctor->name) }}">
                        <div class="card h-100 shadow border-0 doctor-card-body" onclick="selectDoctor({{ $doctor->id }})">
                            <div class="card-body p-4 mt-4 mb-4">
                                <div class="profile-image mb-2 mt-4 text-center">
                                    <img src="{{ $doctor->profile_image }}" alt="{{ $doctor->name }}'s Profile Image" class="img-fluid border" style="max-width: 150px;">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">Dr. {{ $doctor->name }}</h5>
                                    <p class="card-text">Department: {{ $doctor->department->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            <input type="hidden" name="doctor_id" id="selectedDoctorId" required>

            <a href="{{ route('appointments.book') }}" class="btn btn-secondary mt-3">Back</a>
            <button type="submit" class="btn btn-primary mt-3" id="nextButton" disabled>Next</button>

        </form>
    </div>

    <!-- Inline JavaScript for Filtering and Selecting -->
    <script>
        function selectDoctor(doctorId) {
            // Store the selected doctor in the hidden input
            document.getElementById('selectedDoctorId').value = doctorId;

            // Highlight the selected card
            document.querySelectorAll('.doctor-card-body').forEach(card => {
                card.classList.remove('border-primary', 'bg-primary', 'text-white');
            });
            document.querySelector(`[onclick="selectDoctor(${doctorId})"]`).classList.add('border-primary', 'bg-primary', 'text-white');

            // Enable the Next button
            document.getElementById('nextButton').disabled = false;
        }

        function filterDoctors() {
            const searchInput = document.getElementById('doctorSearch').value.toLowerCase();
            const doctors = document.querySelectorAll('.doctor-card');

            doctors.forEach(doctor => {
                const doctorName = doctor.dataset.doctor;
                if (doctorName.includes(searchInput)) {
                    doctor.style.display = '';
                } else {
                    doctor.style.display = 'none';
                }
            });
        }
    </script>
</div>
@endsection
