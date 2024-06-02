<?php

namespace Nuvem\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Nuvem\Http\Resources\Order\OrderResource;
use Nuvem\Http\Requests\Order as Requests;
use Nuvem\Services\OrderManager;

class OrderController extends Controller
{
    /**
     * @var OrderManager
     */
    private $service;

    public function __construct(OrderManager $service)
    {
        $this->service = $service;
    }

    public function create(Requests\Create $request)
    {
        $order = $this->service->create($request->all());

        return (new OrderResource($order))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
