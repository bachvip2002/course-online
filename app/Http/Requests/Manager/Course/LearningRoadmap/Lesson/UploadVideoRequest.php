<?php

namespace App\Http\Requests\Manager\Course\LearningRoadmap\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class UploadVideoRequest extends FormRequest
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
            'avatar_path' => ['required', 'file', 'mimes:png,jpg', 'max:5120'],
            'video_path' => ['required', 'file', 'mimes:mp4', 'max:1000000'],
        ];
    }

    public function messages()
    {
        return MESSAGE_COMMON_VALIDATE;
    }
}
