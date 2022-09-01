<?php

namespace App\Services;

use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentService
{
    public function createPayment($request, $order)
    {
        $timestamp = (new \DateTime('now', new \DateTimeZone('UTC')))->format('D, d M Y H:i:s \G\M\T');
        $body = [
        "merchantTransactionId" => Str::orderedUuid(),
        "amount" => strval($order->total_amount),
        "currency" => "EUR",
//                    "successUrl" => "http://127.0.0.1:3001/",
        "successUrl" => request()->headers->get('referer').'success',
        "errorUrl" => request()->headers->get('referer').'error',
//                    "callbackUrl" => 'http://127.0.0.1:8000/api/order/'.$order->id,
        "callbackUrl" => 'https://4ce5-94-102-224-245.eu.ngrok.io/api/order/'.$order->id,
//                    "callbackUrl" => 'https://webhook.site/5dfc7aa2-5bb7-418b-900e-2427ef6fa795',
        "customer" => [
            'firstName' => $request->first_name,
            'lastName' => $request->last_name,
            'billingPhone' => $request->phone_number,
            'billingAddress1' => $request->address,
            'billingCity' => $request->city,
            'email' => $request->email,
        ],

        'transactionToken' => $request->transaction_token,
        "threeDSecureData" => [
            "3dsecure" => "OFF" ]
    ];
        $signature = createSignature('POST', json_encode($body), 'application/json; charset=utf-8', $timestamp, '/api/v3/transaction/amplitudo-simulator/debit');
        Log::info(json_encode($body));
        try {
            $response = Http::withBasicAuth('amplitudo-api', 'vwnEzTl$i*n4z39X*83Ld?@aMMkmC')
                ->withHeaders(['Accept' => 'application/json', 'X-Signature' => $signature,'Content-Type' => 'application/json; charset=utf-8'])
                ->post('https://asxgw.paymentsandbox.cloud/api/v3/transaction/amplitudo-simulator/debit', $body);
            return $response->json();
        } catch (BadResponseException $e) {
            return $e->getMessage();
        }
    }
}
