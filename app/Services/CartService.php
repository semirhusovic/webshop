<?php

namespace App\Services;

use App\Exceptions\UnavailableQuantity;

class CartService
{
    /*
     *
     */
    public function addToCart($cart, $stock): void
    {
        $exists = $cart->stocks->where('id', '=', $stock->id);
        if (count($exists) > 0) {
            $cart->stocks()->updateExistingPivot($stock->id, [
                'quantity' => $exists->first()->pivot->quantity + 1,
            ]);
        } else {
            $cart->stocks()->attach($stock->id, ['quantity' => 1]);
        }
    }

    public function removeFromCart($cart, $stock): void
    {
        $quantity = $cart->stocks->where('id', '=', $stock->id)->first()->pivot->quantity;
        if ($quantity>1) {
            $cart->stocks()->updateExistingPivot($stock->id, [
                'quantity' => $quantity - 1,
            ]);
        }

        if ($quantity==1) {
            $cart->stocks()->detach($stock->id);
        }
    }

    public function deleteFromCart($cart, $stock) : void
    {
        $cart->stocks()->detach($stock->id);
    }
}
