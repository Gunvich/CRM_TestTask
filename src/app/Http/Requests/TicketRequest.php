<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'email' => ['nullable','email'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'files.*' => ['nullable', 'file', 'max:10240'] // 10 MB
        ];
    }
}

