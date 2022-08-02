<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $language = session('language') ? session('language') : 'en';
        $filter = $request->filter;
        if (!empty($filter)) {
            $categories = Category::query()
                ->whereHas('translations', function ($query) use ($filter, $language) {
                    $query->where('locale', '=', $language);
                    $query->where('categoryName', 'like', '%'.$filter.'%');
                })
                ->paginate();
        } else {
            $categories = Category::query()->paginate();
        }
        return view('dashboard.category.index', ["categories" => $categories,"filter" => $filter]);
    }

    public function create()
    {
        return view('dashboard.category.create', ['categories' => Category::all()]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $newCategory = Category::query()->create($request->all());
        return redirect()->route('category.index')->withToastSuccess('Category created successfully!');
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
        return redirect()->route('category.index')->withToastSuccess('Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->withToastSuccess('Category deleted successfully!');
    }
}
