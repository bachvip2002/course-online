<?php

namespace App\Trait;

use App\Helper\HttpStatusCode;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

trait ValidationTrait
{
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors(); // Here is your array of errors

        $response = response()->json([
            'message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], HttpStatusCode::UNPROCESSABLE_ENTITY);

        throw new HttpResponseException($response);
    }
}
