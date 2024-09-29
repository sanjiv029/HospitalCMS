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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <p>{{ $doctor->name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <p>{{ $doctor->email }}</p>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <p>{{ $doctor->phone }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department">Department:</label>
                                <p>{{ $doctor->department->name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth_ad">Date Of Birth (A.D):</label>
                                <p>{{ $doctor->date_of_birth_ad }}</p>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth_bs">Date Of Birth (B.S):</label>
                                <p>{{ $doctor->date_of_birth_bs }}</p>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <p>{{ $doctor->status }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Address Details --}}
                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="permanent_address"><i class="bi bi-geo-alt-fill"></i> Permanent Addres</label>
                                <p>{{ $doctor->municipality->muni_name_en }}, {{ $doctor->district->district_english_name }}, {{ $doctor->province->english_name }} Province</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="temporary_address"><i class="bi bi-geo-alt-fill"></i> Temporary Address</label>
                                <p>{{$doctor->temporaryMunicipality->muni_name_en ?? 'N/A' }}, {{ $doctor->temporaryDistrict->district_english_name ?? 'N/A' }}, {{ $doctor->temporaryProvince->english_name ?? 'N/A' }} Province</p>

                            </div>
                        </div>
                    </div>
                </div>


                        {{-- Education Details --}}
            <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                <h5>Education Information</h5>
                @if(!empty($doctor->education)) {{-- Assuming education is a JSON column --}}
                    @foreach(json_decode($doctor->education, true) as $education)
                        <div class="form-group">
                            <label for="degree">Degree:</label>
                            <p>{{ $education['degree'] }} from {{ $education['institution'] }} ({{ $education['start_year'] }} - {{ $education['end_year'] }})</p>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <p>{{ $education['address'] }}</p>
                        </div>
                    @endforeach
                @else
                    <p>No education information available.</p>
                @endif
            </div>

            {{-- Experience Details --}}
            <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                <h5>Experience Information</h5>
                @if(!empty($doctor->experience)) {{-- Assuming experience is a JSON column --}}
                    @foreach(json_decode($doctor->experience, true) as $experience)
                        <div class="form-group">
                            <label for="job_title">Job Title:</label>
                            <p>{{ $experience['job_title'] }} at {{ $experience['healthcare_facilities'] }} ({{ $experience['start_date'] }} - {{ $experience['end_date'] }})</p>
                        </div>
                        <div class="form-group">
                            <label for="employment_type">Employment Type</label>
                            <p>{{ $experience['type_of_employment'] }}</p>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <p>{{ $experience['location'] }}</p>
                        </div>
                    @endforeach
                @else
                    <p>No experience information available.</p>
                @endif
            </div>

            <div class="mt-3">
                <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@stop
