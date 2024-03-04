<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Order\Application\Exceptions\ValidationException;
use Src\BoundedContext\Order\Application\Validations\CreateOrderValidation;
use Src\BoundedContext\Order\Infrastructure\CreateOrderController as CreateOrderControllerInfra;

class CreateOrderController extends Controller
{
    /**
     * @var \Src\BoundedContext\Order\Infrastructure\CreateOrderController
     */
    private CreateOrderControllerInfra $createOrderControllerInfra;

    public function __construct(CreateOrderControllerInfra $createOrderControllerInfra)
    {
        $this->createOrderControllerInfra = $createOrderControllerInfra;
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
            CreateOrderValidation::validate($request->all());

            $newOrder = new OrderResource($this->createOrderControllerInfra->__invoke($request));

            return response($newOrder, Response::HTTP_CREATED);
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
