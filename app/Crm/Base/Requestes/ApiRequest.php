<?php

namespace Crm\Base\Requestes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Override this method in child classes if needed
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     * Returns JSON response instead of redirecting
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    /**
     * Handle a failed authorization attempt.
     * Returns JSON response for unauthorized access
     *
     * @throws HttpResponseException
     */
    protected function failedAuthorization(): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Unauthorized Access',
            ], JsonResponse::HTTP_FORBIDDEN)
        );
    }

    /**
     * Get custom messages for validator errors.
     * Override this method in child classes for custom messages
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'min' => 'The :attribute must be at least :min characters.',
            'max' => 'The :attribute may not be greater than :max characters.',
            'email' => 'The :attribute must be a valid email address.',
            'unique' => 'The :attribute has already been taken.',
            'exists' => 'The selected :attribute is invalid.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     * Override this method in child classes for custom attribute names
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [];
    }
}
