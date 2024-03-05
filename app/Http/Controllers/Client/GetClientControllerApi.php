<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Adapters\ClientAdapter;
use Src\Controllers\Client\GetClientController;


class GetClientControllerApi extends Controller
{

    public function __construct(
        private GetClientController $getClientController,
        private ClientAdapter $clientAdapter
    ){
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

        if (!$clientData) {
            return $this->clientAdapter->adaptJsonMessageError(['status' => 'error', 'message' => 'client not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->clientAdapter->adaptJsonClients($clientData, Response::HTTP_OK);
    }
}
