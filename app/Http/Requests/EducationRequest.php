<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'doctor_id' => 'required|exists:doctors,id',
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_year' => 'required|integer',
            'end_year' => 'nullable|integer',
            'edu_certificates' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // 2MB file limit
            'additional_information' => 'nullable|string',
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
            'field_of_study.required' => 'Field of study is required.',
            'field_of_study.max' => 'Field of study must not exceed 255 characters.',
            'start_year.required' => 'Start year is required.',
            'start_year.integer' => 'Start year must be a valid number.',
            'end_year.integer' => 'End year must be a valid number.',
            'edu_certificates.file' => 'The uploaded certification must be a valid file.',
            'edu_certificates.mimes' => 'The certification must be a file of type: pdf, jpg, jpeg, png.',
            'edu_certificates.max' => 'The certification file size must not exceed 2MB.',
            'additional_information.string' => 'Additional details must be a valid string.',
        ];
    }
}
