<?php

namespace App\Http\Requests\Manager\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email' => 'required|email|unique:user,email',
            'password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/',
            'id_login' => 'required|regex:/^[a-zA-Z0-9]+$/|unique:user,id_login',
            'status' => 'required|numeric|between:1,3',
            'address' => 'required',
            'phone_number' => 'required|regex:/^\d{10}$/',
            'avatar' => 'required|file|mimes:png,jpg|max:5120',
            'description' => 'max:500',
        ];
    }


    public function messages()
    {
        return MESSAGE_COMMON_VALIDATE;
    }
}
