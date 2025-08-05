<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRqt extends FormRequest
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
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:password',
        ];
    }

    public function messages(){
        return [
            'email.email' => 'Votre adresse mail n\'est pas valide',
            'email.unique' => 'Ce email est déjà lié à un utilisateur',
        ];
    }
}
