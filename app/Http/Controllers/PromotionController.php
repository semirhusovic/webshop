<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Promotion;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Services\PromotionService;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    private $promotionService;

    public function __construct(PromotionService $service)
    {
        $this->promotionService = $service;
    }



    public function index(Request $request)
    {
        $filter = $request->filter;
        $promotions = $this->promotionService->searchItems($request);
        return view('dashboard.promotion.index', compact('promotions', 'filter'));
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();
        $manufacturers = Manufacturer::all();
        $discounts = Discount::all();
        return view(
            'dashboard.promotion.create',
            compact('categories', 'products', 'manufacturers', 'discounts')
        );
    }

    public function store(StorePromotionRequest $request)
    {
        $this->promotionService->createPromotion($request);
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
            compact('categories', 'products', 'manufacturers', 'discounts')
        );
    }


    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        dd($request);
    }


    public function destroy(Promotion $promotion)
    {
        $this->promotionService->deletePromotion($promotion);
        return redirect()->route('promotion.index')->withToastSuccess('Promotion deleted successfully!');
    }

    public function removeProductFromPromotion(Promotion $promotion, Product $product)
    {
        $this->promotionService->deleteProductFromPromotion($promotion, $product);
        return redirect()->back()->withToastSuccess('Product deleted from promotion successfully!');
    }

    public function filterProducts(Request $request)
    {
        return $this->promotionService->filterItems($request);
    }
}
