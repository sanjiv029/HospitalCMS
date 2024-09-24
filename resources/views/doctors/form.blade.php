@extends('layouts.admin')

@section('content_header_title', '')
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
                            <label for="name">Name</label>
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
                <h5>Address Information</h5>
                <div class="row">
                    <h6>Permanent Address</h6>
                    <!-- Province Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="province_id">Province</label>
                            <select name="province_id" id="province_id" class="form-control" required>
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
                            <label for="district_id">District</label>
                            <select name="district_id" id="district_id" class="form-control" required>
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
                            <label for="muni_type_id">Municipality Type</label>
                            <select name="municipality_type_id" id="muni_type_id" class="form-control" required>
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
                            <label for="municipality">Municipality Name</label>
                            <select name="municipality_id" id="municipality_id" class="form-control" required>
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

                <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Back</button>
                <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
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
                          <input type="text" name="degree" id="degree">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="institution">Institution</label>
                          <input type="text" name="institution" id="institution">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field_of_study">Field of Study</label>
                          <input type="text" name="field_of_study" id="field_of_study">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_year">Start year</label>
                          <input type="text" name="start_year" id="start_year">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_year">End year</label>
                          <input type="text" name="start_year" id="start_year">
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary" onclick="prevStep(3)">Back</button>
                <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
            </div>

            <!-- Step 4: Experience -->
            <div class="step" id="step4" style="display:none;">
                <h5>Experience</h5>
                <!-- Add experience fields here -->
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

@include('components.step-widget')
@include('components.datepicker')
@include('common.address-nepali')
@include('components.eye_icon')
@endsection
