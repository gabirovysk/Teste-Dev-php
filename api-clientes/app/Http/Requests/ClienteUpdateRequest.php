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

        $cliente_id = $this->route('cliente');

        return [
            'nome' => 'max:250',
            'cpf' => 'max:11|unique:clientes,cpf,'.($cliente_id ? $cliente_id->id : NULL),
            'email' => 'max:250|email:rfc,dns|unique:clientes,email,'.($cliente_id ? $cliente_id->id : NULL),
            'cep' => 'max:8'
        ];
    }
}
