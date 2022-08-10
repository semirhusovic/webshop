<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Services\CartService;
use App\Services\SliderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $service)
    {
        $this->cartService = $service;
    }

    public function addToCart(Cart $cart, Product $product)
    {
        $this->cartService->addToCart($cart, $product);
        return response(['message' => 'Product added to cart!'], 200);
    }


    public function removeFromCart(Cart $cart, Product $product)
    {
        $this->cartService->removeFromCart($cart, $product);
        return response(['message' => 'Product removed from cart!'], 204);
    }

    public function deleteFromCart(Cart $cart, Product $product)
    {
        $this->cartService->deleteFromCart($cart, $product);
        return response(['message' => 'Product deleted from cart!'], 204);
    }

    public function getUserCartProducts(Cart $cart)
    {
        return CartResource::collection($cart->products);
//        return auth()->user()->cart->products;
    }
}
