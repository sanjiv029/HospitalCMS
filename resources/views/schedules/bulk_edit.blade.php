@extends('layouts.admin')

@section('subtitle', '')
@section('content_header_title', '')

@section('content_body')
    <div class="card mx-auto" style="max-width:1000px;">
        <div class="card-header">
            <h3>Edit Schedules for {{ $doctor->name }}</h3>
        </div>
        <form action="{{ route('schedules.bulkUpdate', $doctor->id) }}" method="POST">
        @csrf
        @method('PUT')
         {{-- Error Message --}}
                @if(session('error'))
                    <div id="error-message" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
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
             <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                        </div>
                    </div>
                    {{-- Day of the Week --}}
                    <div class="col-md-12">
                        <label for="day_of_week" class="text-secondary">Days of the Week <span class='text-danger'>*</span></label>
                        <div class="form-group">
                            @foreach ($days as $day)
                                <div class="form-row align-items-center">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="day_of_week[]" id="day_{{ $day->id }}" value="{{ $day->id }}"
                                                {{ in_array($day->name, (array) old('day_of_week', $selectedDays ?? [])) ? 'checked' : '' }} onclick="toggleTimeInputs({{ $day->id }})">
                                            <label class="form-check-label" for="day_{{ $day->id }}">{{ ucfirst($day->name) }}</label>
                                        </div>
                                    </div>
                                  {{-- Time Inputs for Each Day --}}
                                  <div id="time_inputs_{{ $day->id }}" class="time-inputs col-md-8 row" style="{{ in_array($day->name, (array) old('day_of_week', $selectedDays ?? [])) ? '' : 'display: none;' }} margin-left:10px;">
                                    <div class="col-md-6">
                                        <label for="start_time_{{ $day->id }}" class="text-secondary">Time from</label>
                                        <input type="time" name="schedule[{{ $day->id }}][start_time]" id="start_time_{{ $day->id }}" class="form-control @error('schedule.' . $day->id . '.start_time') is-invalid @enderror"
                                            value="{{ old('schedule['.$day->id.'][start_time]', $schedules[$day->name]->start_time ?? '') }}">
                                        @error('schedule.' . $day->id . '.start_time')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end_time_{{ $day->id }}" class="text-secondary">Time to</label>
                                        <input type="time" name="schedule[{{ $day->id }}][end_time]" id="end_time_{{ $day->id }}" class="form-control @error('schedule.' . $day->id . '.end_time') is-invalid @enderror"
                                            value="{{ old('schedule['.$day->id.'][end_time]', $schedules[$day->name]->end_time ?? '') }}">
                                        @error('schedule.' . $day->id . '.end_time')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                            @endforeach
                        </div>
                        @error('day_of_week')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit and Back Buttons -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    @include('components.show-time')
@stop
