<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $doctorId = $this->route('doctor');
        return [
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'email' => [
                'required',
                'email',
                'unique:doctors,email,' . $doctorId,
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'phone' => [
                'required',
                'string',
                'unique:doctors,phone,' . $doctorId,
                'regex:/^(98|97|96)\d{8}$|^(01)\d{6,8}$/'
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'date_of_birth_ad' => 'nullable|date|before:today',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:active,inactive',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'municipality_type_id' => 'required|exists:municipality_types,id',
            'municipality_id' => 'required|exists:municipalities,id',
            'date_of_birth_bs' => 'required|string',
            'temporary_province_id' => 'required|exists:provinces,id',
            'temporary_district_id' => 'required|exists:districts,id',
            'temporary_municipality_type_id' => 'required|exists:municipality_types,id',
            'temporary_municipality_id' => 'required|exists:municipalities,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'department_id.required' => 'Please select a department.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'This email has already been taken.',
            'email.regex' => 'The email format is invalid.',
            'phone.required' => 'The phone number is required.',
            'phone.unique' => 'This phone number has already been taken.',
            'phone.regex' => 'The phone number format is invalid.',
            'status.required' => 'Please select a status.',
            'date_of_birth_ad.before' => 'The date of birth must be a date before today.',
            'profile_image.image' => 'The profile image must be an image.',
            'profile_image.mimes' => 'The profile image must be a file of type: jpeg, png, jpg.',
            'profile_image.max' => 'The profile image must not exceed 2MB.',
            'date_of_birth_bs.required' => 'The BS date of birth is required.',
            'temporary_province_id.required' => 'Please select a temporary province.',
            'temporary_district_id.required' => 'Please select a temporary district.',
            'temporary_municipality_type_id.required' => 'Please select a temporary municipality type.',
            'temporary_municipality_id.required' => 'Please select a temporary municipality.',
        ];
    }
}
