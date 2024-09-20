<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        $departmentId = $this->route('department') ? $this->route('department')->id : null;
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:departments,code,'.$departmentId,
            'description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'code.required' => 'The code field is required.',
            'code.unique' => 'The code should be unique',
            'description.required'=>'The description field is required',
        ];
    }
}
