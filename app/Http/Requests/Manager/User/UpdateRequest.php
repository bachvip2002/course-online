<?php

namespace App\Http\Requests\Manager\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'full_name' => 'required',
            'email' => 'required|email|unique:user,email,' . request()->query('user_id'),
            'password' => 'nullable|regex:/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/',
            'id_login' => 'required|regex:/^[a-zA-Z0-9]+$/|unique:user,id_login,' . request()->query('user_id'),
            'status' => 'required|numeric|between:1,3',
            'address' => 'required',
            'phone_number' => 'required|regex:/^\d{10}$/',
            'avatar_path' => 'nullable|file|mimes:png,jpg|max:5120',
            'description' => 'max:500',
        ];
    }

    public function messages()
    {
        return MESSAGE_COMMON_VALIDATE;
    }
}
