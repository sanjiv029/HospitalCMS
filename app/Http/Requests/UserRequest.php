<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $userId = $this->route(param: 'user') ? $this->route('user')->id : null;
        return [
                'name' => 'required|string|max:255',
                 'email' => 'required|string|email|max:255|unique:users,email,'.$userId,
                'password' => $this->isMethod('post') ? 'required|min:8' : 'nullable|min:8',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'This email has already been taken.',
            'password.required'=>'The password field is required',
        ];
    }
}

