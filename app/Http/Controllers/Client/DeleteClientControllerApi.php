<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Controllers\Client\DeleteClientController;

class DeleteClientControllerApi extends Controller
{
    public function __construct(
        private DeleteClientController $deleteClientController
    ){
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): Response
    {
        return $this->deleteClientController->__invoke($request);
    }
}
