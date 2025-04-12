<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteStoreRequest extends FormRequest
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

        $cliente = $this->route('cliente');

        return [
            'nome' => 'required|max:250',
            'cpf' => 'required|max:11|unique:clientes,cpf,'.$cliente->id,
            'email' => 'required|max:250|email:rfc,dns|unique:clientes,email,'.$cliente->id,
            'cep' => 'required|max:8'
        ];
    }
}
