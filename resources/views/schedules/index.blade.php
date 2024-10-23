@extends('layouts.admin')

@section('content_header_title', 'Doctor Schedules')
@section('content_body')
    <div class="container">
         <!-- Button for creating a new schedule -->
         <a href="{{ route('schedules.create') }}" class="btn btn-primary mb-3">
            Create New
        </a>
        @if(session('success'))
        <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
        <div id="error-message" class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @foreach($doctors as $doctor)
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Schedules for {{ $doctor->name }}</h3>
                <div class="btn-group">
                    <a href="{{ route('schedules.bulkEdit', $doctor->id) }}" class="btn btn-primary mr-2">
                        Edit
                    </a>
                    <form action="{{ route('schedules.bulkDestroy', $doctor->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this schedule?');">Delete</button>
                    </form>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctor->schedules as $schedule)
                        <tr>
                            <td>{{ ucfirst($schedule->day_of_week) }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</td>
                            <td>
                                <!-- Action buttons -->
                                @include('components.action-btn-schedule', ['buttons' => ['edit' => true, 'delete' => true], 'url' => '/admin/schedule/', 'schedule' => $schedule])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@endsection
