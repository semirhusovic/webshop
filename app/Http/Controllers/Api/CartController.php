<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Stock;
use App\Services\CartService;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $service)
    {
        $this->cartService = $service;
    }

    public function addToCart(Cart $cart, Product $product, Stock $stock)
    {
        $this->cartService->addToCart($cart, $stock);
        return response(['message' => 'Product added to cart!'], 200);
    }


    public function removeFromCart(Cart $cart, Product $product, Stock $stock)
    {
        $this->cartService->removeFromCart($cart, $stock);
        return response(['message' => 'Product removed from cart!'], 204);
    }

    public function deleteFromCart(Cart $cart, Product $product, Stock $stock)
    {
        $this->cartService->deleteFromCart($cart, $stock);
        return response(['message' => 'Product deleted from cart!'], 204);
    }

    public function getUserCartProducts(Cart $cart)
    {
        return CartResource::collection($cart->stocks);


//        return CartResource::collection($cart->products);
//        return auth()->user()->cart->products;
    }
}
