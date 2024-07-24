<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBadgeRequest extends FormRequest
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
            /*'nom' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', //  règle pour l'image
            'type' => 'required|string',
            'profil_id' => 'required|integer',*/
        ];
    }
}
