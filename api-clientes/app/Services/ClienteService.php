<?php   

namespace App\Services;

use App\Http\Resources\ClienteResource;
use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

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
            $enderecoArray = $this->consultarClienteCep($request->cep);

            $enderecoArray['numero'] = $request->numeroEndereco;
            $enderecoVerificado = $this->verificarERetornarEnderecoCorretoParaSalvar($enderecoArray, null);
            if ($enderecoVerificado['diferente'] == true) {
                $clienteModel->endereco = $enderecoVerificado['endereco'];
            }
            $clienteModel->save();
  
            return ['success' => 'Dados inseridos com sucesso!'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }        
    }

    public function update(Request $request, Cliente $clienteModel, int $id) 
    {
        //dd($request);
        try {
            $cliente = $clienteModel->find($id);
            if($cliente == NULL){
                throw ValidationException::withMessages(['cliente' => 'Cliente Não encontrado!']);
            }
            (empty($request->nome) || $request->nome == NULL) ?: 
            $cliente->nome = $request->nome;
            (empty($request->email) || $request->email == NULL) ?: $cliente->email = $request->email;
            (empty($request->cpf) || $request->cpf == NULL) ?: $cliente->cpf = $request->cpf;

            if (!empty($request->cep) || $request->cep != NULL) {
                $cliente->cep = $request->cep;

                $enderecoArray = $this->consultarClienteCep($request->cep);
            
                $enderecoArray['numero'] = $request->numeroEndereco;
                $enderecoVerificado = $this->verificarERetornarEnderecoCorretoParaSalvar($enderecoArray, null);
                if ($enderecoVerificado['diferente'] == true) {
                    $cliente->endereco = $enderecoVerificado['endereco'];
                }
            }

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

    //consulta o cep do cliente
    public function consultarClienteCep (string $cep) 
    {
        $response = Http::withOptions(['verify' => false])->get('https://brasilapi.com.br/api/cep/v2/'.$cep)->json();

        if(empty($response)|| $response == null) {
            throw ValidationException::withMessages(['cep' => 'O cep está incorreto.']);
        }
        if(!empty($response['type'] )){
            throw ValidationException::withMessages(['cep' => 'O cep está incorreto!']);
        }
        return $response;

    }

    public function verificarERetornarEnderecoCorretoParaSalvar (array $endArray, ?string $endAtual) 
    {
        $endFormatado = "{$endArray['street']} {$endArray['numero']}, {$endArray['neighborhood']} - {$endArray['city']}/{$endArray['state']}";

        if ($endFormatado === $endAtual) {
            return [
                'diferente' => false,
                'endereco' =>''
            ];
        } else {
            return [
                'diferente' => true,
                'endereco' => $endFormatado
            ];
        }
    }

    public function paginate (Cliente $clienteModel, Request $request) 
    {
        if( (empty($request->perPage)|| $request->perPage == null) || (empty($request->page)|| $request->page == null)  ) {
            throw ValidationException::withMessages(['paginacao' => 'Envie os parametros page e perPage preenchidos.']);
        }

        if (!empty($request->cpf)|| $request->cpf != null) {
            $clienteModel= $clienteModel->where('cpf','=',$request->cpf);
        }
        if (!empty($request->nome)|| $request->nome != null) {
            $clienteModel= $clienteModel->where('nome','like','%'.$request->nome.'%');
        }
        if (!empty($request->cep)|| $request->cep != null) {
            $clienteModel= $clienteModel->where('cep','=',$request->cep);
        }

        return $clienteModel->simplePaginate($request->perPage);

    }


}
