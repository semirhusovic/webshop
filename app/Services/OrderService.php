<?php

namespace App\Services;

use App\Exceptions\UnavailableQuantity;
use App\Http\Resources\OrderResource;
use App\Mail\OrderCreated;
use App\Models\InvoiceStatus;
use App\Models\Order;
use App\Models\OrderStatus;
use http\Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderService
{
    private $paymentService;
    private $invoiceService;
    public function __construct(PaymentService $paymentService, InvoiceService $invoiceService)
    {
        $this->paymentService = $paymentService;
        $this->invoiceService = $invoiceService;
    }


    /**
     * @throws UnavailableQuantity
     */
    public function createOrder($request)
    {
        if ($this->checkAvailability()) {
            throw new UnavailableQuantity('Not enough quantity in stock');
        }
        $price = $this->calculatePrice();
        $order = Order::query()->create([
            'user_id' => auth()->id(),
            'billing_address' => $request->address,
            'city' => $request->city,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'total_amount' => $price,
            'status_id' => OrderStatus::PENDING
        ]);
        $this->invoiceService->createInvoice($order, $price);

        return $this->paymentService->createPayment($request, $order);
    }

    public function getUserOrders()
    {
        return OrderResource::collection(auth()->user()->orders);
    }

    public function updateOrderStatus($request, $order)
    {
//        $signature = createSignature('POST', $request->getContent(), 'application/json; charset=utf-8', $request->header('X-Date'), $request->getRequestUri());
//        if ($request->header('X-Signature') !== $signature) {
//            return response('', 401);
//        }

        if ($request->result == 'OK') {
            $order->update(['status_id' => OrderStatus::ACCEPTED,'cc_number' => $request->returnData['lastFourDigits']]);
            $this->updateQuantity($order);
            $order->invoice->update(['status_id' => InvoiceStatus::PAID]);
            $order->user->cart->stocks()->detach();
            Mail::to($order->user->email)->send(new OrderCreated($order));
        } else {
            $order->update(['status_id' => OrderStatus::ERROR,'cc_number' => $request->returnData['lastFourDigits']]);
            $order->invoice->update(['status_id' => InvoiceStatus::UNPAID]);
        }

        return response("OK", 200)
            ->header('Content-Type', 'application/json');
    }

    public function calculatePrice()
    {
        $price = 0;
        foreach (auth()->user()->cart->stocks as $p) {
            $price += $p->product->total_price * $p->pivot->quantity;
        }
        return $price;
    }

    public function checkAvailability()
    {
        foreach (auth()->user()->cart->stocks as $product) {
            if ($product->quantity < $product->pivot->quantity) {
                return true;
            }
        }
        return false;
    }

    public function updateQuantity($order)
    {
        DB::transaction(function () use ($order) {
            foreach ($order->user->cart->stocks as $product) {
                $order->stocks()->attach($product->pivot->stock_id, ['quantity'=>$product->pivot->quantity]);
                $product->decrement('quantity', $product->pivot->quantity);
            }
        });
    }
}
