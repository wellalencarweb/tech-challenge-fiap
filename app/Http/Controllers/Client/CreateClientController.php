<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Client\Application\Exceptions\ValidationException;
use Src\BoundedContext\Client\Application\Validations\CreateClientValidation;
use Src\BoundedContext\Client\Infrastructure\CreateClientController as CreateClientControllerInfra;

class CreateClientController extends Controller
{
    /**
     * @var \Src\BoundedContext\Client\Infrastructure\CreateClientController
     */
    private CreateClientControllerInfra $createClientControllerInfra;

    public function __construct(CreateClientControllerInfra $createClientControllerInfra)
    {
        $this->createClientControllerInfra = $createClientControllerInfra;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        try {
            CreateClientValidation::validate($request->all());

            $newClient = new ClientResource($this->createClientControllerInfra->__invoke($request));

            return response($newClient, Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (QueryException $e) {
            return response([
                'status' => 'error',
                'message' => 'Error processing the request. Please try again.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
