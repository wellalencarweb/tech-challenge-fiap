<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Adapters\ClientAdapter;
use Src\Controllers\Client\GetClientController;


class GetClientControllerApi extends Controller
{

    private GetClientController $getClientController;

    public function __construct(GetClientController $getClientController)
    {
        $this->getClientController = $getClientController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $clientData = $this->getClientController->__invoke($request);

        $adapted = new ClientAdapter($clientData);

        if (!$adapted->resource) {
            return $adapted->adaptJsonClients(['status' => 'error', 'message' => 'client not found'], Response::HTTP_NOT_FOUND);
        }

        return $adapted->adaptJsonClients($adapted, Response::HTTP_OK);
    }
}
