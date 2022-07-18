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

    public function index()
    {
        $promotions = Promotion::query()->paginate();
        return view('dashboard.promotion.index',['promotions'=>$promotions]);
    }

    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        $manufacturers = Manufacturer::all();
        $discounts = Discount::all();
        return view('dashboard.promotion.create',
            ['categories'=>$categories,
                'products'=>$products,
                'manufacturers'=>$manufacturers,
                'discounts' => $discounts
            ]);
    }

    public function store(StorePromotionRequest $request)
    {
        $promotion = Promotion::query()->create($request->only('en','sr'));
//        dump($request);
        $filteredProducts = Product::query()
            ->join('category_product','products.id','=','product_id')
            ->join('categories','categories.id','=','category_product.category_id')
            ->when($request->category, function($query) use ($request){
                $query->whereIn("category_product.category_id",$request->category);
            })
            ->when($request->products, function($query) use ($request){
                $query->whereIn("category_product.product_id",$request->products);
            })
            ->when($request->price_from, function($query) use ($request){
                $query->where("products.productPrice", ">=", $request->price_from);
            })
            ->when($request->price_to, function($query) use ($request){
                $query->where("products.productPrice", "<=", $request->price_to);
            })
            ->when($request->manufacturer, function($query) use ($request){
                $query->where("products.manufacturer_id", "=", $request->manufacturer);
            })
            ->select(['products.id'])
            ->distinct()
            ->get();
//        dump($filteredProducts);
        $promotion->products()->attach($filteredProducts);
        if($request->has('discount')) {
        $promotion->discounts()->attach($request->discount);
        }
        return redirect()->route('promotion.index');
    }


    public function show(Promotion $promotion)
    {
        return view('dashboard.promotion.show',['promotion' => $promotion]);
    }

    public function edit(Promotion $promotion)
    {
        $categories = Category::all();
        $products = Product::all();
        $manufacturers = Manufacturer::all();
        $discounts = Discount::all();
        return view('dashboard.promotion.edit',
            [
                'categories'=>$categories,
                'products'=>$products,
                'manufacturers'=>$manufacturers,
                'promotion'=>$promotion,
                'discounts' => $discounts
            ]);
    }


    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        dd($request);
    }


    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('promotion.index');
    }

    public function removeProductFromPromotion(Request $request) {
        $promotion = Promotion::findOrFail($request->promotion);
        $promotion->products()->detach($request->product);
        return redirect()->back();
    }
}
