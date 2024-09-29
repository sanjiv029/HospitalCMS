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
            <h5 class="text-primary"><i class="bi bi-person-fill"></i> Basic Information</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="text-secondary">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $doctor->name ?? '') }}" required>
                    </div>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone" class="text-secondary">Phone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $doctor->phone ?? '') }}" required>
                    </div>
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="department_id" class="text-secondary">Department <span class="text-danger">*</span></label>
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_of_birth_bs" class="text-secondary">Date of Birth (BS) <span class="text-danger">*</span></label>
                        <input type="text" name="date_of_birth_bs" id="nepali-datepicker" class="form-control @error('date_of_birth_bs') is-invalid @enderror" value="{{ old('date_of_birth_bs', $doctor->date_of_birth_bs ?? '') }}" placeholder="YYYY-MM-DD">
                        <input type="hidden" name="date_of_birth_ad" id="date_of_birth_ad" class="form-control @error('date_of_birth_ad') is-invalid @enderror" value="{{ old('date_of_birth_ad', $doctor->date_of_birth ?? '') }}">
                    </div>
                    @error('date_of_birth_bs') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @error('date_of_birth_ad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status" class="text-secondary">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="active" {{ old('status', $doctor->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $doctor->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="{{route('doctors.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                 <button type="button" class="btn btn-primary" onclick="nextStep(1)"><i class="bi bi-arrow-right"></i> Next</button>
            </div>

        </div>

        <!-- Step 2: Address Information -->
        <div class="step" id="step2" style="display:none;">
            <h2 class="text-primary"><i class="bi bi-house-fill"></i> Address Information</h2>

            <div class="row mt-4">
                <h4 class="col-12 section-header text-secondary">Permanent Address</h4>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="province_id"><i class="bi bi-geo-alt-fill"></i> Province <span class="text-danger">*</span></label>
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

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="district_id"><i class="bi bi-building"></i> District <span class="text-danger">*</span></label>
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

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="muni_type_id"><i class="bi bi-map"></i> Municipality Type <span class="text-danger">*</span></label>
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

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="municipality_id"><i class="bi bi-pin-map"></i> Municipality Name <span class="text-danger">*</span></label>
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

            <div class="row mt-4">
                <h4 class="col-12 section-header text-secondary">Temporary Address</h4>

                <div class="form-check my-3 ml-4">
                    <input type="checkbox" class="form-check-input" id="same_as_permanent" onclick="copyAddress()">
                    <label class="form-check-label" for="same_as_permanent"><i class="bi bi-arrow-repeat"></i> Temporary address is the same as permanent address</label>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="temporary_province_id"><i class="bi bi-geo-alt-fill"></i> Province <span class="text-danger">*</span></label>
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

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="temporary_district_id"><i class="bi bi-building"></i> District <span class="text-danger">*</span></label>
                        <select name="temporary_district_id" id="temporary_district_id" class="form-control custom-select-icon" required>
                            <option value="">Select a district</option>
                            @foreach ($districts as $district)
                                <option class="temporary-district-option" data-province="{{ $district->province_id }}" value="{{ $district->id }}" {{ old('temporary_district_id', $doctor->temporary_district_id ?? '') == $district->id ? 'selected' : '' }}>{{ $district->district_english_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('temporary_district_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="temporary_municipality_type_id"><i class="bi bi-map"></i> Municipality Type <span class="text-danger">*</span></label>
                        <select name="temporary_municipality_type_id" id="temporary_municipality_type_id" class="form-control custom-select-icon" required>
                            <option value="">Select a municipality type</option>
                            @foreach ($municipality_types as $municipality_type)
                                <option value="{{ $municipality_type->id }}" {{ old('temporary_municipality_type_id', $doctor->temporary_municipality_type_id ?? '') == $municipality_type->id ? 'selected' : '' }}>
                                    {{ $municipality_type->muni_type_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="temporary_municipality_id"><i class="bi bi-pin-map"></i> Municipality Name <span class="text-danger">*</span></label>
                        <select name="temporary_municipality_id" id="temporary_municipality_id" class="form-control custom-select-icon" required>
                            <option value="">Select a municipality</option>
                            @foreach ($municipalities as $municipality)
                                <option class="temporary-municipality-option" data-district="{{ $municipality->district_id }}" data-muni-type="{{ $municipality->muni_type_id }}" value="{{ $municipality->id }}" {{ old('temporary_municipality_id', $doctor->temporary_municipality_id ?? '') == $municipality->id ? 'selected' : '' }}>
                                    {{ $municipality->muni_name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="javascript:void(0)" class="btn btn-outline-secondary" onclick="prevStep(2)"><i class="bi bi-arrow-left"></i> Back</a>
                <button type="button" class="btn btn-primary" onclick="nextStep(2)"><i class="bi bi-arrow-right"></i> Next</button>
            </div>
        </div>
       <!-- Step 3: Education Details -->
<div class="step" id="step3" style="display:none;">
    <h5 class="text-primary"><i class="fas fa-graduation-cap"></i> Education Details</h5>
    <div class="row" id="education-fields">
        <div class="col-md-6">
            <div class="form-group">
                <label for="degree" class="text-secondary">Degree</label>
                <select name="degree[]" id="degree" class="form-control @error('degree') is-invalid @enderror" required>
                    <option value="" disabled selected>Select Degree</option>
                    <option value="MBBS" {{ old('degree.0', $education->degree ?? '') == 'MBBS' ? 'selected' : '' }}>MBBS</option>
                    <option value="MD" {{ old('degree.0', $education->degree ?? '') == 'MD' ? 'selected' : '' }}>MD</option>
                    <option value="MS" {{ old('degree.0', $education->degree ?? '') == 'MS' ? 'selected' : '' }}>MS</option>
                    <option value="BDS" {{ old('degree.0', $education->degree ?? '') == 'BDS' ? 'selected' : '' }}>BDS</option>
                    <option value="MDS" {{ old('degree.0', $education->degree ?? '') == 'MDS' ? 'selected' : '' }}>MDS</option>
                    <option value="PhD" {{ old('degree.0', $education->degree ?? '') == 'PhD' ? 'selected' : '' }}>PhD</option>
                </select>
                @error('degree.0')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="institution" class="text-secondary">Institution</label>
                <input type="text" name="institution[]" id="institution" class="form-control @error('institution') is-invalid @enderror" value="{{ old('institution.0', $education->institution ?? '') }}" required>
                @error('institution.0')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="address" class="text-secondary">Address</label>
                <input type="text" name="address[]" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address.0', $education->address ?? '') }}" required>
                @error('address.0')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="field_of_study" class="text-secondary">Field of Study</label>
                <input type="text" name="field_of_study[]" id="field_of_study" class="form-control @error('field_of_study') is-invalid @enderror" value="{{ old('field_of_study.0', $education->field_of_study ?? '') }}" required>
                @error('field_of_study.0')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="start_year_bs" class="text-secondary">Start Date (BS)</label>
                <input type="text" name="start_year_bs[]" id="nepali-datepicker-start" class="form-control @error('start_year_bs') is-invalid @enderror" value="{{ old('start_year_bs.0', $education->start_year_bs ?? '') }}" placeholder="YYYY-MM-DD">
                <input type="hidden" name="start_year[]" id="start_year" class="form-control" value="{{ old('start_year.0', $education->start_year ?? '') }}" required>
                @error('start_year_bs.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
                @error('start_year.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="end_year_bs" class="text-secondary">End Date (BS)</label>
                <input type="text" name="end_year_bs[]" id="nepali-datepicker-end" class="form-control @error('end_year_bs') is-invalid @enderror" value="{{ old('end_year_bs.0', $education->end_year_bs ?? '') }}" placeholder="YYYY-MM-DD">
                <input type="hidden" name="end_year[]" id="end_year" class="form-control" value="{{ old('end_year.0', $education->end_year ?? '') }}">
                @error('end_year_bs.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
                @error('end_year.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="edu_certificates" class="text-secondary">Certification <i class="fas fa-file-upload"></i></label>
                <input type="file" name="edu_certificates[]" id="edu_certificates" class="form-control @error('edu_certificates') is-invalid @enderror" value="{{ old('edu_certificates.0', $education->edu_certificates ?? '') }}">
                @error('edu_certificates.0')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="additional_information" class="text-secondary">Additional Details</label>
                <textarea name="additional_information[]" id="additional_information" cols="5" rows="3" class="form-control @error('additional_information') is-invalid @enderror">{{ old('additional_information.0', $education->additional_information ?? '') }}</textarea>
                @error('additional_information.0')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-4">
        <a href="javascript:void(0)" class="btn btn-outline-secondary" onclick="prevStep(3)"><i class="bi bi-arrow-left"></i> Back</a>
        <button type="button" class="btn btn-primary" onclick="nextStep(3)"><i class="bi bi-arrow-right"></i> Next</button>
    </div>
</div>

<!-- Step 4: Experience Details -->
<div class="step" id="step4" style="display:none;">
    <h5 class="text-primary"><i class="fas fa-briefcase"></i> Experience Details</h5>
    <div class="row" id="experience-fields">
        <div class="col-md-6">
            <div class="form-group">
                <label for="type_of_employment" class="text-secondary">Type of Employment</label>
                <select name="type_of_employment[]" id="type_of_employment" class="form-control @error('type_of_employment') is-invalid @enderror" required>
                    <option value="" disabled selected>Select Employment Type</option>
                    <option value="Full-time" {{ old('type_of_employment.0', $experience->type_of_employment ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('type_of_employment.0', $experience->type_of_employment ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ old('type_of_employment.0', $experience->type_of_employment ?? '') == 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Internship" {{ old('type_of_employment.0', $experience->type_of_employment ?? '') == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('type_of_employment.0')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="job_title" class="text-secondary">Job Title</label>
                <input type="text" name="job_title[]" id="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ old('job_title.0', $experience->job_title ?? '') }}" required>
                @error('job_title.0')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="healthcare_facilities" class="text-secondary">Healthcare Facility</label>
                <input type="text" name="healthcare_facilities[]" id="healthcare_facilities" class="form-control @error('healthcare_facilities') is-invalid @enderror" value="{{ old('healthcare_facilities.0', $experience->healthcare_facilities ?? '') }}" required>
                @error('healthcare_facilities.0')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="location" class="text-secondary">Location</label>
                <input type="text" name="location[]" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location.0', $experience->location ?? '') }}" required>
                @error('location.0')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="start_date_bs" class="text-secondary">Start Date (BS)</label>
                <input type="text" name="start_date_bs[]" id="nepali-datepicker-start-exp" class="form-control @error('start_date_bs') is-invalid @enderror" value="{{ old('start_date_bs.0', $experience->start_date_bs ?? '') }}" placeholder="YYYY-MM-DD">
                <input type="hidden" name="start_date[]" id="start_date" class="form-control" value="{{ old('start_date.0', $experience->start_date ?? '') }}" required>
                @error('start_date_bs.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
                @error('start_date.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="end_date_bs" class="text-secondary">End Date (BS)</label>
                <input type="text" name="end_date_bs[]" id="nepali-datepicker-end-exp" class="form-control @error('end_date_bs') is-invalid @enderror" value="{{ old('end_date_bs.0', $experience->end_date_bs ?? '') }}" placeholder="YYYY-MM-DD">
                <input type="hidden" name="end_date[]" id="end_date" class="form-control" value="{{ old('end_date.0', $experience->end_date ?? '') }}">
                @error('end_date_bs.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
                @error('end_date.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exp_certificates" class="text-secondary">Certification <i class="fas fa-file-upload"></i></label>
                <input type="file" name="exp_certificates[]" id="exp_certificates" class="form-control @error('exp_certificates') is-invalid @enderror" value="{{ old('exp_certificates.0', $experience->exp_certificates ?? '') }}">
                @error('exp_certificates.0')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="additional_details" class="text-secondary">Additional Details</label>
                <textarea name="additional_details[]" id="additional_details" cols="5" rows="3" class="form-control @error('additional_details') is-invalid @enderror">{{ old('additional_details.0', $experience->additional_details ?? '') }}</textarea>
                @error('additional_details.0')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="javascript:void(0)" class="btn btn-outline-secondary" onclick="prevStep(4)"><i class="bi bi-arrow-left"></i> Back</a>
        <button type="button" class="btn btn-primary" onclick="nextStep(4)"><i class="bi bi-arrow-right"></i> Next</button>
    </div>
</div>



        <!-- Step 5: Confirm and Submit -->
        <div class="step" id="step5" style="display:none;">
            <h5 class="mt-2 mb-3 text-primary"><i class="fas fa-user-lock"></i> Login Credentials</h5>
            <div class="row">
                <!-- Email Field -->

                    <div class="form-group">
                        <label for="email" class="text-secondary">Email <i class="fas fa-envelope"></i></label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $doctor->email ?? '') }}" style="max-width: 500px; " required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                @if(!isset($doctor))
                <!-- Password Field -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="text-secondary">Password <i class="fas fa-key"></i></label>
                        <div class="input-group">
                            <input type="password" id="passwordInput" name="password" class="form-control @error('password') is-invalid @enderror" required>
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
                        <label for="confirm_password" class="text-secondary">Confirm Password <i class="fas fa-lock"></i></label>
                        <div class="input-group">
                            <input type="password" id="confirmPasswordInput" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
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
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="prevStep(5)"><i class="fas fa-arrow-left"></i> Back</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> {{ isset($doctor) ? 'Update' : 'Create' }}</button>
            </div>
        </div>
        </form>
    </div>
</div>
@stack('js')

@include('components.submit-form')
@include('components.step-widget')
@include('components.datepicker')
@include('components.address-nepali')
@include('components.eye_icon')
@endsection
