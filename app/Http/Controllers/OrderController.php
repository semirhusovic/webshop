<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
//      $payment_data =  [
//          {
//            "merchantTransactionId": "2019-09-02-0001",
//            "amount": "9.99",
//            "currency": "EUR"
//          }
//      ];



        try {
            $response = Http::post('https://asxgw.paymentsandbox.cloud/', [
                'name' => 'Steve',
                'role' => 'Network Administrator',
            ]);
            print_r($response->getBody()->getContents());

        } catch (BadResponseException $e) {
            // handle exception or api errors.
            dd($e->getMessage());
        }
    }


    public function create()
    {
        //
    }


    public function store(StoreOrderRequest $request)
    {
        //
    }


    public function show(Order $order)
    {
        //
    }


    public function edit(Order $order)
    {
        //
    }


    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }


    public function destroy(Order $order)
    {
        //
    }
}
