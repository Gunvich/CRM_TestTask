<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^\+[1-9]\d{1,14}$/'],
            'email' => ['nullable', 'email'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'attachment' => ['nullable', 'array'],
            'attachment.*' => ['file', 'max:10240'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $test= 1;
        // 422 Unprocessable Entity (стандарт для validation)
        throw new HttpResponseException(response()->json([
            'error' => 'validation_failed',
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }

}

