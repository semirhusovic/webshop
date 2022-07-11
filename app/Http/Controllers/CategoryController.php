<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Product;
use App\Models\Slider;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::whereNull('category_id')
            ->with('subcategories')
            ->get();

        $sliders = Slider::query()->where('isActive','=','1')->orderBy('order')->get();

        return view('welcome', compact('categories','sliders'));
    }

    public function show(Category $category)
    {
        $category->load('subcategories.subcategories');

        $subcategoryIDs = [$category->id];
        foreach ($category->subcategories as $subcategory) {
            $subcategoryIDs[] = $subcategory->id;
            foreach ($subcategory->subcategories as $subsubcategory) {
                $subcategoryIDs[] = $subsubcategory->id;
            }
        }

        $products = Product::whereHas('categories', function($query) use ($subcategoryIDs) {
            $query->whereIn('categories.id', $subcategoryIDs);
        })->get();

        return view('categories.show', compact('category', 'products'));
    }




}
