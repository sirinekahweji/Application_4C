<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperienceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            /*'poste' => 'required|string',
            'entreprise' => 'required|string',
            'lieu' => 'required|string',
            'dateDebut' => 'required|date',
            'dateFin' => 'nullable|date|after_or_equal:dateDebut',
            'description' => 'required|string',
            'profil_id' => 'required|exists:profils,id',*/
            // Ajoutez ici d'autres règles de validation pour vos champs si nécessaire
    
        ];
    }
}
