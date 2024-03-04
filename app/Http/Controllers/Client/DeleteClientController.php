<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Client\Infrastructure\DeleteClientController as DeleteClientControllerInfra;

class DeleteClientController extends Controller
{
    private DeleteClientControllerInfra $deleteClientControllerInfra;

    public function __construct(DeleteClientControllerInfra $deleteClientControllerInfra)
    {
        $this->deleteClientControllerInfra = $deleteClientControllerInfra;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $clientData = $this->deleteClientControllerInfra->__invoke($request);

        if (!$clientData) {
            return response(['status' => 'error', 'message' => 'client not found'],  Response::HTTP_NOT_FOUND);
        }

        return response([], Response::HTTP_NO_CONTENT);

    }
}
