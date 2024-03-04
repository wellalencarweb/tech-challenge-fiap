<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Client\Infrastructure\UpdateClientController as UpdateClientControllerInfra;

class UpdateClientController extends Controller
{
    private UpdateClientControllerInfra $updateClientControllerInfra;

    public function __construct(UpdateClientControllerInfra $updateClientControllerInfra)
    {
        $this->updateClientControllerInfra = $updateClientControllerInfra;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $clientData = $this->updateClientControllerInfra->__invoke($request);

        if (!$clientData) {
            return response(['status' => 'error', 'message' => 'client not found'],  Response::HTTP_NOT_FOUND);
        }

        $updatedClient = new ClientResource($clientData);
        return response($updatedClient, Response::HTTP_OK);
    }
}
