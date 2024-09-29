<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'doctor_id' => 'exists:doctors,id',
            'job_title.*' => [
                'required',
                'string',
                'max:255',
            ],
            'healthcare_facilities.*' => [
                'required',
                'string',
                'max:255',
            ],
            'location.*' => [
                'required',
                'string',
                'max:255',
            ],
            'type_of_employment.*' =>  [
                'required',
                'string',
                'max:255',
            ],
            'start_date.*' => [
                'required',
                'date',
            ],
            'end_date.*' =>  [
                'nullable',
                'date',
                'after_or_equal:start_date.*',
            ],
            'start_date_bs.*' => [
                'required',
                'string',
            ],
            'end_date_bs.*' => [
                'nullable',
                'string',
                'after_or_equal:start_date_bs.*',
            ],
            'exp_certificates.*' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:2048', // 2MB file limit
            ],
            'additional_details.*' =>  [
                'nullable',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'doctor_id.required' => 'Doctor ID is required.',
            'doctor_id.exists' => 'The selected doctor does not exist in our records.',
            'job_title.*.required' => 'Job title is required.',
            'job_title.*.max' => 'Job title must not exceed 255 characters.',
            'healthcare_facilities.*.required' => 'Healthcare facilities field is required.',
            'healthcare_facilities.*.max' => 'Healthcare facilities must not exceed 255 characters.',
            'location.*.required' => 'Location is required.',
            'location.*.max' => 'Location must not exceed 255 characters.',
            'type_of_employment.*.required' => 'Type of employment is required.',
            'type_of_employment.*.max' => 'Type of employment must not exceed 255 characters.',
            'start_date.*.required' => 'Start date is required.',
            'start_date.*.date' => 'Start date must be a valid date.',
            'end_date.*.date' => 'End date must be a valid date.',
            'end_date.*.after_or_equal' => 'End date must be after or equal to the start date.',
            'exp_certificates.*.file' => 'The uploaded certification must be a valid file.',
            'exp_certificates.*.mimes' => 'The certification must be a file of type: pdf, jpg, jpeg, png.',
            'exp_certificates.*.max' => 'The certification file size must not exceed 2MB.',
            'additional_details.*.string' => 'Additional details must be a valid string.',
        ];
    }
}
