<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Product\Application\Exceptions\ValidationException;
use Src\BoundedContext\Product\Application\Validations\CreateProductValidation;
use Src\BoundedContext\Product\Infrastructure\CreateProductController as CreateProductControllerInfra;

class CreateProductController extends Controller
{
    /**
     * @var \Src\BoundedContext\Product\Infrastructure\CreateProductController
     */
    private CreateProductControllerInfra $createProductControllerInfra;

    public function __construct(CreateProductControllerInfra $createProductControllerInfra)
    {
        $this->createProductControllerInfra = $createProductControllerInfra;
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
            CreateProductValidation::validate($request->all());

            $newProduct = new ProductResource($this->createProductControllerInfra->__invoke($request));

            return response($newProduct, Response::HTTP_CREATED);
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
