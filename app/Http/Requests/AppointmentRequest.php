<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'doctor_id' => 'required|exists:doctors,id', // Validate existing doctor
            'department_id' => 'required|exists:departments,id', // Validate existing department
            'doctor_schedule_id' => 'required|exists:doctor_schedules,id', // Validate existing schedule
            'day' => 'required|string|max:255', // String with max length validation
            'time_slot' => 'required|string|max:255', // Valid string for time slot
            'status' => 'nullable|in:pending,approved,declined', // Status validation
        ];
    }

    public function messages(): array
    {
        return [
            'doctor_id.required' => 'Please select a doctor.',
            'doctor_id.exists' => 'The selected doctor is invalid.',

            'department_id.required' => 'Please select a department.',
            'department_id.exists' => 'The selected department is invalid.',

            'doctor_schedule_id.required' => 'The schedule field is required.',
            'doctor_schedule_id.exists' => 'The selected schedule is invalid.',

            'day.required' => 'You must select a day.',
            'day.string' => 'The day must be a valid string.',

            'time_slot.required' => 'Please select a time slot.',
            'time_slot.string' => 'The time slot must be a valid string.',

            'status.in' => 'The status must be one of the following: pending, approved, or declined.',
        ];
    }
}
