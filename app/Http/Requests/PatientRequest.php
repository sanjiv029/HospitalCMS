<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // Patient name
            'phone_number' => [
                'required',
                'string',
                'unique:patients,phone_number',
                'regex:/^(98|97|96)\d{8}$|^(01)\d{6,8}$/', // Nepali phone number format
            ],
            'gender' => 'nullable|in:male,female,other', // Optional gender field
            'age' => 'required|integer|min:0|max:120', // Age validation with range
            'address' => 'nullable|string', // Optional address
            'email' => 'required|email', // Email field
            'medical_history' => 'nullable|string', // Optional medical history
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name may not exceed 255 characters.',

            'phone_number.required' => 'The phone number is required.',
            'phone_number.string' => 'The phone number must be a valid string.',
            'phone_number.regex' => 'The phone number must start with 98, 97, 96 (mobile) or 01 (landline).',
            'phone_number.unique' => 'The phone number must be unique.',

            'gender.in' => 'The gender must be one of: male, female, or other.',

            'age.required' => 'The age is required.',
            'age.integer' => 'The age must be an integer.',
            'age.min' => 'The age must be at least 0.',
            'age.max' => 'The age may not exceed 120 years.',

            'address.string' => 'The address must be a valid string.',

            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be valid.',

            'medical_history.string' => 'The medical history must be a valid string.',
        ];
    }
}
