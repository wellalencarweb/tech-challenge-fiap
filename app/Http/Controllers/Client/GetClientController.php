<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Client\Infrastructure\GetClientController as GetClientControllerInfra;

class GetClientController extends Controller
{

    private GetClientControllerInfra $getClientControllerInfra;

    public function __construct(GetClientControllerInfra $getClientControllerInfra)
    {
        $this->getClientControllerInfra = $getClientControllerInfra;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $clientData = $this->getClientControllerInfra->__invoke($request);

        if (!$clientData) {
            return response(['status' => 'error', 'message' => 'client not found'],  Response::HTTP_NOT_FOUND);
        }

        $client = new ClientResource($clientData);
        return response($client, Response::HTTP_OK);
    }
}
