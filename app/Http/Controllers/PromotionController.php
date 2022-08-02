<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Promotion;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $language = session('language') ? session('language') : 'en';
        $filter = $request->filter;
        if (!empty($filter)) {
            $promotions = Promotion::query()
                ->whereHas('translations', function ($query) use ($filter, $language) {
                    $query->where('locale', '=', $language);
                    $query->where('promotionName', 'like', '%'.$filter.'%');
                })
                ->paginate();
        } else {
            $promotions = Promotion::query()->paginate();
        }
        return view('dashboard.promotion.index', ['promotions'=>$promotions,'filter' => $filter]);
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();
        $manufacturers = Manufacturer::all();
        $discounts = Discount::all();


        return view(
            'dashboard.promotion.create',
            ['categories'=>$categories,
                'products'=>$products,
                'manufacturers'=>$manufacturers,
                'discounts' => $discounts,
            ]
        );
    }

    public function store(StorePromotionRequest $request)
    {
        $promotion = Promotion::query()->create($request->only('en', 'me'));
        $filteredProducts = Product::query()
            ->join('category_product', 'products.id', '=', 'product_id')
            ->join('categories', 'categories.id', '=', 'category_product.category_id')
            ->when($request->category, function ($query) use ($request) {
                $query->whereIn("category_product.category_id", $request->category);
            })
            ->when($request->products, function ($query) use ($request) {
                $query->whereIn("category_product.product_id", $request->products);
            })
            ->when($request->price_from, function ($query) use ($request) {
                $query->where("products.productPrice", ">=", $request->price_from);
            })
            ->when($request->price_to, function ($query) use ($request) {
                $query->where("products.productPrice", "<=", $request->price_to);
            })
            ->when($request->manufacturer, function ($query) use ($request) {
                $query->where("products.manufacturer_id", "=", $request->manufacturer);
            })
            ->select(['products.id'])
            ->distinct()
            ->get();

        $promotion->products()->attach($filteredProducts);
        if ($request->has('discount')) {
            $promotion->discounts()->attach($request->discount);
        }
        return redirect()->route('promotion.index')->withToastSuccess('Promotion created successfully!');
    }


    public function show(Promotion $promotion)
    {
        return view('dashboard.promotion.show', ['promotion' => $promotion]);
    }

    public function edit(Promotion $promotion)
    {
        $categories = Category::all();
        $products = Product::all();
        $manufacturers = Manufacturer::all();
        $discounts = Discount::all();
        return view(
            'dashboard.promotion.edit',
            [
                'categories'=>$categories,
                'products'=>$products,
                'manufacturers'=>$manufacturers,
                'promotion'=>$promotion,
                'discounts' => $discounts
            ]
        );
    }


    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        dd($request);
    }


    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('promotion.index')->withToastSuccess('Promotion deleted successfully!');
    }

    public function removeProductFromPromotion(Request $request)
    {
        $promotion = Promotion::findOrFail($request->promotion);
        $promotion->products()->detach($request->product);
        return redirect()->back()->withToastSuccess('Product deleted from promotion successfully!');
    }

    public function filterProducts(Request $request)
    {
            $filteredProducts = Product::query()->with('images')->with('manufacturer')
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
                    $query->where("products.productPrice", ">=", (float) $request->price_from);
                })
                ->when($request->price_to, function ($query) use ($request) {
                    $query->where("products.productPrice", "<=", (float) $request->price_to);
                })
                ->when($request->manufacturingDateStart, function ($query) use ($request) {
                    $query->where("products.productManufacturingDate", ">=", $request->manufacturingDateStart);
                })
                ->when($request->manufacturingDateEnd, function ($query) use ($request) {
                    $query->where("products.productManufacturingDate", "<=", $request->manufacturingDateEnd);
                })
                ->when($request->manufacturer, function ($query) use ($request) {
                    $query->where("products.manufacturer_id", "=", $request->manufacturer);
                })
                ->selectRaw('products.*')
                ->distinct()
                ->get();
        return $filteredProducts;
    }
}
