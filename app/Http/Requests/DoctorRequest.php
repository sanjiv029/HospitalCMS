<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
        $doctorId = $this->route(param: 'doctor') ? $this->route('doctor'): null;

        return [
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'email' => 'required|email|unique:doctors,email,'.$doctorId,
            'phone' => 'required|string|unique:doctors,phone,'.$doctorId,
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'profile_image' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'department_id.required' => 'Please select a department.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'This email has already been taken.',
            'phone.required' => 'The phone number is required.',
            'phone.unique' => 'This phone number has already been taken.',
            'address.required' => 'The address field is required.',
            'status.required' => 'Please select a status.',
            'date_of_birth.required' => 'The date of birth field is required.',
            'date_of_birth.before' => 'The date of birth must be a date before today.',
        ];
    }
}
