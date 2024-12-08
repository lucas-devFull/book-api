<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        return OrderResource::collection($orders);
    }

    public function show($id)
    {
        $order = $this->orderService->getOrderById($id);
        return new OrderResource($order);
    }

    public function store(OrderRequest $request)
    {
        $data = $request->validated();
        $order = $this->orderService->createOrder($data);
        return new OrderResource($order, 201);
    }

    public function update(OrderRequest $request, $id)
    {
        $data = $request->validated();
        $order = $this->orderService->updateOrder($id, $data);
        return new OrderResource($order);
    }

    public function destroy($id)
    {
        $this->orderService->deleteOrder($id);
        return response()->json(['message' => 'Order deleted successfully.'], 204);
    }
}
