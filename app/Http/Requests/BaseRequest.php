<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Base request class.
 */
class BaseRequest extends FormRequest
{
    /**
     * Stop on failure.
     *
     * @var boolean
     */
    protected $stopOnFirstFailure = true;

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'data' => '',
                'error' => [
                    'message' => 'Missing fields'
                ]
            ], Response::HTTP_BAD_REQUEST)
        );
    }
}
