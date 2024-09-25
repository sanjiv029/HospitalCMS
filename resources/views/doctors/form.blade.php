@extends('layouts.admin')

@section('content_header_title', '')
@stack('css')
@section('content_body')

<div class="card mx-auto mt mt-2" style="max-width: 1000px;">
    <div class="card-header">
        <h3 class="card-title">{{ isset($doctor) ? 'Edit Doctor' : 'Add a New Doctor' }}</h3>
    </div>

    <div class="card-body">
        <form id="doctorForm" action="{{ isset($doctor) ? route('doctors.update', $doctor->id) : route('doctors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($doctor))
                @method('PUT')
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <!-- Step 1: Basic Information -->
            <div class="step" id="step1">
                <h5>Basic Information</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="">Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $doctor->name ?? '') }}" required>
                        </div>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                      <!-- Phone Field -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $doctor->phone ?? '') }}" required>
                    </div>
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                  <!-- Department Field -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="department_id">Department</label>
                        <select name="department_id" id="department_id" class="form-control select2 @error('department_id') is-invalid @enderror">
                            <option value="">Select a Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id', $doctor->department_id ?? '') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('department_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                 <!-- Date of Birth Field in B.S. -->
                <div class="col-md-6">
                     <div class="form-group">
                        <label for="date_of_birth_bs">Date of Birth (B.S)</label>
                        <input type="text" name="date_of_birth_bs" id="nepali-datepicker" class="form-control @error('date_of_birth_bs') is-invalid @enderror" value="{{ old('date_of_birth_bs', $doctor->date_of_birth_bs ?? '') }}" placeholder="YYYY-MM-DD">
                        <input type="hidden" name="date_of_birth_ad" id="date_of_birth_ad" class="form-control @error('date_of_birth_ad') is-invalid @enderror" value="{{ old('date_of_birth_ad', $doctor->date_of_birth ?? '') }}">
                     </div>
                     @error('date_of_birth_bs') <div class="invalid-feedback">{{ $message }}</div> @enderror
                     @error('date_of_birth_ad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                 <!-- Status Field -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="active" {{ old('status', $doctor->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $doctor->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    @error('statuss') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                </div>
                <a href="{{route('doctors.index') }}" class="btn btn-secondary">Back</a>
                <button type="button" class="btn btn-primary" onclick="nextStep(1)">Next</button>
                </div>

                    <!-- Step 2: Address Information -->
            <div class="step" id="step2" style="display:none;">
                <h2>Address Information</h2>

                <!-- Permanent Address Section -->
                <div class="row mt-4">
                    <h4 class="col-12 section-header">Permanent Address</h4>

                    <!-- Province Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="province_id"><i class="bi bi-geo-alt-fill"></i> Province</label>
                            <select name="province_id" id="province_id" class="form-control custom-select-icon" required>
                                <option value="">Select a province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" {{ old('province_id', $doctor->province_id ?? '') == $province->id ? 'selected' : '' }}>
                                        {{ $province->english_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('province_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- District Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="district_id"><i class="bi bi-building"></i> District</label>
                            <select name="district_id" id="district_id" class="form-control custom-select-icon" required>
                                <option value="">Select a district</option>
                                @foreach ($districts as $district)
                                    <option class="district-option" {{ old('district_id', $doctor->district_id ?? '') == $district->id ? 'selected' : '' }} data-province="{{ $district->province_id }}" value="{{ $district->id }}">
                                        {{ $district->district_english_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('district_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Municipality Type Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="muni_type_id"><i class="bi bi-map"></i> Municipality Type</label>
                            <select name="municipality_type_id" id="muni_type_id" class="form-control custom-select-icon" required>
                                <option value="">Select a municipality type</option>
                                @foreach ($municipality_types as $municipality_type)
                                    <option value="{{ $municipality_type->id }}" {{ old('municipality_type_id', $doctor->municipality_type_id ?? '') == $municipality_type->id ? 'selected' : '' }}>
                                        {{ $municipality_type->muni_type_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Municipality Name Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="municipality_id"><i class="bi bi-pin-map"></i> Municipality Name</label>
                            <select name="municipality_id" id="municipality_id" class="form-control custom-select-icon" required>
                                <option value="">Select a municipality</option>
                                @foreach ($municipalities as $municipality)
                                    <option class="muni-option" data-district="{{ $municipality->district_id }}" data-muni-type="{{ $municipality->muni_type_id }}" value="{{ $municipality->id }}" {{ old('municipality_id', $doctor->municipality_id ?? '') == $municipality->id ? 'selected' : '' }}>
                                        {{ $municipality->muni_name_en }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Temporary Address Section -->
                <div class="row mt-4">
                    <h4 class="col-12 section-header">Temporary Address</h4>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="same_as_permanent" onclick="copyAddress()">
                        <label class="form-check-label" for="same_as_permanent"><i class="bi bi-arrow-repeat"></i> Temporary address is the same as permanent address</label>
                    </div>

                    <!-- Temporary Province Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="temporary_province_id"><i class="bi bi-geo-alt-fill"></i> Province</label>
                            <select name="temporary_province_id" id="temporary_province_id" class="form-control custom-select-icon" required>
                                <option value="">Select a province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" {{ old('temporary_province_id', $doctor->temporary_province_id ?? '') == $province->id ? 'selected' : '' }}>
                                        {{ $province->english_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('temporary_province_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Temporary District Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="temporary_district_id"><i class="bi bi-building"></i> District</label>
                            <select name="temporary_district_id" id="temporary_district_id" class="form-control custom-select-icon" required>
                                <option value="">Select a district</option>
                                @foreach ($districts as $district)
                                    <option class="district-option" {{ old('temporary_district_id', $doctor->temporary_district_id ?? '') == $district->id ? 'selected' : '' }} data-province="{{ $district->province_id }}" value="{{ $district->id }}">
                                        {{ $district->district_english_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('temporary_district_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Temporary Municipality Type Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="temporary_municipality_type_id"><i class="bi bi-map"></i> Municipality Type</label>
                            <select name="temporary_municipality_type_id" id="temporary_municipality_type_id" class="form-control custom-select-icon" required>
                                <option value="">Select a municipality type</option>
                                @foreach ($municipality_types as $municipality_type)
                                    <option value="{{ $municipality_type->id }}" {{ old('temporary_municipality_type_id', $doctor->temporary_municipality_type_id ?? '') == $municipality_type->id ? 'selected' : '' }}>
                                        {{ $municipality_type->muni_type_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('temporary_municipality_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Temporary Municipality Name Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="temporary_municipality_id"><i class="bi bi-pin-map"></i> Municipality Name</label>
                            <select name="temporary_municipality_id" id="temporary_municipality_id" class="form-control custom-select-icon" required>
                                <option value="">Select a municipality</option>
                                @foreach ($municipalities as $municipality)
                                    <option class="muni-option" data-district="{{ $municipality->district_id }}" data-muni-type="{{ $municipality->muni_type_id }}" value="{{ $municipality->id }}" {{ old('temporary_municipality_id', $doctor->temporary_municipality_id ?? '') == $municipality->id ? 'selected' : '' }}>
                                        {{ $municipality->muni_name_en }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('temporary_municipality_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Navigation Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(2)"><i class="bi bi-arrow-left"></i> Back</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(2)"><i class="bi bi-arrow-right"></i> Next</button>
                </div>
            </div>


            <!-- Step 3: Education Details -->
            <div class="step" id="step3" style="display:none;">
                <h5>Education Details</h5>
                {{-- @error('') <div class="invalid-feedback">{{ $message }}</div> @enderror --}}
                <!-- Add education fields here -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="degree">Degree</label>
                            <select name="degree" id="degree" class="form-control @error('degree') is-invalid @enderror" required>
                                <option value="" disabled selected>Select Degree</option>
                                <option value="MBBS" {{ old('degree', $education->degree ?? '') == 'MBBS' ? 'selected' : '' }}>MBBS</option>
                                <option value="MD" {{ old('degree', $education->degree ?? '') == 'MD' ? 'selected' : '' }}>MD</option>
                                <option value="MS" {{ old('degree', $education->degree ?? '') == 'MS' ? 'selected' : '' }}>MS</option>
                                <option value="BDS" {{ old('degree', $education->degree ?? '') == 'BDS' ? 'selected' : '' }}>BDS</option>
                                <option value="MDS" {{ old('degree', $education->degree ?? '') == 'MDS' ? 'selected' : '' }}>MDS</option>
                                <option value="PhD" {{ old('degree', $education->degree ?? '') == 'PhD' ? 'selected' : '' }}>PhD</option>
                            </select>
                        </div>
                    </div>

                        <div class="form-group col-md-6">
                            <label for="institution">Institution</label>
                          <input type="text" name="institution" id="institution" class="form-control @error('institution') is-invalid @enderror" value="{{ old('institution', $education->institution ?? '') }}"  required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                          <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $education->address ?? '') }}"  required>
                        </div>


                        <div class="form-group">
                            <label for="field_of_study">Field of Study</label>
                          <input type="text" name="field_of_study" id="field_of_study" class="form-control @error('field_of_study') is-invalid @enderror" value="{{ old('field_of_study', $education->field_of_study ?? '') }}"  required>
                        </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_year">Start year</label>
                          <input type="date" name="start_year" id="start_year" class="form-control @error('start_year') is-invalid @enderror" value="{{ old('start_year', $education->start_year ?? '') }}"  required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_year">End year</label>
                          <input type="date" name="end_year" id="end_year" class="form-control @error('end_year') is-invalid @enderror" value="{{ old('end_year', $education->end_year ?? '') }}">
                        </div>
                    </div>

                        <div class="form-group col-md-6">
                            <label for="edu_certificates">Certification</label>
                          <input type="file" name="edu_certificates" id="edu_certificates" class="form-control @error('edu_certificates') is-invalid @enderror" value="{{ old('edu_certificates', $education->edu_certificates ?? '') }}">
                        </div>


                        <div class="form-group ">
                            <label for="additional_information">Additional Details</label>
                        <textarea name="additional_information" id="additional_information" cols="5" rows="3" class="form-control @error('additional_information') is-inavlid @enderror" value= "{{ old('additional_information', $education->additional_information ?? '')}}" ></textarea>
                        </div>

                </div>

                <button type="button" class="btn btn-secondary" onclick="prevStep(3)">Back</button>
                <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
            </div>

            <!-- Step 4: Experience -->
            <div class="step" id="step4" style="display:none;">
                <h5>Experience</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="job_title">Job Title</label>
                          <input type="text" name="job_title" id="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ old('job_title' ,$experience->job_title ?? '')}}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="healthcare_facilities">Healthcare Facilities</label>
                          <input type="text" name="healthcare_facilities" id="healthcare_facilities" class="form-control @error('healthcare_facilities') is-invalid @enderror" value="{{ old('healthcare_facilities' ,$experience->healthcare_facilities ?? '')}}" required>
                        </div>
                    </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                          <input type="text" name="location" id="location" class="form-control @error('location') is_invalid @enderror" value="{{ old('location',$experience->location ?? '')}}" required>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="type_of_employment">Type of Employment</label>
                            <select id="type_of_employment" name="type_of_employment" class="form-control">
                                <option value="">--Select Employment Type--</option>
                                <option value="full_time" {{ old('type_of_employment', $experience->type_of_employment ?? '') == 'full_time' ? 'selected' : '' }}>Full-Time</option>
                                <option value="part_time" {{ old('type_of_employment', $experience->type_of_employment ?? '') == 'part_time' ? 'selected' : '' }}>Part-Time</option>
                                <option value="consultant" {{ old('type_of_employment', $experience->type_of_employment ?? '') == 'consultant' ? 'selected' : '' }}>Consultant</option>
                                <option value="contract" {{ old('type_of_employment', $experience->type_of_employment ?? '') == 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="temporary" {{ old('type_of_employment', $experience->type_of_employment ?? '') == 'temporary' ? 'selected' : '' }}>Temporary</option>
                                <option value="intern" {{ old('type_of_employment', $experience->type_of_employment ?? '') == 'intern' ? 'selected' : '' }}>Intern</option>
                            </select>
                        </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Start date</label>
                          <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{old('start_date',$experience->start_date ?? '')}}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">End date</label>
                          <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{old('end_date',$experience->end_date ?? '')}}">
                        </div>
                    </div>

                        <div class="form-group">
                            <label for="exp_certificates">Certification</label>
                          <input type="file" name="exp_certificates" id="exp_certificates" class="form-control @error('exp_certificates') is-invalid @enderror" value="{{ old('exp_certificates',$experience->exp_certificates ?? '')}}">
                        </div>


                        <div class="form-group">
                            <label for="additional_details">Additional Details</label>
                        <textarea name="additional_details" id="additional_details" cols="5" rows="3" class="form-control @error('additional_details') is-invalid @enderror" value="{{old('additional_details', $experience->additional_details ?? '')}}"></textarea>
                        </div>
                </div>
                <button type="button" class="btn btn-secondary" onclick="prevStep(4)">Back</button>
                <button type="button" class="btn btn-primary" onclick="nextStep(4)">Next</button>
            </div>

            <!-- Step 5: Confirm and Submit -->
            <div class="step" id="step5" style="display:none;">
                <h5 class="mt-4">Login Credentials</h5>
                <div class="row">
                    <!-- Email Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $doctor->email ?? '') }}" required>
                        </div>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    @if(!isset($doctor))
                    <!-- Password Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" id="passwordInput" name="password" class="form-control @error('password') is-invalid @enderror">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></span>
                                    </div>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" id="confirmPasswordInput" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-eye" id="toggleConfirmPassword" style="cursor: pointer;"></span>
                                    </div>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    @endif
                </div>

                <button type="button" class="btn btn-secondary" onclick="prevStep(5)">Back</button>
                <button type="submit" class="btn btn-primary">{{ isset($doctor) ? 'Update' : 'Create' }}</button>
            </div>
        </form>
    </div>
</div>
@stack('js')
@include('components.step-widget')
@include('components.datepicker')
@include('components.address-nepali')
@include('components.eye_icon')
@endsection
