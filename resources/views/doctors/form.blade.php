@extends('layouts.admin')

@section('subtitle', '')
@section('content_header_title', '')

@section('content_body')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ isset($doctor) ? 'Edit Doctor' : 'Add a New Doctor' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($doctor) ? route('doctors.update', $doctor->id) : route('doctors.store') }}" method="POST">
                @csrf
                @if(isset($doctor))
                    @method('PUT')
                @endif
                {{-- for errror --}}
                @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
         </ul>
   </div>
 @endif
                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $doctor->name ?? '') }}" required>
                </div>

                <!-- Department Field (Dropdown) -->
                <div class="form-group">
                    <label for="department_id">Department</label>
                    <select name="department_id" id="department_id" class="form-control select2 ">
                        <option value="">Select a Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id', $doctor->department_id ?? '') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $doctor->email ?? '') }}" required>
                </div>

                <!-- Phone Field -->
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $doctor->phone ?? '') }}" required>
                </div>

                <!-- Address Field -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $doctor->address ?? '') }}" required>
                </div>

                <!-- Date of Birth Field -->
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth', $doctor->date_of_birth ?? '') }}" required>
                </div>

                <!-- Profile Field (Optional) -->
                <div class="form-group">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">

                    @if(isset($doctor) && $doctor->profile_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="Profile Image" style="max-width: 150px;">
                        </div>
                    @endif
                </div>

                <!-- Status Field -->
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="active" {{ old('status', $doctor->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $doctor->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">{{ isset($doctor) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@stop
