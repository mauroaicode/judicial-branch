<?php

namespace Core\Shared\Infrastructure\FormRequest;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AppBaseFormRequest extends FormRequest
{
    /**
     * Handles the response when the request validation fails.
     *
     * @param Validator $validator The validator containing the validation errors.
     * @throws HttpResponseException Throws an exception with a JSON response containing the validation errors.
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([

            'isSuccessful' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors()

        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
