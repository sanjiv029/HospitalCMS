@extends('layouts.web-template')

@section('content')
<div class="container">
    <!-- Step 1 Heading -->
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
    <!-- Step 1: Find Doctor -->
    <div class="col-sm-6 col-md-4 mb-4 col-lg steps-section_list_item">
    <div class=" d-flex">
        <i class="fas fa-hospital fa-2x text-dark"></i>  <!-- Icon: Doctor -->
    </div>
    <div class=" mt-3">
        <h5 class="text-dark">Step 1: Select Department</h5>
        <p class="text-dark">Find the specialty you need in your area.</p>
    </div>
    </div>
    <form action="{{ route('appointments.doctors.select') }}" method="GET">
        @csrf
        <!-- Search Bar -->
        <div class="row mt-4">
            <div class="col-12">
                <input type="text" id="departmentSearch" class="form-control" placeholder="Search Department..." onkeyup="filterDepartments()" style="width: 200px;">
            </div>
        </div>

     <!-- Department Cards -->
<div class="row mt-4" id="departmentContainer">
    @foreach ($departments as $department)
    <div class="col-6 col-md-4 col-lg-3 mb-4 mt-4 department-card" data-department="{{ strtolower($department->name) }}">
        <div class="card h-100 shadow border-0 department-card-body" onclick="selectDepartment({{ $department->id }})">
            <div class="card-body p-4 mt-4 mb-4">
                <h5 class="title">{{ $department->name }}</h5>
                <p class="text mt-3">{{$department->description}}</p>
                <p class="text">Number of Doctors: {{ $department->doctor()->count() }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- Hidden Input to Store Selected Department -->
<input type="hidden" name="department_id" id="selectedDepartmentId" required>
<!-- Submit Button -->
<a href="{{ route('welcome') }}" class="btn btn-secondary mt-3">Back</a>
<button type="submit" class="btn btn-primary mt-3" id="nextButton" disabled>Next</button>

</form>

</div>
<!-- Inline JavaScript for Filtering and Selecting -->
<script>
    function selectDepartment(departmentId) {
        // Store the selected department in the hidden input
        document.getElementById('selectedDepartmentId').value = departmentId;

        // Remove the highlight from all department cards
        document.querySelectorAll('.department-card-body').forEach(card => {
            card.classList.remove('border-primary', 'bg-primary', 'text-light');
        });

        // Add the highlight to the selected department card
        const selectedCard = document.querySelector(`[onclick="selectDepartment(${departmentId})"]`);
        selectedCard.classList.add('border-primary', 'bg-primary', 'text-light');

        // Enable the Next button
        document.getElementById('nextButton').disabled = false;
    }

    function filterDepartments() {
        const searchInput = document.getElementById('departmentSearch').value.toLowerCase();
        const departments = document.querySelectorAll('.department-card');

        departments.forEach(department => {
            const departmentName = department.dataset.department;
            if (departmentName.includes(searchInput)) {
                department.style.display = '';
            } else {
                department.style.display = 'none';
            }
        });
    }
</script>
@endsection
