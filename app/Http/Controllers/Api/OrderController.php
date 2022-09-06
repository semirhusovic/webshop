<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Services\OrderService;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    private $orderService;
    public function __construct(OrderService $orderService)
    {
        return $this->orderService = $orderService;
    }

    public function index()
    {
        return $this->orderService->getUserOrders();
    }

    public function create(StoreOrderRequest $request)
    {
        return $this->orderService->createOrder($request);
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        return $this->orderService->updateOrderStatus($request, $order);
    }
}
