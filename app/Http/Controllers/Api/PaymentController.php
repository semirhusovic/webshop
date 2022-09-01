<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function create(Request $request)
    {
//        return $this->paymentService->createPayment($request);

        // TODO: hash_hmac('sha256', $string, $secret)
        // hex2bin("$hmacKey");
        // base64_encode(string $string)
        // The signature is generated via Hash HMAC using SHA2-512 as hashing algorithm. Afterwards the binary (not hexadecimal!) HMAC must be Base64 encoded.
    }
}
