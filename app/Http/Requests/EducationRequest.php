<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'doctor_id' => 'exists:doctors,id',
            'degree.*' => 'required|string|max:255',
            'institution.*' => 'required|string|max:255',
            'address.*' => 'required|string|max:255',
            'field_of_study.*' => 'required|string|max:255',
            'start_year.*' => 'required|date',
            'end_year.*' => 'nullable|date|after_or_equal:start_year.*',
            'start_year_bs.*' => 'required|string',
            'end_year_bs.*' => 'nullable|string|after_or_equal:start_year_bs.*',
            'edu_certificates.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'additional_information.*' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'doctor_id.required' => 'Doctor ID is required.',
            'doctor_id.exists' => 'The selected doctor does not exist in our records.',
            'degree.required' => 'Degree field is required.',
            'degree.max' => 'Degree must not exceed 255 characters.',
            'institution.required' => 'Institution field is required.',
            'institution.max' => 'Institution name must not exceed 255 characters.',
            'address.required' => 'Address field is required.',
            'field_of_study.required' => 'Field of study is required.',
            'field_of_study.max' => 'Field of study must not exceed 255 characters.',
            'start_year.required' => 'Start year is required.',
            'start_year.date' => 'Start year must be a valid date.',
            'end_year.date' => 'End year must be a valid date.',
            'end_year.after_or_equal' => 'End year must be after or equal to the start year.',
            'start_year_bs.required' => 'Start year (BS) is required.',
            'end_year_bs.after_or_equal' => 'End year (BS) must be after or equal to the start year (BS).',
            'edu_certificates.file' => 'The uploaded certification must be a valid file.',
            'edu_certificates.mimes' => 'The certification must be a file of type: pdf, jpg, jpeg, png.',
            'edu_certificates.max' => 'The certification file size must not exceed 2MB.',
            'additional_information.string' => 'Additional details must be a valid string.',
        ];
    }
}
