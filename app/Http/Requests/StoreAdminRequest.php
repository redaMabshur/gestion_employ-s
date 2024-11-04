<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            //
            'name' => 'required',
            'email' => 'required|email|unique:users,email',


        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'le nom de l\'administarteur est requis',
            'email.required' => 'l\'émail est requis',
            'email.email' => 'l\'émail n\'est pas validé',
            'email.unique' => 'cette adresse mail est  lié à 
            un autre compte',
        ];
    }
}
