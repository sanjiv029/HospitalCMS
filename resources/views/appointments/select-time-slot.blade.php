@extends('layouts.web-template')

@section('content')
<div class="container">
    <!-- Step 2 Heading -->
    <div class="row mb-4">
        <div class="col-xl-8">
            <h4 class="text-info mb-2">
                Access healthcare services anytime from anywhere with us
                <br>
                Follow these simple five steps
            </h4>
        </div>
    </div>

    <!-- Steps -->
    <div class="row text-dark">
        <!-- Step 3: Select Appointment Schedule -->
        <div class="col-sm-12 mb-4">
            <div class="steps-section_list_item">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-calendar-alt fa-2x text-dark mr-4"></i> <!-- Icon: Calendar -->
                </div>
                <h5 class="ms-2 text-dark">Step 3: Select Appointment Schedule</h5>
                <p class="text-dark">See the doctor's available hours, select a day and time slot.</p>
                <h3 class="mt-4">Available Slots for {{ $doctor->name }}</h3>

                <div id="slotsContainer">
                    <!-- Create a form to capture selected time slot -->
                    <form id="scheduleForm" action="{{ route('appointments.patient.info') }}" method="GET"> <!-- Changed to GET -->
                        @csrf

                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                        <input type="hidden" name="department_id" value="{{ $doctor->department_id }}">
                        <input type="hidden" id="doctor_schedule_id" name="doctor_schedule_id">
                        <input type="hidden" id="time_slot" name="time_slot">
                        <input type="hidden" id="day" name="day"> <!-- Added hidden field for day -->

                        <div class="row">
                            @foreach($availableTimeSlots as $schedule)
                            <div class="col-md-4 mb-3">
                                <!-- Schedule Card -->
                                <div class="card border-info" style="height: 100%;">
                                    <div class="card-header bg-info text-white">
                                        Day: {{ $schedule->day_of_week }}
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Time:</strong> From {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}
                                            to {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}</p>
                                        <p class="{{ $schedule->available_slots > 0 ? 'text-success' : 'text-danger' }}">
                                            {{ $schedule->available_slots }} Tokens Left
                                        </p>
                                        @if($schedule->available_slots > 0)
                                        <!-- Dropdown to select time slot -->
                                        <select class="form-control mb-2 time-slot-dropdown" id="timeSlotSelect-{{ $schedule->id }}" data-schedule-id="{{ $schedule->id }}" data-day="{{ $schedule->day_of_week }}">
                                            <option value="" disabled selected>Select Time Slot</option>
                                            @foreach($schedule->time_slots as $slot)
                                                <option value="{{ $slot['time'] }}">
                                                    {{ $slot['display'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- Button to select the time slot -->
                                        <button type="button" id="select-time-slot-{{ $schedule->id }}" class="btn btn-outline-primary btn-sm" disabled>
                                            Select Time for Token
                                        </button>
                                        @else
                                            <p class="text-danger">No Tokens Available</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('appointments.book') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>
</div>

<script>
    // Initialize the event listener for the dropdowns
    document.querySelectorAll('.time-slot-dropdown').forEach(function(dropdown) {
        dropdown.addEventListener('change', function() {
            const scheduleId = this.dataset.scheduleId;
            const selectedTime = this.value;
            const dayOfWeek = this.dataset.day;
            const nextButton = document.getElementById(`select-time-slot-${scheduleId}`);
            const scheduleInput = document.getElementById('doctor_schedule_id');
            const timeSlotInput = document.getElementById('time_slot');
            const dayInput = document.getElementById('day');

            if (selectedTime) {
                nextButton.removeAttribute('disabled');

                // Update hidden fields with selected schedule and time
                scheduleInput.value = scheduleId;
                timeSlotInput.value = selectedTime;
                dayInput.value = dayOfWeek;

                nextButton.onclick = function() {
                    document.getElementById('scheduleForm').submit();
                };
            } else {
                nextButton.setAttribute('disabled', 'disabled');
            }
        });
    });
</script>
@endsection
