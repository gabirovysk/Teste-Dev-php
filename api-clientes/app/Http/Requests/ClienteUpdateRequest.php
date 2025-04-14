<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateRequest extends FormRequest
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
            'nome' => 'max:250',
            'cpf' => 'min:11max:11|unique:clientes,cpf',
            'email' => 'max:250|email:rfc,dns|unique:clientes,email',
            'cep' => 'min:8|max:8'
        ];
    }
}
