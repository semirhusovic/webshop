<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index()
    {
//        return Product::query()->with('images')->get();

        return ProductResource::collection(Product::all());
    }

    public function show(Product $product): ProductResource
    {
//        return Product::with('images')->findOrFail($product->id);
        return new ProductResource($product);
    }



}
