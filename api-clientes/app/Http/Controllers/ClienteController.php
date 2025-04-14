<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Models\Cliente;
use App\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function __construct(public ClienteService $serviceCliente)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteStoreRequest $request, Cliente $clienteModel)
    {

        $response = $this->serviceCliente->store($request, $clienteModel);
        return $response;

    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $clienteModel, int $id)
    {
        dd('?');
        $response = $this->serviceCliente->show($clienteModel, $id);
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteUpdateRequest $request,Cliente $clienteModel ,int $id)
    {

        $response = $this->serviceCliente->update($request, $clienteModel, $id);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $clienteModel ,int $id)
    {
        $response = $this->serviceCliente->destroy($clienteModel, $id);
        return $response;
    }

    public function paginate (Cliente $clienteModel, Request $request)
    {
        $response = $this->serviceCliente->paginate($clienteModel, $request);
        return $response;
    }
}
