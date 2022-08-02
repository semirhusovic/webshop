<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        //
    }


    public function store(Request $request)
    {
    }

    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function addToCart(Request $request)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id()
        ]);
        $product = Product::query()->where('id', $request->product_id)->first();
        $exists = $cart->products->where('id', '=', $request->product_id);
        if (count($exists) > 0) {
            $cart->products()->updateExistingPivot($request->product_id, [
                'quantity' => $request->quantity + $exists->first()->pivot->quantity,
            ]);
        } else {
            $cart->products()->attach($product->id, ['quantity' => $request->quantity]);
        }

        return response(['message' => 'Product added to cart!'
        ], 201);
    }

    public function removeFromCart(Request $request)
    {
        $cart = Cart::findOrFail([
            'user_id' => auth()->id()
        ])->first();

        $quantity = $cart->products->where('id', '=', $request->product_id)->first()->pivot->quantity;

        if ($quantity>1) {
            $cart->products()->updateExistingPivot($request->product_id, [
                'quantity' => $quantity - $request->quantity,
            ]);
        }
        //TODO: zamijeniti updateExistingPivot sa sync

        if ($quantity==1) {
            $cart->products()->detach($request->product_id);
        }

        return response(['message' => 'Product removed to cart!'
        ], 201);
    }

    public function deleteFromCart(Request $request)
    {
        $cart = Cart::findOrFail([
            'user_id' => auth()->id()
        ])->first();
        $cart->products()->detach($request->product_id);

        return response(['message' => 'Product deleted from cart!'
        ], 200);
    }

    public function getUserCartProducts()
    {
        return auth()->user()->cart->first()->products;
    }
}
