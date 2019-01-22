<?php

namespace App\Http\Controllers;

use App\Exceptions\GenericException;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderRepository;
use App\Services\OrderService;
use App\Transformers\OrderTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    protected $orderService;
    protected $orderRepository;
    protected $orderTransformer;

    public function __construct(OrderService $orderService, OrderRepository $orderRepository, OrderTransformer $orderTransformer)
    {
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
        $this->orderTransformer = $orderTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     * @throws \App\Exceptions\TransformerException
     * @throws \Exception
     */
    public function index(Request $request)
    {
        return Response::json(
            $this->orderTransformer->transformCollection($this->orderService->fetchOrders($request->all()))['data']
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function store(StoreOrderRequest $request)
    {
        return Response::json($this->orderTransformer->transform($this->orderService->storeOrder($request->all())));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateOrderRequest $request
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function update(UpdateOrderRequest $request, $id)
    {
        $order = $this->orderService->fetchOrderById($id);
        if (!$order)
            return Response::json([
                'error' => "Order not found"
            ], 404);

        if ($order->status === ORDER_TAKEN)
            return Response::json([
                'error' => "Order already taken"
            ], 400);

        if ($this->orderService->updateOrder(['status' => $request->status], $id))
            return Response::json([
                'status' => "SUCCESS"
            ]);

        throw new GenericException;
    }
}
