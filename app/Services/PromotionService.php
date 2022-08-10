<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;

class PromotionService
{
    public function searchItems($request)
    {
        $language = session('language') ? session('language') : 'en';
        $filter = $request->filter;
        return Promotion::query()
            ->when($request->filter, function ($query) use ($filter, $language) {
                $query->whereHas('translations', function ($query) use ($filter, $language) {
                    $query->where('locale', 'like', $language);
                    $query->where('promotion_name', 'like', '%'.$filter.'%');
                });
            })
            ->paginate();
    }

    public function createPromotion($request): void
    {
        DB::transaction(function () use ($request) {
            $request->filteredIds !== null ?
                $filteredProducts = array_unique(explode(' ', trim($request->filteredIds)))
                :
                $filteredProducts = [];
            $promotion = Promotion::query()->create($request->only('en', 'me'));
            if (count($filteredProducts)>0) {
                $promotion->products()->attach($filteredProducts);
            }
            if ($request->has('discount')) {
                $promotion->discounts()->attach($request->discount);
            }
        });
    }

    public function deletePromotion($promotion): void
    {
        $promotion->delete();
    }

    public function deleteProductFromPromotion($promotion, $product): void
    {
        $promotion->products()->detach($product->id);
    }

    public function filterItems($request): \Illuminate\Database\Eloquent\Collection|array
    {
        return Product::query()
            ->join('category_product', 'products.id', '=', 'product_id')
            ->join('categories', 'categories.id', '=', 'category_product.category_id')
            ->join('countries', 'countries.id', '=', 'products.country_id')
            ->when($request->category, function ($query) use ($request) {
                $query->whereIn("category_product.category_id", $request->category);
            })
            ->when($request->products, function ($query) use ($request) {
                $query->whereIn("category_product.product_id", $request->products);
            })
            ->when($request->price_from, function ($query) use ($request) {
                $query->where("products.product_price", ">=", (float)$request->price_from);
            })
            ->when($request->price_to, function ($query) use ($request) {
                $query->where("products.product_price", "<=", (float)$request->price_to);
            })
            ->when($request->manufacturingDateStart, function ($query) use ($request) {
                $query->where("products.product_manufacturing_date", ">=", $request->manufacturingDateStart);
            })
            ->when($request->manufacturingDateEnd, function ($query) use ($request) {
                $query->where("products.product_manufacturing_date", "<=", $request->manufacturingDateEnd);
            })
            ->when($request->manufacturer, function ($query) use ($request) {
                $query->where("products.manufacturer_id", "=", $request->manufacturer);
            })
            ->selectRaw('products.*')
            ->distinct()
            ->get();
    }
}
