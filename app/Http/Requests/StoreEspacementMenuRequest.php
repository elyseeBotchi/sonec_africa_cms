<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEspacementMenuRequest extends FormRequest
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
            //
            'espacement' => 'required|integer|min:0',
            'menu_id' => 'required|exists:menus,id',
            'gras' => 'boolean',
            'italique' => 'boolean',
            'alignement' => 'in:horizontal,vertical',
            'couleur_fond_icon' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'espacement.required' => 'Le champ espacement est obligatoire.',
            'espacement.integer' => 'Le champ espacement doit être un entier.',
            'espacement.min' => 'Le champ espacement doit être supérieur ou égal à 0.',
            'menu_id.required' => 'Le champ menu_id est obligatoire.',
            'menu_id.exists' => 'Le menu sélectionné est invalide.',
            'gras.boolean' => 'Le champ gras doit être un booléen.',
            'italique.boolean' => 'Le champ italique doit être un booléen.',
            'alignement.in' => 'Le champ alignement doit être soit horizontal, soit vertical.',
            'couleur_fond_icon.boolean' => 'Le champ couleur_fond_icon doit être un booléen.',
        ];
    }
}
