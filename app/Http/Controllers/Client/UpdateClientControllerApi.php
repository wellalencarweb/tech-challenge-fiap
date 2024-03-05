<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Controllers\Client\UpdateClientController;

class UpdateClientControllerApi extends Controller
{
    public function __construct(
        private UpdateClientController $updateClientController
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
        return $this->updateClientController->__invoke($request);

    }
}
