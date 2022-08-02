<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('category_id')
            ->with('subcategories')
            ->get();

        $sliders = Slider::query()->where('isActive', '=', '1')->orderBy('order')->get();
        $products = Product::all();
        return view('welcome', compact('categories', 'sliders', 'products'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $category->load('subcategories.subcategories');

        $subcategoryIDs = [$category->id];
        foreach ($category->subcategories as $subcategory) {
            $subcategoryIDs[] = $subcategory->id;
            foreach ($subcategory->subcategories as $subsubcategory) {
                $subcategoryIDs[] = $subsubcategory->id;
            }
        }

        $products = Product::whereHas('categories', function ($query) use ($subcategoryIDs) {
            $query->whereIn('categories.id', $subcategoryIDs);
        })->get();

        return view('categories.show', compact('category', 'products'));
    }

    public function showCart()
    {
        return view('frontend.cart');
    }
}
