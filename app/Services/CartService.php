<?php

namespace App\Services;

class CartService
{
    public function addToCart($cart, $product): void
    {
        $exists = $cart->products->where('id', '=', $product->id);
        if (count($exists) > 0) {
            $cart->products()->updateExistingPivot($product->id, [
            'quantity' => $exists->first()->pivot->quantity + 1,
        ]);
        } else {
            $cart->products()->attach($product->id, ['quantity' => 1]);
        }
    }

    public function removeFromCart($cart, $product): void
    {
        $quantity = $cart->products->where('id', '=', $product->id)->first()->pivot->quantity;
        if ($quantity>1) {
            $cart->products()->updateExistingPivot($product->id, [
                'quantity' => $quantity - 1,
            ]);
        }

        if ($quantity==1) {
            $cart->products()->detach($product->id);
        }
    }

    public function deleteFromCart($cart,$product) : void {
        $cart->products()->detach($product->id);
    }
}
