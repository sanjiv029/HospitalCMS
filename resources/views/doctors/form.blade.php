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
                        <input type="text" name="date_of_birth_bs" id="date_of_birth_bs"  class="form-control nepali-datepicker @error('date_of_birth_bs') is-invalid @enderror" value="{{ old('date_of_birth_bs', $doctor->date_of_birth_bs ?? '') }}" placeholder="YYYY-MM-DD" >
                        <input type="hidden" name="date_of_birth_ad" id="date_of_birth_ad" class="form-control ad-date  @error('date_of_birth_ad') is-invalid @enderror" value="{{ old('date_of_birth_ad', $doctor->date_of_birth ?? '') }}" readonly>
                    </div>
                    @error('date_of_birth_bs') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @error('date_of_birth_ad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gender" class="text-secondary">Gender<span class="text-danger"> *</span></label>
                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male" {{ old('gender', $doctor->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $doctor->gender?? '') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $doctor->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marital_status" class="text-secondary">Marital Status{{-- <span class="text-danger"> *</span> --}}</label>
                        <select name="marital_status" id="marital_status" class="form-control @error('marital_status') is-invalid @enderror" required>
                            <option value="" disabled selected>Select Marital Status</option>
                            <option value="single" {{ old('marital_status', $doctor->marital_status ?? '') == 'single' ? 'selected' : '' }}>Single</option>
                            <option value="married" {{ old('marital_status', $doctor->marital_status?? '') == 'married' ? 'selected' : '' }}>Married</option>
                            <option value="divorced" {{ old('marital_status', $doctor->marital_status ?? '') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                            <option value="widowed" {{ old('marital_status', $doctor->marital_status ?? '') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                        </select>
                    </div>
                    @error('marital_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="profile_image" class="text-secondary">Profile Image <i class="fas fa-file-upload"></i></label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control @error('profile_image') is-invalid @enderror">
                        @error('profile_image')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status" class="text-secondary">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="" disabled selected>Select Status</option>
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
            <div class="col-md-12" id="education-fields">
                  @foreach ($educations as $key => $education)
                <div class="education-item border p-3 mb-3" id="education-item-{{ $key }}">
                    <div class="d-flex justify-content-between">
                        <h6 class="text-success">Education Entry {{$key + 1}}</h6>
                        <button type="button" class="btn btn-danger remove-education" data-id="{{ $key }}">Remove</button>
                    </div>
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="degree_{{ $key }}" class="text-secondary">Degree</label>
                            <select name="degree[]" id="degree_{{ $key }}" class="form-control @error('degree.' . $key) is-invalid @enderror" required>
                                <option value="" disabled selected>Select Degree</option>
                                <option value="MBBS" {{ old('degree.' . $key, $education->degree ?? '') == 'MBBS' ? 'selected' : '' }}>MBBS</option>
                                <option value="MD" {{ old('degree.' . $key, $education->degree ?? '') == 'MD' ? 'selected' : '' }}>MD</option>
                                <option value="MS" {{ old('degree.' . $key, $education->degree ?? '') == 'MS' ? 'selected' : '' }}>MS</option>
                                <option value="BDS" {{ old('degree.' . $key, $education->degree ?? '') == 'BDS' ? 'selected' : '' }}>BDS</option>
                                <option value="MDS" {{ old('degree.' . $key, $education->degree ?? '') == 'MDS' ? 'selected' : '' }}>MDS</option>
                                <option value="PhD" {{ old('degree.' . $key, $education->degree ?? '') == 'PhD' ? 'selected' : '' }}>PhD</option>
                            </select>
                            @error('degree.' . $key)
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="institution_{{ $key }}" class="text-secondary">Institution</label>
                            <input type="text" name="institution[]" id="institution_{{ $key }}" class="form-control @error('institution.' . $key) is-invalid @enderror" value="{{ old('institution.' . $key, $education->institution ?? '') }}" required>
                            @error('institution.' . $key)
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address_{{ $key }}" class="text-secondary">Address</label>
                            <input type="text" name="address[]" id="address_{{ $key }}" class="form-control @error('address.' . $key) is-invalid @enderror" value="{{ old('address.' . $key, $education->address ?? '') }}" required>
                            @error('address.' . $key)
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field_of_study_{{ $key }}" class="text-secondary">Field of Study</label>
                            <input type="text" name="field_of_study[]" id="field_of_study_{{ $key }}" class="form-control @error('field_of_study.' . $key) is-invalid @enderror" value="{{ old('field_of_study.' . $key, $education->field_of_study ?? '') }}" required>
                            @error('field_of_study.' . $key)
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_year_bs_{{ $key }}" class="text-secondary">Start Date (BS)</label>
                            <input type="text" name="start_year_bs[]" id="start_year_bs_{{ $key }}" class="form-control nepali-datepicker-start @error('start_year_bs.' . $key) is-invalid @enderror" value="{{ old('start_year_bs.' . $key, $education->start_year_bs ?? '') }}" placeholder="YYYY-MM-DD" required>
                            <input type="hidden" name="start_year[]" id="start_year_ad_{{ $key }}" class="form-control ad-date-start" value="{{ old('start_year.' . $key, $education->start_year ?? '') }}" required>
                            @error('start_year_bs.' . $key) <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_year_bs_{{ $key }}" class="text-secondary">End Date (BS)</label>
                            <input type="text" name="end_year_bs[]" id="end_year_bs_{{ $key }}" class="form-control nepali-datepicker-end @error('end_year_bs.' . $key) is-invalid @enderror" value="{{ old('end_year_bs.' . $key, $education->end_year_bs ?? '') }}" placeholder="YYYY-MM-DD">
                            <input type="hidden" name="end_year[]" id="end_year_ad_{{ $key }}" class="form-control ad-date-end" value="{{ old('end_year.' . $key, $education->end_year ?? '') }}">
                            @error('end_year_bs.' . $key) <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edu_certificates_{{ $key }}" class="text-secondary">Certification <i class="fas fa-file-upload"></i></label>
                            <input type="file" name="edu_certificates[]" id="edu_certificates_{{ $key }}" class="form-control @error('edu_certificates.' . $key) is-invalid @enderror">
                            @error('edu_certificates.' . $key)
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="additional_information_{{ $key }}" class="text-secondary">Additional Details</label>
                            <textarea name="additional_information[]" id="additional_information_{{ $key }}" cols="5" rows="3" class="form-control @error('additional_information.' . $key) is-invalid @enderror">{{ old('additional_information.' . $key, $education->additional_information ?? '') }}</textarea>
                            @error('additional_information.' . $key)
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="javascript:void(0)" class="btn btn-outline-secondary" onclick="prevStep(3)"><i class="bi bi-arrow-left"></i> Back</a>
                <button type="button" class="add-repeater-row btn btn-success" id="add-education"><i class="fas fa-plus"></i> Add Education</button>
                <button type="button" class="btn btn-primary" onclick="nextStep(3)"><i class="bi bi-arrow-right"></i> Next</button>
            </div>
        </div>


        <!-- Step 4: Experience Details -->
        <div class="step" id="step4" style="display:none;">
            <h5 class="text-primary"><i class="fas fa-briefcase"></i> Experience Details</h5>
            <div class="col-md-12" id="experience-fields">
                @foreach ($experiences as $key => $experience)
                <div class="experience-item border p-3 mb-3" id="experience-item-{{ $key }}">
                    <div class="d-flex justify-content-between">
                        <h6 class="text-success">Experience Entry {{ $key + 1 }}</h6>
                        <button type="button" class="btn btn-danger remove-experience" data-id="{{ $key }}">Remove</button>
                    </div>
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="type_of_employment_{{ $key }}" class="text-secondary">Type of Employment</label>
                            <select name="type_of_employment[]" id="type_of_employment_{{ $key }}" class="form-control @error('type_of_employment.' . $key) is-invalid @enderror" required>
                                <option value="" disabled selected>Select Employment Type</option>
                                <option value="Full-time" {{ old('type_of_employment.' . $key, $experience->type_of_employment ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ old('type_of_employment.' . $key, $experience->type_of_employment ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ old('type_of_employment.' . $key, $experience->type_of_employment ?? '') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Internship" {{ old('type_of_employment.' . $key, $experience->type_of_employment ?? '') == 'Internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                            @error('type_of_employment.' . $key)
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="job_title_{{ $key }}" class="text-secondary">Job Title</label>
                            <input type="text" name="job_title[]" id="job_title_{{ $key }}" class="form-control @error('job_title.' . $key) is-invalid @enderror" value="{{ old('job_title.' . $key, $experience->job_title ?? '') }}" required>
                            @error('job_title.' . $key)
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="healthcare_facilities_{{ $key }}" class="text-secondary">Healthcare Facilities</label>
                            <input type="text" name="healthcare_facilities[]" id="healthcare_facilities_{{ $key }}" class="form-control @error('healthcare_facilities.' . $key) is-invalid @enderror" value="{{ old('healthcare_facilities.' . $key, $experience->healthcare_facilities ?? '') }}" required>
                            @error('healthcare_facilities.' . $key)
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="location_{{ $key }}" class="text-secondary">Location</label>
                            <input type="text" name="location[]" id="location_{{ $key }}" class="form-control @error('location.' . $key) is-invalid @enderror" value="{{ old('location.' . $key, $experience->location ?? '') }}" required>
                            @error('location.' . $key)
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_date_bs_{{ $key }}" class="text-secondary">Start Date (BS)</label>
                            <input type="text" name="start_date_bs[]" id="start_date_bs_{{ $key }}" class="form-control nepali-datepicker-start @error('start_date_bs.' . $key) is-invalid @enderror" value="{{ old('start_date_bs.' . $key, $experience->start_date_bs ?? '') }}" placeholder="YYYY-MM-DD" required>
                            <input type="hidden" name="start_date[]" id="start_date_ad_{{ $key }}" class="form-control ad-date-start" value="{{ old('start_date.' . $key, $experience->start_date ?? '') }}" required>
                            @error('start_date_bs.' . $key) <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_date_bs_{{ $key }}" class="text-secondary">End Date (BS)</label>
                            <input type="text" name="end_date_bs[]" id="end_date_bs_{{ $key }}" class="form-control nepali-datepicker-end @error('end_date_bs.' . $key) is-invalid @enderror" value="{{ old('end_date_bs.' . $key, $experience->end_date_bs ?? '') }}" placeholder="YYYY-MM-DD">
                            <input type="hidden" name="end_date[]" id="end_date_ad_{{ $key }}" class="form-control ad-date-end" value="{{ old('end_date.' . $key, $experience->end_date ?? '') }}">
                            @error('end_date_bs.' . $key) <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exp_certificates_{{ $key }}" class="text-secondary">Experience Certification <i class="fas fa-file-upload"></i></label>
                            <input type="file" name="exp_certificates[]" id="exp_certificates_{{ $key }}" class="form-control @error('exp_certificates.' . $key) is-invalid @enderror">
                            @error('exp_certificates.' . $key)
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="additional_details_{{ $key }}" class="text-secondary">Job Description</label>
                            <textarea name="additional_details[]" id="additional_details_{{ $key }}" cols="5" rows="3" class="form-control @error('additional_details.' . $key) is-invalid @enderror">{{ old('additional_details.' . $key, $experience->additional_details ?? '') }}</textarea>
                            @error('additional_details.' . $key)
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="javascript:void(0)" class="btn btn-outline-secondary" onclick="prevStep(4)"><i class="bi bi-arrow-left"></i> Back</a>
                <button type="button" class="add-repeater-row btn btn-success" id="add-experience"><i class="fas fa-plus"></i> Add Experience</button>
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
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $doctor->email ?? '') }}" style="max-width: 450px; " required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                @if(!isset($doctor))
                <!-- Password Field -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="passwordInput" class="text-secondary">Password <i class="fas fa-key"></i></label>
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
                        <label for="confirmPasswordInput" class="text-secondary">Confirm Password <i class="fas fa-lock"></i></label>
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
@include('components.form-repeater')
@include('components.datepicker')
@include('components.step-widget')
@include('components.address-nepali')
@include('components.eye_icon')
@endsection
