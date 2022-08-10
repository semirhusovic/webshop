<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function createProduct(Request $request)
    {
        DB::transaction(function () use ($request) {
            $product = Product::query()->create($request->except('image', 'category', 'discount'));
            $product->categories()->attach($request->category);
            if ($request->has('discount')) {
                $product->discounts()->attach($request->discount);
            }
            uploadImages($request, 'App\Models\Product', $product->id);
        });
    }

    public function updateProduct(Request $request, Product $product)
    {
        DB::transaction(function () use ($request, $product) {
            $product->categories()->detach();
            $product->discounts()->detach($request->discount);
            if ($request->has('image')) {
                deleteImages($product->images);
                uploadImages($request, 'App\Models\Product', $product->id);
            }
            $product->updateOrFail($request->except('image', 'category', 'discount'));
            $product->categories()->attach($request->category);
            if ($request->has('discount')) {
                $product->discounts()->attach($request->discount);
            }
        });
    }

    public function filterItems($request)
    {
        $language = session('language') ? session('language') : 'en';
        $filter = $request->filter;
        return Product::query()
            ->when($request->filter, function ($query) use ($filter, $language) {
                $query->whereHas('translations', function ($query) use ($filter, $language) {
                    $query->where('locale', 'like', $language);
                    $query->where('product_name', 'like', '%'.$filter.'%');
                });
            })
            ->sortable()
            ->paginate();
    }

    public function deleteProduct($product): void
    {
        $product->delete();
        deleteImages($product->images);
    }

    public function getProductsByCategory($request)
    {
        return Product::query()
            ->join('category_product', 'products.id', '=', 'product_id')
            ->join('categories', 'categories.id', '=', 'category_product.category_id')
            ->when($request->category, function ($query) use ($request) {
                $query->whereIn("category_product.category_id", $request->category);
            })
            ->select('products.*')
            ->get();
    }
}
