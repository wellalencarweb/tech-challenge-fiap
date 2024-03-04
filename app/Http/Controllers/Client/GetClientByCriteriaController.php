<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Client\Infrastructure\GetClientByCriteriaController as GetClientByCriteriaControllerInfra;

class GetClientByCriteriaController extends Controller
{

    private GetClientByCriteriaControllerInfra $getClientByCriteriaController;

    public function __construct(GetClientByCriteriaControllerInfra $getClientByCriteriaController)
    {
        $this->getClientByCriteriaController = $getClientByCriteriaController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $clientsData = $this->getClientByCriteriaController->__invoke($request);

        if (!$clientsData) {
            return response(['status' => 'error', 'message' => 'client not found'],  Response::HTTP_NOT_FOUND);
        }

        $clients = new ClientResource($clientsData);
        return response($clients, Response::HTTP_OK);
    }
}
