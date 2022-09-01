<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ColorResource;
use App\Http\Resources\StockResource;
use App\Models\Product;
use App\Models\Size;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    //test
    public function show(Product $product)
    {
        return StockResource::collection(
            Stock::query()
                ->with('size')
                ->where('product_id', '=', $product->id)
                ->groupBy('size_id')
                ->get()
        );
    }

    public function StockItemColors(Product $product, Size $size)
    {
        return ColorResource::collection(
            Stock::query()
                ->with('color')
                ->with('size')
                ->where('product_id', '=', $product->id)
                ->where('size_id', '=', $size->id)
                ->get()
        );
    }

}
