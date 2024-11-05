<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\DataTables\AppointmentsDataTable;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\PatientRequest;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Mail\AppointmentConfirmationMail;
use App\Models\Menu;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AppointmentsDataTable $dataTables)
    {
        return $dataTables->render('appointments.index', [
            'resourceName' => 'Appointments',
            'resourceRoute' => 'appointment',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($patientId)
    {
        // Retrieve patient data and their related appointments
        $patient = Patient::with(['appointments.doctor', 'appointments.department'])
                          ->findOrFail($patientId);

        return view('appointments.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patient = $appointment->patient;
        $doctors = Doctor::all(); // Assuming you have a Doctor model
        $departments = Department::all(); // Assuming you have a Department model

        return view('appointments.edit', compact('appointment', 'patient', 'doctors', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        // Update the appointment
        $appointment->doctor_id = $request->doctor_id;
        $appointment->department_id = $request->department_id;
        $appointment->day = $request->day;

        // Format the time slot
        $startTime = Carbon::parse($request->time_slot);
        $appointment->time_slot = $startTime->format('H:i'); // Store in 24-hour format if needed

        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->route('appointment.index')->with('success', 'Appointment updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showDepartments()
    {
        $menus = Menu::all();
        $departments = Department::all();
        return view('appointments.select-department', compact('departments','menus'));
    }

    public function selectDoctor(Request $request)
    {
        $menus = Menu::all();
        $department = Department::find($request->department_id);
        if (!$department) {
            return redirect()->route('appointments.book')->withErrors(['Department not found.']);
        }
        $doctors = Doctor::where('department_id', $department->id)->get();
        return view('appointments.select-doctor', compact('doctors', 'department','menus'));
    }

    public function selectTimeSlots(Request $request)
    {
        $menus = Menu::all();
        $departmentId = $request->input('department_id');
        $doctorId = $request->input('doctor_id');

        // Check if the department and doctor IDs exist
        if (!$departmentId || !$doctorId) {
            return redirect()->back()->withErrors('Department or Doctor information is missing.');
        }

        $department = Department::find($departmentId);
        $doctor = Doctor::find($doctorId);

        if (!$department || !$doctor) {
            return redirect()->back()->withErrors('Could not find the specified doctor or department.');
        }

        $availableTimeSlots = $this->availableSlots($doctor->id);
        return view('appointments.select-time-slot', compact('availableTimeSlots', 'doctor', 'department','menus'));
    }


    public function availableSlots($doctorId)
{
    // Fetch doctor with active schedules and their appointments
    $doctor = Doctor::with('schedules.appointments')->findOrFail($doctorId);

    // Set appointment duration in minutes
    $appointmentDuration = 30;

    foreach ($doctor->schedules as $schedule) {
        // Parse start and end times
        $startTime = \Carbon\Carbon::parse($schedule->start_time);
        $endTime = \Carbon\Carbon::parse($schedule->end_time);

        // Calculate total duration in minutes
        $totalDurationInMinutes = $startTime->diffInMinutes($endTime);

        if ($appointmentDuration > 0) {
            // Calculate total slots available
            $totalSlots = floor($totalDurationInMinutes / $appointmentDuration);
            $bookedAppointments = $schedule->appointments->pluck('time_slot')->toArray(); // Get booked time slots
            $availableSlots = 0; // Initialize available slots count

            // Prepare time slots based on available slots
            $schedule->setAttribute('time_slots', []);
            for ($i = 0; $i < $totalSlots; $i++) {
                // Format the time for the dropdown
                $currentSlotStartTime = $startTime->copy()->addMinutes($i * $appointmentDuration);
                $formattedTime = $currentSlotStartTime->format('H:i'); // For the value
                $displayTime = $currentSlotStartTime->format('g:i A') . ' - ' .
                               $currentSlotStartTime->copy()->addMinutes($appointmentDuration)->format('g:i A'); // For display

                // Check if the slot is already booked
                if (!in_array($formattedTime, $bookedAppointments)) {
                    $schedule->time_slots[] = [
                        'time' => $formattedTime,
                        'display' => $displayTime
                    ];
                    $availableSlots++; // Increment available slots count
                }
            }

            // Store available slots
            $schedule->available_slots = $availableSlots;
        } else {
            $schedule->available_slots = 0;
        }
    }
    return $doctor->schedules;
}


        public function patientInfo(Request $request)
    {
        $menus = Menu::all();
        $doctor_id = $request->doctor_id;
        $department_id = $request->department_id;
        $doctor_schedule_id = $request->doctor_schedule_id; // Renaming it to match the Blade variable
        $time_slot = $request->time_slot;
        $day = $request->day;

        // Pass this data to the patient info form
        return view('appointments.patient-info', compact('doctor_id', 'department_id', 'doctor_schedule_id', 'time_slot', 'day','menus'));
    }

    public function storeInfo(PatientRequest $patientRequest, AppointmentRequest $appointmentRequest)
    {

        // Create a new patient record
        $patient = Patient::create([
            'name' => $patientRequest->input('name'),
            'age' => $patientRequest->input('age'),
            'phone_number' => $patientRequest->input('phone_number'),
            'gender' => $patientRequest->input('gender'),
            'address' => $patientRequest->input('address'),
            'email' => $patientRequest->input('email'),
            'medical_history' => $patientRequest->input('medical_history'),
        ]);

        // Create a new appointment record
        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $appointmentRequest->input('doctor_id'),
            'department_id' => $appointmentRequest->input('department_id'),
            'doctor_schedule_id' => $appointmentRequest->input('doctor_schedule_id'),
            'day' => $appointmentRequest->input('day'),
            'time_slot' => $appointmentRequest->input('time_slot'),
            'status' => 'pending', // Default status
        ]);

      /*   Log::info('Preparing to send email', ['patient' => $patient, 'appointment' => $appointment]);*/

        Mail::to($patient->email)->send(new AppointmentConfirmationMail($appointment, $patient));

        session()->flash('success', "Thank you for booking an appointment, {$appointment->patient->name}. Your appointment with Dr. {$appointment->doctor->name} is scheduled on {$appointment->day} at " . \Carbon\Carbon::parse($appointment->time_slot)->format('g:i A') . ".");
        // Redirect or return a success response
        return redirect()->route('welcome');
    }

}
