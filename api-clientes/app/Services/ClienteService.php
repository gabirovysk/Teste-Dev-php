<?php   

namespace App\Services;

use App\Http\Resources\ClienteResource;
use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;

class ClienteService
{

    public function show(Cliente $clienteModel, int $id)
    {   
        return ClienteResource::make($clienteModel->find($id));
    }

    public function store(Request $request, Cliente $clienteModel) 
    {
        try {
            $clienteModel->nome = $request->nome;
            $clienteModel->email = $request->email;
            $clienteModel->cpf = $request->cpf;
            $clienteModel->cep = $request->cep;
            $clienteModel->endereco = 'fazer consulta';
            $clienteModel->save();

  
            return ['success' => 'Dados inseridos com sucesso!'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }        
    }

    public function update(Request $request, Cliente $clienteModel, int $id) 
    {
        try {
            $cliente = $clienteModel->find($id);
            (empty($request->nome) || $request->nome == NULL) ?: $cliente->nome = $request->nome;
            (empty($request->email) || $request->email != NULL) ?: $cliente->email = $request->email;
            (empty($request->cpf) || $request->cpf != NULL) ?: $cliente->cpf = $request->cpf;
            (empty($request->cep) || $request->cep != NULL) ?: $cliente->cep = $request->cep;

            $cliente->endereco = 'fazer consulta';
            $cliente->save();
            
            return ['success' => 'Dados atualizados com sucesso!'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }  

    }

    public function destroy(Cliente $clienteModel,  int $id) 
    {
        try {      

            $cliente = $clienteModel::find($id);

            if(!$cliente){
                return ['error' => 'Cliente não encentrado'];
            }

            $cliente->delete();

            return ['success' => 'Dados apagados com sucesso!'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }  
    }


}
