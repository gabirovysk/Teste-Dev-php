<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'email' => $this->email,
            'cep' => $this->cep,
            'endereco' =>$this->endereco,
            'updated_at' => $this->updated_at
        ];
    }
}
