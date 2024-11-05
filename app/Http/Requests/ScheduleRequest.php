<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    $rules = [
        'doctor_id' => 'required|exists:doctors,id',
        'day_of_week' => 'required|array',
        'day_of_week.*' => 'required|string',
    ];

    $days = $this->input('day_of_week', []);

    if (is_array($days)) {
        foreach ($days as $day) {
            // Validate start_time
            $rules["schedule.{$day}.start_time"] = [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($day) {
                    $endTime = $this->input("schedule.{$day}.end_time");

                    // Ensure end_time is greater than start_time
                    if ($endTime && $value >= $endTime) {
                        $fail("The end time for {$day} must be after the start time.");
                    }
                },
            ];

            // Validate end_time
            $rules["schedule.{$day}.end_time"] = [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($day) {
                    $startTime = $this->input("schedule.{$day}.start_time");

                    // Ensure end_time is greater than start_time
                    if ($startTime && $value <= $startTime) {
                        $fail("The end time for {$day} must be after the start time.");
                    }
                },
            ];
        }
    }

    return $rules;
}

    public function messages(): array
    {
        return [
            'doctor_id.required' => 'The doctor field is required.',
            'doctor_id.exists' => 'The selected doctor does not exist.',
            'day_of_week.required' => 'You must select at least one day.',
            'day_of_week.array' => 'The days must be provided as an array.',
            'day_of_week.*.string' => 'Each day must be a string.',
            'schedule.*.start_time.required' => 'Start time is required for each day.',
            'schedule.*.end_time.required' => 'End time is required for each day.',
            'schedule.*.start_time.date_format' => 'Start time must be in the correct format (H:i:s).',
            'schedule.*.end_time.date_format' => 'End time must be in the correct format (H:i:s).',
        ];
    }
}
