<?php

namespace App\Http\Requests\Trait;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

trait FormatValidationJson
{
    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        $error = (new ValidationException($validator))->errors();
        $message = (new ValidationException($validator))->getMessage();
        throw new HttpResponseException(
            response()->json(
                [
                    'success' => false,
                    'message' => $message,
                    'fails' => $error

                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
