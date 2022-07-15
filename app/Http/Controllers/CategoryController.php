<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.category.index', ["categories" => $categories]);
    }

    public function create()
    {
        return view('dashboard.category.create', ['categories' => Category::all()]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $newCategory = Category::query()->create($request->all());
        return redirect()->route('category.index');
    }


    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('dashboard.category.edit', ['category' => $category, 'categories' => $categories]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->updateOrFail($request->all());
        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }
}
