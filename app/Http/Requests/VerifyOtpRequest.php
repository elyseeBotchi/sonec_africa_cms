<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        
            'otp' => 'required|string|max:6',
        ];
    }

    public function messages(): array
    {
        return [
            'otp.required' => 'Le code OTP est requis.',
            'otp.string' => 'Le code OTP doit être une chaîne de caractères.',
            'otp.max' => 'Le code OTP ne doit pas dépasser 6 caractères.',
        ];
    }
}
