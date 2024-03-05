<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Src\Controllers\Client\CreateClientController;

class CreateClientControllerApi extends Controller
{
    public function __construct(
        private CreateClientController $createClientController
    ){
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return $this->createClientController->__invoke($request);
    }
}
