<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
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
            'name' => 'filled|string|max:255',
            'slug' => 'sometimes|string|max:255', 

        ];
    }

    public function messages()
    {
        return [
            'name.filled' => 'Le libellé est obligatoire',
            'name.string' => 'Le libellé doit être une chaîne de caractères',   
        ];
    }
}
