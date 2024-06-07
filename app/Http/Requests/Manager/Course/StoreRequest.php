<?php

namespace App\Http\Requests\Manager\Course;

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
            'code' => ['required', 'unique:course,code'],
            'name' => ['required'],
            'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'image' => ['required', 'file', 'mimes:png,jpg', 'max:5120'],
            'release_datetime' => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'description' => ['max:500'],
        ];
    }

    public function messages()
    {
        return MESSAGE_COMMON_VALIDATE;
    }
}
