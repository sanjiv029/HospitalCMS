@extends('layouts.admin')

@section('subtitle', 'Doctor Details')

@section('content_body')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Doctor Details</h3>
        </div>
        <div class="card-body">
            {{-- Bootstrap Tabs for navigating between sections --}}
            <ul class="nav nav-tabs" id="doctorDetailsTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="basic-info-tab" data-toggle="tab" href="#basic-info" role="tab" aria-controls="basic-info" aria-selected="true">Basic Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="false">Address</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="education-tab" data-toggle="tab" href="#education" role="tab" aria-controls="education" aria-selected="false">Education</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="experience-tab" data-toggle="tab" href="#experience" role="tab" aria-controls="experience" aria-selected="false">Experience</a>
                </li>
            </ul>

            <div class="tab-content mt-3" id="doctorDetailsTabContent">
                {{-- Basic Details --}}
                <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-left mb-4">
                                <div class="profile-image mb-2">
                                    <img src="{{ $doctor->profile_image }}" alt="{{ $doctor->name }}'s Profile Image" class="img-fluid rounded-circle border" style="max-width: 150px;">
                                </div>
                            </div>

                            <!-- Details Section Below the Image -->
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold" for="name"><i class="bi bi-person-fill"></i> Name:</label>
                                        <p>{{ $doctor->name }}</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="fw-bold" for="email"><i class="bi bi-envelope-fill"></i> Email:</label>
                                        <p>{{ $doctor->email }}</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="fw-bold" for="phone"><i class="bi bi-telephone-fill"></i> Phone Number:</label>
                                        <p>{{ $doctor->phone }}</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="fw-bold" for="gender"><i class="bi bi-gender-ambiguous"></i> Gender:</label>
                                        <p>{{ $doctor->gender }}</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="fw-bold" for="marital_status"><i class="bi bi-heart-fill"></i> Marital Status:</label>
                                        <p>{{ $doctor->marital_status }}</p>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold" for="department"><i class="bi bi-building"></i> Department:</label>
                                        <p>{{ $doctor->department->name }}</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="fw-bold" for="date_of_birth_ad"><i class="bi bi-calendar-date"></i> Date Of Birth (A.D):</label>
                                        <p>{{ $doctor->date_of_birth_ad }}</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="fw-bold" for="date_of_birth_bs"><i class="bi bi-calendar2-date"></i> Date Of Birth (B.S):</label>
                                        <p>{{ $doctor->date_of_birth_bs }}</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="fw-bold" for="status"><i class="bi bi-check-circle-fill"></i> Status:</label>
                                        <p>{{ $doctor->status }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Address Details --}}
                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <h5 class="text-primary"><i class="bi bi-geo-alt-fill"></i> Permanent Address</h5>
                                <p class="text-muted">
                                    <i class="bi bi-house-fill"></i> {{ $doctor->municipality->muni_name_en }}, {{ $doctor->district->district_english_name }}, {{ $doctor->province->english_name }} Province
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <h5 class="text-primary"><i class="bi bi-geo-alt-fill"></i> Temporary Address</h5>
                                <p class="text-muted">
                                    <i class="bi bi-house-door-fill"></i> {{ $doctor->temporaryMunicipality->muni_name_en ?? 'N/A' }}, {{ $doctor->temporaryDistrict->district_english_name ?? 'N/A' }}, {{ $doctor->temporaryProvince->english_name ?? 'N/A' }} Province
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Education Details --}}
                <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                    <h5 class="text-primary mb-3"><i class="bi bi-book-half"></i> Education Information</h5>
                    <div class="row">
                        @if(!empty($doctor->education))
                            @foreach($doctor->education as $education)
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label class="fw-bold text-muted"><i class="bi bi-mortarboard"></i> Degree:</label>
                                    <p>{{ $education['degree'] }} from {{ $education['institution'] }} ({{ $education['start_year'] }} - {{ $education['end_year'] }})</p>
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold text-muted"><i class="bi bi-geo-alt"></i> Address:</label>
                                    <p>{{ $education['address'] }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold text-muted"><i class="bi bi-file-earmark-text"></i> Education Certificates:</label>
                                    @if (!empty($education['edu_certificates']))
                                        <p>
                                            <a href="{{ asset($education['edu_certificates']) }}" target="_blank" class="btn btn-link p-0">
                                                <i class="bi bi-file-earmark-arrow-down"></i> View Certificate
                                            </a>
                                        </p>
                                    @else
                                        <p>No education certificates available.</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-muted">No education information available.</p>
                        @endif
                    </div>
                </div>

                {{-- Experience Details --}}
                <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                    <h5 class="text-primary mb-3"><i class="bi bi-briefcase-fill"></i> Experience Information</h5>
                    <div class="row">
                        @if(!empty($doctor->experience))
                            @foreach($doctor->experience as $experience)
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label class="fw-bold text-muted"><i class="bi bi-briefcase"></i> Job Title:</label>
                                    <p>{{ $experience['job_title'] }} at {{ $experience['healthcare_facilities'] }} ({{ $experience['start_date'] }} - {{ $experience['end_date'] }})</p>
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold text-muted"><i class="bi bi-people-fill"></i> Employment Type:</label>
                                    <p>{{ $experience['type_of_employment'] }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold text-muted"><i class="bi bi-geo-fill"></i> Location:</label>
                                    <p>{{ $experience['location'] }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold text-muted"><i class="bi bi-file-earmark-text"></i> Experience Certificates:</label>
                                    @if (!empty($experience['exp_certificates']))
                                        <p>
                                            <a href="{{ asset($experience['exp_certificates']) }}" target="_blank" class="btn btn-link p-0">
                                                <i class="bi bi-file-earmark-arrow-down"></i> View Certificate
                                            </a>
                                        </p>
                                    @else
                                        <p>No experience certificates available.</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-muted">No experience information available.</p>
                        @endif
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-3 text-start">
                    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning me-2"><i class="bi bi-pencil-fill"></i> Edit</a>
                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                    </form>
                    <a href="{{ route('doctors.index') }}" class="btn btn-secondary ms-2"><i class="bi bi-arrow-left-circle"></i> Back</a>
                </div>
        </div>
    </div>
@stop
